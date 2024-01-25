<?php
include 'connect.php';

$restaurantId = isset($_GET['id']) ? $_GET['id'] : 1; // Default to restaurant_id 1

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected values from the dropdown lists
    $cleanlinessGrade = $_POST['cleanliness_grade'];
    $performanceGrade = $_POST['performance_grade'];

    // Update the database
    $stmt = $conn->prepare("INSERT INTO grade (id, Cleanliness_Grade, Performance_Grade) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE Cleanliness_Grade = VALUES(Cleanliness_Grade), Performance_Grade = VALUES(Performance_Grade)");
    $stmt->bind_param("iss", $restaurantId, $cleanlinessGrade, $performanceGrade);
    $stmt->execute();
    $stmt->close();

    // Redirect to view_restaurant.php with updated parameters
    header("Location: view_restaurant.php?id=$restaurantId&success=true");
    exit(); // Make sure to exit after the header function to prevent further execution
}

// Close the connection
$conn->close();
?>
