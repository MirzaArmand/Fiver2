<?php
include 'connect.php';


    
    $restaurantId = isset($_GET['id']) ? $_GET['id'] : 1; // Default to restaurant_id 1
    
    // Fetch title and header from the database
    $result = $conn->query("SELECT restaurant_name FROM grade WHERE id = $restaurantId");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $restaurant_name = $row['restaurant_name'];
       
    } else {
        // Handle the case where no records are found.
        // You may set default values or redirect the user.
        // For simplicity, I'm setting default values here.
        $restaurant_name = 'Default Title';
       
    }

  
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $restaurant_name; ?></title>
    <link rel="icon" type="image/icon" href="img/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color:white;
        }

        header {
            text-align: center;
            /* background-color: white; */
            color: white;
            padding: 10px;
        }

        h2 {
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }

        /* a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #2980b9;
        } */

        

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


.search-box {
    text-align: center;
    margin-bottom: 20px;
}

input[type="text"] {
    padding: 8px;
    font-size: 16px;
    border: 2px solid #333;
    border-radius: 8px;
    margin-right: 8px;
}

input[type="button"] {
    background-color: #333;
    color: #fff;
    padding: 8px 16px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

input[type="button"]:hover {
    background-color: #555;
}


    </style>
</head>
<body>
    
<div class="sidebar">
<div class="logo" style="display: flex; align-items: center;">
        <img src="http://localhost/img/WhatsApp_Image_2024-01-02_at_9.34.56_PM-removebg-preview.png" alt="Logo" style="width: 50px; height: 50px;">
        <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
      </div>
      <a href="http://localhost/FoodGuard/home_client.php">Home</a>
      <a  href="http://localhost/maps/maps_client.php">Restaurant Locator</a>
      <a class="active" href="http://localhost/FoodGuard/list.php"> List of Cafes and Restaurants</a>
      <a href="http://localhost/FoodGuard/dashboard.php">Dashboard</a>
      <a href="http://localhost/FoodGuard/home.php">Logout</a>
</div>
<div class="content">
    <?php
    $restaurantId = isset($_GET['id']) ? $_GET['id'] : 1; // Default to restaurant_id 1
    $result = $conn->query("SELECT restaurant_name, image, Cleanliness_Grade, Performance_Grade FROM grade WHERE id = $restaurantId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>{$row['restaurant_name']}</h2>";
        echo "<img src='{$row['image']}' alt='Restaurant Image'>";
        echo "<p>Cleanliness Grade: {$row['Cleanliness_Grade']}</p>";
        echo "<p>Performance Grade: {$row['Performance_Grade']}</p>";
    } else {
        echo "Restaurant not found.";
    }

      // Close the connection
      $conn->close();
    ?>

    <br>

    <a href="edit_restaurant.php?id=<?php echo $restaurantId; ?>" style='display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px;
            border-radius: 5px; transition: background-color 0.3s;'>Edit</a>
</div>
</body>
</html>
