<?php
// Ensure the user is logged in as an admin or has necessary permissions

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_posts'])) {
    // Database connection
    $servername = "localhost";
    $username = "foodguard";
    $password = "MirZieNasSof";
    $dbname = "foodguard";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle post deletion
    $delete_posts = $_POST['delete_posts'];

    foreach ($delete_posts as $post_id) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = ?");
        $stmt->bind_param("i", $post_id); // Assuming post_id is an integer

        if ($stmt->execute()) {
            echo "Post with ID: $post_id deleted successfully.<br>";
        } else {
            echo "Error deleting post with ID: $post_id - " . $conn->error . "<br>";
        }

        $stmt->close();
        header("Location:admin_home.php");
    }

    $conn->close();
} else {
    // Redirect to an error page or back to the admin panel with an error message
    header("Location: admin_panel.php?error=1");
    exit();
}
?>
