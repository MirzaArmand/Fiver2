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
        <a class="active" href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
        <a href="">Cafes and Restaurants in UTM</a>
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
