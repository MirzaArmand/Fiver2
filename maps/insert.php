<?php
$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Variables to store success or error messages
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $address = $_POST['address'];
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $type = $_POST['type'];
  $operating_hours = $_POST['operating_hours'];
  $image_url = $_POST['image_url'];

  $sql = "INSERT INTO markers (name, address, lat, lng, type, operating_hours, image_url)
          VALUES ('$name', '$address', '$lat', '$lng', '$type', '$operating_hours', '$image_url')";

  if ($conn->query($sql) === TRUE) {
    // Set success message
    $successMessage = "New record created successfully";
  } else {
    // Set error message
    $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add new Restaurant</title>
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