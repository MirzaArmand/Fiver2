<?php
include "connect.php";

// Fetch the list of restaurants from the database
$sql = "SELECT id, name FROM markers";
$result = $conn->query($sql);

// Check if there are restaurants available
if ($result->num_rows > 0) {
    $restaurants = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $restaurants = array();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $restaurantId = $_POST["restaurant"];
    $userName = $_POST["user_name"];
    $rating = $_POST["rating"];
    $reviewText = $_POST["reviewText"];

    // Check if the selected restaurant ID exists in the markers table
    $checkRestaurantSql = "SELECT id FROM markers WHERE id = '$restaurantId'";
    $result = $conn->query($checkRestaurantSql);

    if ($result->num_rows > 0) {
        // Insert the review into the database
        $insertSql = "INSERT INTO reviews (restaurant_id, user_name, rating, review_text) VALUES ('$restaurantId', '$userName', '$rating', '$reviewText')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Review submitted successfully.";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    } else {
        echo "Selected restaurant ID does not exist in the markers table.";
    }
}

// Close the MySQL connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/Review/Review/style.css"/>
    <title>Restaurant Reviews</title>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
            crossorigin="anonymous"
    />
</head>
<body>
<div class="sidebar">
    <div class="logo" style="display: flex; align-items: center;">
        <img src="http://localhost/FoodGuard/img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
        <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
    </div>
    <a href="http://localhost/FoodGuard/foodguard.php">Home</a>
    <a class="active" href="#review">Review Form</a>
    <a href="http://localhost/maps/map.php">Restaurant Locator</a>
    <a href="http://localhost/FoodGuard/user_dashboard.php">Dashboard</a>
    <a href="http://localhost/FoodGuard/home.php">Logout</a>
</div>

<div class="container">
    <h1>Please State Your Review</h1>
    <form method="post" action="">
        <label for="restaurant">Select a restaurant:</label>
        <select name="restaurant" id="restaurant" required>
            <?php foreach ($restaurants as $restaurant): ?>
                <option value="<?php echo $restaurant['id']; ?>"><?php echo $restaurant['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="user_name">Your Name:</label>
        <input type="text" id="user_name" name="user_name" required/>

        <label for="rating">Rating:</label>
        <div id="ratingOptions">
            <input type="radio" id="rating1" name="rating" value="1" required/>
            <label for="rating1">1</label>

            <input type="radio" id="rating2" name="rating" value="2"/>
            <label for="rating2">2</label>

            <input type="radio" id="rating3" name="rating" value="3"/>
            <label for="rating3">3</label>

            <input type="radio" id="rating4" name="rating" value="4"/>
            <label for="rating4">4</label>

            <input type="radio" id="rating5" name="rating" value="5"/>
            <label for="rating5">5</label>
        </div>

        <label for="reviewText">Review:</label>
        <textarea id="reviewText" name="reviewText" required></textarea>

        <input type="submit" value="Submit Review">
    </form>
</div>
</body>
</html>
