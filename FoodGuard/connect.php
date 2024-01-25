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
//echo "Connected successfully.";
?>
