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

        a {
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
        }
    </style>
</head>
<body>
    

    <?php
    $restaurantId = isset($_GET['id']) ? $_GET['id'] : 1; // Default to restaurant_id 1
    $result = $conn->query("SELECT restaurant_name, image, Cleanliness_Grade, Performance_Grade FROM grade WHERE id = $restaurantId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>{$row['restaurant_name']}</h3>";
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

    <a href="edit_restaurant.php?id=<?php echo $restaurantId; ?>">Edit</a>
</body>
</html>
