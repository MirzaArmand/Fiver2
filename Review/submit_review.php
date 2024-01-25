<?php
// Connect to your MySQL database
$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$restaurantName = isset($_POST["restaurantName"]) ? $_POST["restaurantName"] : "";
$userName = isset($_POST["userName"]) ? $_POST["userName"] : "";
$rating = isset($_POST["rating"]) ? $_POST["rating"] : "";
$reviewText = isset($_POST["reviewText"]) ? $_POST["reviewText"] : "";

// Use prepared statements to avoid SQL injection
$stmt = $conn->prepare("INSERT INTO reviews (restaurant_name, user_name, rating, review_text) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $restaurantName, $userName, $rating, $reviewText);

if ($stmt->execute()) {
    $response = array("success" => true);
} else {
    $response = array("success" => false);
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
