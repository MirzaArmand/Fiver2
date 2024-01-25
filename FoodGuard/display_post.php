<?php
// Connect to database
$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.*, u.username, COUNT(l.like_id) AS like_count
        FROM posts p 
        INNER JOIN users u ON p.user_id = u.user_id
        LEFT JOIN likes l ON p.post_id = l.post_id
        GROUP BY p.post_id
        ORDER BY p.post_id DESC"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display post content and username
        echo '<div class="post">';
        echo '<img src="' . $row["image_path"] . '" alt="Post Image">';
        echo '<span class="username">' . $row["username"] . " " .  $row["caption"] .'</span>' . '<br>';  //. '<p>' . $row["caption"] . '</p>';
        
        // Display username next to the post caption
        // echo '<span class="username">' . $row["username"] . '</span>';

        // Display like button
        echo '<button class="like-btn" data-post-id="' . $row["post_id"] . '" title="Like this post"><i class="far fa-heart"></i></button>' . " ";
        echo '<span class="like-count">' . $row["like_count"] . '</span> Likes';

        
        // Fetch comments for the current post
        $currentPostID = $row["post_id"];
        $commentSql = "SELECT c.*, u.username FROM comments c INNER JOIN users u ON c.user_id = u.user_id WHERE c.post_id = $currentPostID";
        $commentResult = $conn->query($commentSql);

        if ($commentResult->num_rows > 0) {
            // Display comments for the current post
            while ($commentRow = $commentResult->fetch_assoc()) {
                echo '<div class="comment">';
                echo '<p>' . '<span class="username">' . $row["username"] . " " . $commentRow["comment_text"] . '</p>';
                // Display user information, timestamp, etc., related to the comment if needed
                echo '</div>';
            }
        } else {
            echo '<p>No comments yet</p>';
        }

        // comment form
        echo '<form method="post" action="comment_handler.php">';
        echo '<input type="hidden" name="post_id" value="' . $row["post_id"] . '">';
        echo '<textarea name="comment_text" placeholder="Add a comment..." required></textarea>';
        echo '<button type="Submit"> > </button>';
        echo '</form>';

        // echo '</div>'; // Close comments div
        echo '</div>'; // Close post div
    }
} else {
    echo "0 results";
}

$conn->close();
?>
