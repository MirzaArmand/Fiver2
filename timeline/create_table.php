<?php
// Connect to your database
$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $sql = "CREATE TABLE users (
//     user_id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) UNIQUE,
//     email VARCHAR(100) UNIQUE,
//     password VARCHAR(255),
//     role ENUM('client', 'admin', 'user') DEFAULT 'user',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";

// $sql = "CREATE TABLE posts (
//     post_id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT,
//     image_path VARCHAR(255),
//     caption TEXT,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (user_id) REFERENCES users(user_id)
// )";

// $sql = "CREATE TABLE comments (
//     comment_id INT AUTO_INCREMENT PRIMARY KEY,
//     post_id INT,
//     user_id INT,
//     comment_text TEXT,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (post_id) REFERENCES posts(post_id),
//     FOREIGN KEY (user_id) REFERENCES users(user_id)
// )";

$sql = "CREATE TABLE likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  
  $conn->close();

?>
