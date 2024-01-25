<?php
$servername="localhost";
$username="root";
$password="";
$dbname="map";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && isset($_POST["caption"])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // ... (Same validation checks as before)

    if ($uploadOk == 0) {
        // Handle errors
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save post details to the database
            $caption = $_POST["caption"];
            $imagePath = $targetFile; // This is the path to the uploaded image

            // Prepare and execute an SQL INSERT statement to save the post details
            $sql = "INSERT INTO posts (user_id, image_path, caption) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            // Assuming user_id is the ID of the user who uploaded the image (retrieve this from the session or elsewhere)
            $user_id = 1; // Replace with the actual user ID
            $stmt->bind_param("iss", $user_id, $imagePath, $caption);
            $stmt->execute();

            // Redirect to the timeline page after successful upload
            header("Location: foodguard.php");
            exit;
        } else {
            // Handle errors
        }
    }
}
?>

