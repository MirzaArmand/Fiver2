<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Cafes and Restaurants in UTM</title>
    <link rel="icon" type="image/icon" href="img/logo.png">
<style>
body {
    font-family: Arial, sans-serif;
    background-color: black;
    color: white;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
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

/* body {
  font-family: 'Roboto', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f8f9fa;
  color: #15222e;
  background-image: url("resto2.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
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

/* a {
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

    </style>
      <script>
        function filterRestaurants() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            ul = document.querySelector('.content ul'); // Adjusted the selector
            li = ul.getElementsByTagName('li');

            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName('a')[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = '';
                } else {
                    li[i].style.display = 'none';
                }
            }
        }
    </script>
</head>
<body>

<div class="sidebar">
<div class="logo" style="display: flex; align-items: center;">
        <img src="http://localhost/FoodGuard/img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
        <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
      </div>
      <a href="http://localhost/FoodGuard/admin_home.php">Home</a>
    <a  href="http://localhost/maps/map_admin.php">Restaurant Locator</a>
    <a  class="active"href="http://localhost/FoodGuard/admin_list.php"> List of Cafes and Restaurants</a>
    <a href="http://localhost/maps/create.php">Add Restaurant</a>
    <a href="http://localhost/Review/Review/delete_review.php">Delete Review</a>
    <a href="http://localhost/FoodGuard/admin_timeline.php">Delete Timeline</a>
    <a href="http://localhost/FoodGuard/dashboard.php">Dashboard</a>
    <a href="http://localhost/FoodGuard/home.php">Logout</a>
</div>
    
        <h2>List of Cafes and Restaurants in UTM</h2>
   

    <br><br>
    <div class="content">
    <div class="search-box">
    <label for="search">Search:</label>
    <input type="text" id="search" oninput="filterRestaurants()">
    <input type="button" value="Search" onclick="filterRestaurants()">
</div>
   
    <!-- First Row -->
  
    <?php
$result = $conn->query("SELECT id, restaurant_name FROM grade");

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='admin_view_restaurant.php?id={$row['id']}' style='color: #fff; text-decoration: none; padding: 10px; border: 2px solid #333; border-radius: 8px; display: block; font-weight: bold; font-size: 18px; transition: background-color 0.3s;'>{$row['restaurant_name']}</a></li>";
    }
    echo "</ul>";
} else {
    echo "No restaurants found.";
}

$conn->close();
?>

      
    </div> 

    

   
</body>
</html>
