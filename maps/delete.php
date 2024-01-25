<?php
// Include database connection details
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

// Variables to store success or error messages
$successMessage = "";
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected restaurant name from the form
    $delete_name = $_POST['delete_name'];

    // SQL query to delete the restaurant based on the name
    $sql = "DELETE FROM markers WHERE name = '$delete_name'";

    if ($conn->query($sql) === TRUE) {
        // Set success message
        $successMessage = "Restaurant deleted successfully";
    } else {
        // Set error message
        $errorMessage = "Error deleting restaurant: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Restaurant</title>
    <script>
        // JavaScript function to display an alert with the success or error message
        function showAlert() {
            <?php
            if (!empty($successMessage)) {
                echo "alert('$successMessage');";
                // Redirect to create.php after clicking "OK"
                echo "window.location.href = 'create.php';";
            } elseif (!empty($errorMessage)) {
                echo "alert('$errorMessage');";
                // Redirect to create.php after clicking "OK"
                echo "window.location.href = 'create.php';";
            }
            ?>
        }
        // Call the showAlert function when the page loads
        window.onload = showAlert;
    </script>
</head>