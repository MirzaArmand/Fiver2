<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add new Restaurant</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('https://www.pixelstalk.net/wp-content/uploads/2016/08/Fast-food-backgrounds-free-download.jpg');
      background-size: cover;
      background-position: center;
    }

    .container {
      max-width: 600px;
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      margin: auto;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    form {
      display: grid;
      grid-gap: 10px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
      text-transform: uppercase;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color: #2980b9;
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
      left: 0;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 16px;
      text-decoration: none;
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
    <a class="active" href="create.html">Add Restaurant</a>
    <a href="http://localhost/Review/Review/admin.html">Delete Review</a>
    <a href="http://localhost/FoodGuard/admin_timeline.php">Delete Timeline</a>
    <a href="http://localhost/FoodGuard/dashboard.php">Dashboard</a>
    <a href="http://localhost/FoodGuard/home.php">Logout</a>
  </div>

  <div class="container">
    <h2>Restaurant Operations</h2>
    <form action="insert.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required>

      <label for="lat">Latitude:</label>
      <input type="text" id="lat" name="lat" required>

      <label for="lng">Longitude:</label>
      <input type="text" id="lng" name="lng" required>

      <label for="type">Type:</label>
      <input type="text" id="type" name="type" required>

      <label for="operating_hours">Operating Hours:</label>
      <input type="text" id="operating_hours" name="operating_hours">

      <label for="image_url">Image URL:</label>
      <input type="text" id="image_url" name="image_url">

      <input type="submit" value="Create">
    </form>

    <form action="update.php" method="post">
    <form action="update.php" method="post">
  <h3>Update Restaurant</h3>
  <label for="update_name">Select Restaurant to Update:</label>
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

    // Fetch restaurant names from the markers table
    $sql = "SELECT name FROM markers";
    $result = $conn->query($sql);

    // Display dropdown with restaurant names
    echo '<select id="update_name" name="update_name" required>';
    while ($row = $result->fetch_assoc()) {
      echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
    }
    echo '</select>';
  ?>

  <!-- Update fields -->
  <label for="new_name">New Name:</label>
  <input type="text" id="new_name" name="new_name">

  <label for="new_address">New Address:</label>
  <input type="text" id="new_address" name="new_address">

  <label for="new_lat">New Latitude:</label>
  <input type="text" id="new_lat" name="new_lat">

  <label for="new_lng">New Longitude:</label>
  <input type="text" id="new_lng" name="new_lng">

  <label for="new_type">New Type:</label>
  <input type="text" id="new_type" name="new_type">

  <label for="new_operating_hours">New Operating Hours:</label>
  <input type="text" id="new_operating_hours" name="new_operating_hours">

  <label for="new_image_url">New Image URL:</label>
  <input type="text" id="new_image_url" name="new_image_url">

  <!-- Submit button -->
  <input type="submit" value="Update">
</form>


    <form action="delete.php" method="post">
      <h3>Delete Restaurant</h3>
      <label for="delete_name">Select Restaurant to Delete:</label>
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

      // Fetch restaurant names from the markers table
      $sql = "SELECT name FROM markers";
      $result = $conn->query($sql);

      // Display dropdown with restaurant names
      echo '<select id="delete_name" name="delete_name" required>';
      while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
      }
      echo '</select>';
      ?>
      <input type="submit" value="Delete">
    </form>
  </div>

</body>

</html>
