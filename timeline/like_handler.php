<?php
// Handle like action
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["postId"])) {
    $postId = $_POST["postId"];
    $userId = $_SESSION["user_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "map";
    

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statements
    $checkLikeQuery = "SELECT * FROM likes WHERE post_id = $postId AND user_id = $userId";
    $checkResult = $conn->query($checkLikeQuery);

    if ($checkResult === false) {
        // Handle query error
        echo json_encode(array('status' => 'error', 'message' => $conn->error));
    } else {
        try {
            if ($checkResult->num_rows > 0) {
                // User already liked the post, so unlike it
                $unlikeQuery = "DELETE FROM likes WHERE post_id = $postId AND user_id = $userId";
                $unlikeResult = $conn->query($unlikeQuery);
                if ($unlikeResult === false) {
                    // Handle unlike query error
                    echo json_encode(array('status' => 'error', 'message' => $conn->error));
                } else {
                    $response = array('status' => 'unliked');
                    echo json_encode(array('status' => 'success', 'response' => $response));
                }
            } else {
                // User hasn't liked the post, so like it
                $likeQuery = "INSERT INTO likes (post_id, user_id) VALUES ($postId, $userId)";
                $likeResult = $conn->query($likeQuery);
                if ($likeResult === false) {
                    // Handle like query error
                    echo json_encode(array('status' => 'error', 'message' => $conn->error));
                } else {
                    $response = array('status' => 'liked');
                    echo json_encode(array('status' => 'success', 'response' => $response));
                }
            }
        } catch (Exception $e) {
            // Handle other exceptions
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
    $conn->close();
}
?>
