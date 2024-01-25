<?php
include 'connect.php';

$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $showError = "Invalid email format";
    }

    // Validate username format (customize as needed)
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[^A-Za-z0-9]/", $password)) {
        $showError = "Password must be 8 characters long with at least 1 capital letter, 1 number, and 1 special character";
        
    }

    // Check if the username already exists
    $result = $conn->query("SELECT id FROM customer WHERE username='$username'");
    if ($result->num_rows > 0) {
        $showError = "Username already exists. Choose a different username.";
        
    } else {
        // Hash the password before storing it in the database (for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the users table
        $sql = "INSERT INTO customer (email, username, password) VALUES ('$email', '$username', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            $showAlert = true;
        } else {
            $showError = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon" href="img/logo.png">
   
    <title>Sign Up</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>

<div>
<div class="topnav" id="myTopnav">
    <a href="home.php">Home</a>
    <a href="login.php">Login</a>
    <a class="active" href="#signup">Sign Up</a>
</div>

<div class="content">
    <h2>Sign Up</h2>

    <?php
    if ($showAlert) {
        echo '<div>
                <strong>Success!</strong> Your account is now created. You can login.
              </div>';
    }
    ?>
    
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Sign Up">
        <p> already have an account?  <a href="login.php">login</a></p>
    </form>
</div>
</div>

</body>
</html>
