<?php
include 'connect.php';

    $restaurantId = isset($_GET['id']) ? $_GET['id'] : 1; // Default to restaurant_id 1
    
    // Fetch existing data for the restaurant
    $result = $conn->query("SELECT restaurant_name, Cleanliness_Grade, Performance_Grade FROM grade WHERE id = $restaurantId");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $restaurant_name = $row['restaurant_name'];
        $cleanlinessGrade = $row['Cleanliness_Grade'];
        $performanceGrade = $row['Performance_Grade'];
    } else {
        // Handle the case where no records are found.
        $cleanlinessGrade = "NO GRADE";
        $performanceGrade = "NO GRADE";
        
        // You may set default values or redirect the user.
        // For simplicity, I'm setting default values here.
        $cleanlinessGrade = 'A';
        $performanceGrade = 'A';
    }
    
    // Close the connection
    $conn->close();
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
            /* color:white; */
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            background-color: #2c3e50;
            color: white;
            padding: 10px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
      <a href="http://localhost/FoodGuard/home_client.php">Home</a>
      <a  href="http://localhost/maps/maps_client.php">Restaurant Locator</a>
      <a class="active"href="http://localhost/FoodGuard/list.php"> List of Cafes and Restaurants</a>
      <a href="http://localhost/FoodGuard/dashboard.php">Dashboard</a>
      <a href="http://localhost/FoodGuard/home.php">Logout</a>
</div>

<div classs='content'>
<h3><?php echo $restaurant_name; ?></h3>

    <form method="post" action="update_restaurant.php?id=<?php echo $restaurantId; ?>">
    <label for="cleanliness_grade">Cleanliness Grade:</label>
    <select name="cleanliness_grade" id="cleanliness_grade">
        <option value="A" <?php echo ($cleanlinessGrade == 'A') ? 'selected' : ''; ?>>A</option>
        <option value="B" <?php echo ($cleanlinessGrade == 'B') ? 'selected' : ''; ?>>B</option>
        <option value="C" <?php echo ($cleanlinessGrade == 'C') ? 'selected' : ''; ?>>C</option>
        <!-- Add more options as needed -->
    </select>

    <br>

    <label for="performance_grade">Performance Grade:</label>
    <select name="performance_grade" id="performance_grade">
        <option value="A" <?php echo ($performanceGrade == 'A') ? 'selected' : ''; ?>>A</option>
        <option value="B" <?php echo ($performanceGrade == 'B') ? 'selected' : ''; ?>>B</option>
        <option value="C" <?php echo ($performanceGrade == 'C') ? 'selected' : ''; ?>>C</option>
        <!-- Add more options as needed -->
    </select>

    <br>

        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>
