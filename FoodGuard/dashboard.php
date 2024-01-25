<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/icon" href="img/logo.png">
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

li {
    margin: 10px 0;
}

/*a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 18px;
    display: block;
    padding: 10px;
    border: 2px solid #333;
    border-radius: 8px;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #333;
    color: #fff;
} */

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: black;
  position: fixed;
  height: 100%;
  overflow: auto;
  color:white;
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
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

.image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }

        .image-grid img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
      <a href="http://localhost/maps/maps_client.php">Restaurant Locator</a>
      <a href="http://localhost/FoodGuard/list.php"> List of Cafes and Restaurants</a>
      <a class="active" href="http://localhost/FoodGuard/dashboard.php">Dashboard</a>
      <a href="http://localhost/FoodGuard/home.php">Logout</a>
    
</div>

<div class="content">
<h2 >FoodGuard's Dashboard!</h2>

<h4> Restaurant's Rank </h4>
<?php
// Query to calculate the average rating for each restaurant
$sql = "SELECT restaurant_id, AVG(rating) AS avg_rating FROM reviews GROUP BY restaurant_id ORDER BY avg_rating DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Top Rated Restaurants</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Rank</th><th>Restaurant Name</th><th>Average Rating</th></tr>";

    $rank = 1;

    while ($row = $result->fetch_assoc()) {
        $restaurantId = $row['restaurant_id'];
        $averageRating = number_format($row['avg_rating'], 1); // Format to one decimal place

        // Retrieve restaurant name from the markers table
        $restaurantNameSql = "SELECT name FROM markers WHERE id = $restaurantId";
        $restaurantNameResult = $conn->query($restaurantNameSql);

        if ($restaurantNameResult->num_rows > 0) {
            $restaurantNameRow = $restaurantNameResult->fetch_assoc();
            $restaurantName = $restaurantNameRow['name'];

            // Display restaurant details in the table
            echo "<tr><td>$rank</td><td>$restaurantName</td><td>$averageRating</td></tr>";
            $rank++;
        }
    }

    echo "</table>";
} else {
    echo "No reviews found.";
}

?>

 

<h4> RESTAURANT'S GRADE (RATE BY PUSAT KESIHATAN UNIVERSITI (PKU) & KEMENTERIAN KESIHATAN MALAYSIA (KKM)) </h4>
<?php
$sql = "SELECT id, restaurant_name, Cleanliness_Grade,Performance_Grade  FROM grade ORDER BY Cleanliness_Grade ASC, Performance_Grade ASC;";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    $rank =1;

    echo"<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #000;
        color: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #6495ED;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #333;
    }

    tr:hover {
        background-color: #555;
    }

    </style>";
    // Output header
    echo "<table border='1'><tr><th>Rank</th><th>Restaurant Name</th><th>Cleanliness Grade</th><th>Performance Grade</th></tr>";

// Fetch and store data in an array
$restaurants = array();
while ($row = $result->fetch_assoc()) {
    $restaurantName = $row["restaurant_name"];
    $Cleanliness_Grade = $row["Cleanliness_Grade"];
    $Performance_Grade = $row["Performance_Grade"];

    // Assign numerical values to grades (A=3, B=2, C=1)
    $cleanlinessValue = ($Cleanliness_Grade == 'A') ? 3 : (($Cleanliness_Grade == 'B') ? 2 : 1);
    $performanceValue = ($Performance_Grade == 'A') ? 3 : (($Performance_Grade == 'B') ? 2 : 1);

    // Calculate overall grade
    $overallGrade = $cleanlinessValue + $performanceValue;

    // Store data in an array
    $restaurants[] = array(
        'name' => $restaurantName,
        'cleanliness' => $Cleanliness_Grade,
        'performance' => $Performance_Grade,
        'overallGrade' => $overallGrade
    );
}

// Sort the array based on overallGrade in descending order
usort($restaurants, function ($a, $b) {
    return $b['overallGrade'] - $a['overallGrade'];
});

// Display the ranked restaurants
$rank = 1;
foreach ($restaurants as $restaurant) {
    echo "<tr><td>$rank</td><td>{$restaurant['name']}</td><td>{$restaurant['cleanliness']}</td><td>{$restaurant['performance']}</td></tr>";
    $rank++;
}

echo "</table>";
} else {
    echo "No results found";
}
?>
<p>Elevate your brand or program and reach new heights with our exclusive advertising opportunity! 
  For just RM10, you can showcase your business or program on our premier website and captivate your target audience.</p>
  <a href="payment.html?i" style='display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px;
            border-radius: 5px; transition: background-color 0.3s;'>Advertise Now</a>
  <?php
 
 echo "<div class='image-grid'>";
 $sql = "SELECT DISTINCT image_path FROM advertisements";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $imagePath = $row['image_path'];

         // Display the image with a fixed width and height
         echo "<img src='$imagePath' alt='paid ads'>";
     }
     echo "</div>";
 } else {
     echo "No images found.";
 }
 
// Close the MySQL connection
$conn->close();
?>

</body>
</html>
