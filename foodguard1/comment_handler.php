<?php
session_start(); // Start the session if not already started

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comment_text"]) && isset($_POST["post_id"])) {
    $commentText = $_POST["comment_text"];
    $postId = $_POST["post_id"];
    $userId = $_SESSION["user_id"]; // Assuming user is logged in and you have their ID in session

    // Establish database connection 
    $servername = "localhost";
    $username = "foodguard";
    $password = "MirZieNasSof";
    $dbname = "foodguard";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to insert the comment
    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $postId, $userId, $commentText);
    $stmt->execute();
    $stmt->close();

    // Redirect to the timeline or post page after comment submission
    header("Location: timeline.php");
    exit;
}
?>
