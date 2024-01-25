<?php
session_start();

// Handle like action
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["postId"])) {
    $postId = $_POST["postId"];
    $userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    // Check if user is logged in
    if (!$userId) {
        echo json_encode(array('status' => 'error', 'message' => 'User not logged in.'));
        exit;
    }

    $servername = "localhost";
    $username = "foodguard";
    $password = "MirZieNasSof";
    $dbname = "foodguard";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statements to prevent SQL injection
        $checkLikeQuery = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
        $stmt = $conn->prepare($checkLikeQuery);
        $stmt->bind_param("ii", $postId, $userId);
        $stmt->execute();
        $checkResult = $stmt->get_result();

        if ($checkResult === false) {
            // Handle query error
            throw new Exception("Error checking like status: " . $conn->error);
        }

        if ($checkResult->num_rows > 0) {
            // User already liked the post, so unlike it
            $unlikeQuery = "DELETE FROM likes WHERE post_id = ? AND user_id = ?";
            $stmt = $conn->prepare($unlikeQuery);
            $stmt->bind_param("ii", $postId, $userId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'unliked');
                echo json_encode(array('status' => 'success', 'response' => $response));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error unliking post.'));
            }
        } else {
            // User hasn't liked the post, so like it
            $likeQuery = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
            $stmt = $conn->prepare($likeQuery);
            $stmt->bind_param("ii", $postId, $userId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'liked');
                echo json_encode(array('status' => 'success', 'response' => $response));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error liking post.'));
            }
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Exception: ' . $e->getMessage()));
    }
}
?>
