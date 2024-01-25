<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timeline</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
<div class="sidebar">
      <div class="logo" style="display: flex; align-items: center;">
        <img src="http://localhost/img/WhatsApp_Image_2024-01-02_at_9.34.56_PM-removebg-preview.png" alt="Logo" style="width: 50px; height: 50px;">
        <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
      </div>
      <a href="http://localhost/FoodGuard/foodguard.php">Home</a>
      <a href="http://localhost/Review/Review/index.html">Review Page</a>
      <a class="active" href="#restaurant locator">Restaurant Locator</a>
    </div>
  <div class="container">
    <div class="timeline">
      <h1>Timeline</h1>
      <!-- Form to post images -->
      <p> What's on your mind for today? </p>
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="text" name="caption" placeholder="What's on yr mind?" required>
        <input type="submit" value="Post">
      </form>
      <br>
      <br>
      <div class="posts">
        <?php include 'display_post.php'; ?>
      </div>
    </div>
  </div>

  <!-- Include JavaScript at the end of the body -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="like.js"></script> <!-- Your JavaScript file handling likes -->
</body>

</html>
