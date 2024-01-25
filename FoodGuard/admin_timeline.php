<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("att.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        } */


        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #f2f2f2;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 300px; /* Adjust the max-width as needed */
            height: auto;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="checkbox"] {
            transform: scale(1.5); /* Adjust the scale factor as needed */
            margin-right: 5px; /* Optional: Add some spacing to the right of the checkbox */
        }

    .sidebar {
    margin: 0;
    padding: 0;
    top: 0;
    width: 200px;
    background-color: rgb(10, 12, 72);
    position: fixed;
    height: 100%;
    overflow: auto;
    color: white;
}

.sidebar a.active {
  background-color: blue;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #6495ED;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {
    float: left;
  }
  div.content {
    margin-left: 0;
  }
}


        div.dpost {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
    <div class="logo" style="display: flex; align-items: center;">
      <img src="http://localhost/FoodGuard/img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
      <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
    </div>
    <a href="http://localhost/FoodGuard/admin_home.php">Home</a>
    <a href="http://localhost/maps/map_admin.php">Restaurant Locator</a>
    <a href="http://localhost/FoodGuard/admin_list.php"> List of Cafes and Restaurants</a>
    <a href="http://localhost/maps/create.php">Add Restaurant</a>
    <a href="http://localhost/Review/Review/admin.html">Delete Review</a>
    <a class="active" href="http://localhost/FoodGuard/admin_timeline.php">Delete Timeline</a>
    <a href="http://localhost/FoodGuard/admin_dashboard.php">Dashboard</a>
    <a href="http://localhost/FoodGuard/home.php">Logout</a>
    </div>

    <div class="dpost">
        <h2>Hiii Admin</h2>
        <br>
        <br>
        <h4> Deleting the inappropriate post. Select the post and click delete button </h4>
        <br>

<?php
// Connect to database
$servername = "localhost";
$username = "foodguard";
$password = "MirZieNasSof";
$dbname = "foodguard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve and display user posts for the admin
$sql = "SELECT * FROM posts"; // Query to get all posts
$result = $conn->query($sql);

// Display posts in a table
echo "<form method='post' action='delete_post.php'>";
echo "<table>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td><input type='checkbox' name='delete_posts[]' value='" . $row['post_id'] . "'></td>";
    echo "<td><img src='" . $row["image_path"] . "' alt='Post Image'></td>";
    echo "<td>" . $row["caption"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<input type='submit' value='Delete Selected Posts'>";
echo "</form>";

// Delete selected posts in delete_posts.php
// delete_posts.php file should handle deletion
if(isset($_POST['delete_posts'])) {
    $delete_posts = $_POST['delete_posts'];
    foreach($delete_posts as $post_id) {
        $sql = "DELETE FROM posts WHERE post_id = $post_id";
        if ($conn->query($sql) === TRUE) {
            echo "Post with ID: $post_id deleted successfully.<br>";
        } else {
            echo "Error deleting post: " . $conn->error;
        }
    }
}

$conn->close();

?>
</div>

</body>

</html>