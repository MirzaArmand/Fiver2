<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="admin-style.css" />
  <title>Admin Dashboard</title>
</head>
<body>
  <div class="admin-container">
    <h1>Admin Dashboard</h1>
    
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

    // Fetch all data from the reviews table
    $sql = "SELECT * FROM reviews";
    $result = $conn->query($sql);

    // Display data in a table
    if ($result->num_rows > 0) {
      echo '<table border="1">';
      echo '<tr><th>ID</th><th>Name</th><th>Review</th></tr>';
      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['review'] . '</td>';
        echo '<td><form action="delete.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="submit" value="Delete"></form></td>';
        echo '</tr>';
      }
      echo '</table>';
    } else {
      echo 'No data found';
    }

    // Close connection
    $conn->close();
    ?>
  </div>
  <script src="admin-script.js"></script>
</body>
</html>

