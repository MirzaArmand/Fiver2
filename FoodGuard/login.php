<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the customer table
    $stmt = $conn->prepare('SELECT id, password FROM customer WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['user_id'] = $userID;

            // Redirect to the user's dashboard or home page
            header("Location: foodguard.php");
            exit();
        } else {
            $loginError = "Invalid username or password";
        }
    } else {
        // Check if the username exists in the admin table
        $stmt = $conn->prepare('SELECT id, password FROM admin WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userID, $passwordInAdminTable);
            $stmt->fetch();

            // Verify the password (no hashing in this case)
            if ($password == $passwordInAdminTable) {
                session_start();
                $_SESSION['admin_id'] = $userID;

                // Redirect to the admin's dashboard or home page
                header("Location: admin_home.php");
                exit();
            } else {
                $loginError = "Invalid username or password";
            }
        } else {
            // Check if the username exists in the client table
            $stmt = $conn->prepare('SELECT id, password FROM client WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($userID, $passwordInClientTable);
                $stmt->fetch();

                // Verify the password (no hashing in this case)
                if ($password == $passwordInClientTable) {
                    session_start();
                    $_SESSION['client_id'] = $userID;

                    // Redirect to the client's dashboard or home page
                    header("Location: home_client.php");
                    exit();
                } else {
                    $loginError = "Invalid username or password";
                }
            } else {
                $loginError = "Invalid username or password";
            }
        }
    }

    $stmt->close();
}
?>

<!-- ... (your HTML login form) ... -->

<!-- ... (your HTML login form) ... -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/icon" href="img/logo.png">
   
    <title>Login</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>

<div>
<div class="topnav" id="myTopnav">
    <a href="home.php">Home</a>
    <a href="Signup.php">Sign Up</a>
    <a class="active" href="#login">Login</a>
</div>
<div class="content">
    <h2>Login</h2>

    <?php
    if (isset($loginError)) {
        echo '<div>
                <strong>Error!</strong> ' . $loginError . '
              </div>';
    }
    ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</div>
</div>

</body>
</html>
