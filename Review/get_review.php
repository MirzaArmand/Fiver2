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

// Fetch reviews from the database
$sql = "SELECT * FROM reviews ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $reviews = array();
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    $response = array("success" => true, "reviews" => $reviews);
} else {
    $response = array("success" => false);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
