<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected restaurant name to update
    $updateName = $_POST["update_name"];

    // Initialize arrays to store new values
    $newValues = array();

    // Get the new values for update, if provided
    if (!empty($_POST["new_name"])) {
        $newValues[] = "name = '" . $_POST["new_name"] . "'";
    }
    if (!empty($_POST["new_address"])) {
        $newValues[] = "address = '" . $_POST["new_address"] . "'";
    }
    if (!empty($_POST["new_lat"])) {
        $newValues[] = "lat = '" . $_POST["new_lat"] . "'";
    }
    if (!empty($_POST["new_lng"])) {
        $newValues[] = "lng = '" . $_POST["new_lng"] . "'";
    }
    if (!empty($_POST["new_type"])) {
        $newValues[] = "type = '" . $_POST["new_type"] . "'";
    }
    if (!empty($_POST["new_operating_hours"])) {
        $newValues[] = "operating_hours = '" . $_POST["new_operating_hours"] . "'";
    }
    if (!empty($_POST["new_image_url"])) {
        $newValues[] = "image_url = '" . $_POST["new_image_url"] . "'";
    }

    // Construct the SQL update statement
    if (!empty($newValues)) {
        $sql = "UPDATE markers SET " . implode(", ", $newValues) . " WHERE name = '$updateName'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Restaurant updated successfully.'); window.location.href = 'create.php';</script>";
            exit; // Terminate execution after redirection
        } else {
            echo "Error updating restaurant: " . $conn->error;
        }
    } else {
        echo "<script>alert('No changes submitted.'); window.location.href = 'create.php';</script>";
        exit; // Terminate execution after redirection
    }
}

// Close the MySQL connection
$conn->close();
?>

