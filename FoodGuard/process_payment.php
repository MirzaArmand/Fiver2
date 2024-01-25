<?php
$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "ad/";
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
            $imagePath = $targetFile; // This is the path to the uploaded image

            // Prepare and execute an SQL INSERT statement to save the post details
            $sql = "INSERT INTO advertisements (image_path) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $imagePath); // Use "s" for a string
            $stmt->execute();

            // Additional logic or feedback if needed
        }
    }
}
?>
