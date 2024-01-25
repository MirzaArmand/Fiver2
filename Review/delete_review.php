<?php

$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/// Check if the review ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the review ID from the request parameters
    $reviewId = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $reviewId);

    if ($stmt->execute()) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false, "error" => $stmt->error);
    }

    $stmt->close();
} else {
    $response = array("success" => false, "message" => "Review ID not provided");
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>