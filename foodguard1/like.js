$(document).ready(function() {
    // Function to toggle 'liked' class on the like button
    function toggleLike(button) {
      $(button).toggleClass('liked');
    }
  
    $('.like-btn').on('click', function() {
        var $clickedButton = $(this); // Store reference to the clicked button
        var postId = $clickedButton.data('post-id');
        var likeCount = $clickedButton.siblings('.like-count');
  
      // Perform an AJAX request
      $.ajax({
        type: 'POST',
        url: 'like_handler.php', // PHP script to handle the like action
        data: { postId: postId }, // Send the post ID to the server
        success: function(response) {
          if (response.status === 'success') {
            likeCount.text(response.likes); // Update the like count with the new value
            toggleLike($clickedButton); // Toggle 'liked' class on the clicked like button
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
  