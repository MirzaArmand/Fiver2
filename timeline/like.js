$(document).ready(function() {
    // Function to toggle 'liked' class on the like button
    function toggleLike(button) {
      $(button).toggleClass('liked');
    }
  
    // Listen for click events on like buttons
    $('.like-btn').on('click', function() {
      var postId = $(this).data('post-id'); // Get the post ID from data attribute
      var likeCount = $(this).siblings('.like-count'); // Reference to the like count element
  
      // Perform an AJAX request
      $.ajax({
        type: 'POST',
        url: 'like_handler.php', // PHP script to handle the like action
        data: { postId: postId }, // Send the post ID to the server
        success: function(response) {
          if (response.status === 'success') {
            // Update the like count or style the button to indicate it's been liked
            likeCount.text(response.likes); // Update the like count with the new value
            toggleLike($(this)); // Toggle 'liked' class on the clicked like button
            // You can also update the button style or disable it after a like
            // For example: $(this).prop('disabled', true);
          } else {
            alert('Failed to like the post. Please try again.'); // Handle failure
          }
        },
        error: function() {
          alert('Error: Unable to process the request.'); // Handle AJAX errors
        }
      });
    });
  });
  