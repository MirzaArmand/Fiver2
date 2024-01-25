<!-- <?php
//include 'session_check.php';
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Guard</title>
    <link rel="icon" type="image/icon" href="http://localhost/FoodGuard/img/logo.png">
    <style>
         /* Set background color of body to white */ body { background-color: black; }

/* Define CSS class for header */ .header { font-family: Arial, sans-serif; color: #444; background-color: #F8F8F8; padding: 20px; text-align: center; font-size: 28px; }

/* Define CSS class for title */ .title { font-family: Arial, sans-serif; color: #444; background-color: #F8F8F8; padding: 20px; text-align: center; font-size: 24px; }

/* Define CSS class for navigation */ 
/* a:link, a:visited {
    background-color: #1A63FF;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;}


a:hover, a:active {
  background-color: blue;
} */

/* Define CSS class for main content */ .main { font-family: Arial, sans-serif; color: white; padding: 20px; margin: 20px; background-color: #F8F8F8; text-align: center; font-size: 16px; }

/* Define CSS class for footer */ .footer { font-family: Arial, sans-serif; color: #444; background-color: #F8F8F8; padding: 20px; text-align: center; font-size: 14px; }
    p {color:white}

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
body {
  font-family: 'Roboto', sans-serif;
  margin: 0;
  padding: 0;
  background-color: black;
  color: white;
  background-image: url("att.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
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

      
      


/* Timeline and main content */
.timeline {
    /* margin-left: 200px; /* Adjust this to leave space for the sidebar */
    /*padding: 20px; */
  }
  
  .timeline h1 {
    text-align: center;
    margin-bottom: 20px;
    color:white;
  }
  
  .posts {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .post {
    width: calc(33.33% - 20px); /* Adjust the width and gap between posts */
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 10px;
  }
  
  .post img {
    width: 100%;
    height: auto;
    display: block;
    margin-bottom: 10px;
  }

  .like-btn {
    border: none;
    background: none;
    cursor: pointer;
  }
  
  .like-btn i {
    font-size: 15px;
    color: #ccc; /* Default color */
  }
  
  .like-btn.liked i {
    color: #e74c3c; /* Liked color */
  }

  .comments {
    margin-top: 10px;
    padding-left: 15px;
}
  .comment {
    margin-bottom: 5px;
    /* Remove padding and background */
    padding: 0;
    background-color: transparent;
    /* Other styles as needed */
  }
  
  .comment p {
    font-size: 14px;
    margin: 0;
  }
  
  textarea {
    border: none; /* Remove default border */
    resize: none; /* Disable resizing */
    outline: none; /* Remove outline */
    background: none; /* Remove background */
    color: white;
    width: 100%; /* Adjust width as needed */
    font-size: 16px; /* Set font size */
    padding: 0; /* Adjust padding as needed */
    line-height: 1.5; /* Set line height */
    /* Other styles as needed */
  }
    </style>
</head>
<body>

<div class="sidebar">
<!-- <?php
    // Check if the user is logged in (you need to implement your own logic for this)
    // $userLoggedIn = true;

    // if ($userLoggedIn) {
    //     // Display user profile and logout button
    //     echo '<div class="user-profile">';
    //    // echo '<img src="path_to_user_avatar.jpg" alt="User Avatar">'; // Replace with the path to the user's avatar
    //     echo $username; // Replace with the actual username
    //     echo '</div>';
    //     echo '<button class="logout-btn" onclick="logout()">Logout</button>';
    // } else {
    //     // Display login link or any other content for non-logged-in users
    //     echo '<a href="login.html">Login</a>';
    // }
    ?> -->
     
      <div class="logo" style="display: flex; align-items: center;">
      <img src="http://localhost/FoodGuard/img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
      <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
    </div>
    <a class="active"href="http://localhost/FoodGuard/admin_home.php">Home</a>
    <a href="http://localhost/maps/map_admin.php">Restaurant Locator</a>
    <a href="http://localhost/FoodGuard/admin_list.php"> List of Cafes and Restaurants</a>
    <a href="http://localhost/maps/create.php">Add Restaurant</a>
    <a href="http://localhost/Review/Review/admin.html">Delete Review</a>
    <a href="http://localhost/FoodGuard/admin_timeline.php">Delete Timeline</a>
    <a href="http://localhost/FoodGuard/admin_dashboard.php">Dashboard</a>
    <a href="http://localhost/FoodGuard/logout.php">Logout</a>
    
</div>

<div class="content">
  <h2 style="color: white">Welcome Admin!</h2>
 
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
</div>

</body>
</html>
