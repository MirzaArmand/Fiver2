function submitReview() {
    const restaurantDropdown = document.getElementById("restaurantName");
    const restaurantName = restaurantDropdown.options[restaurantDropdown.selectedIndex].value;
    const userName = document.getElementById("userName").value;
    
    // Get the selected rating
    const selectedRating = document.querySelector('input[name="rating"]:checked');
    const rating = selectedRating ? selectedRating.value : value;

    const reviewText = document.getElementById("reviewText").value;

    console.log("Data:", restaurantName, userName, rating, reviewText);


    const formData = new FormData();
    formData.append("restaurantName", restaurantName);
    formData.append("userName", userName);
    formData.append("rating", rating);
    formData.append("reviewText", reviewText);

    fetch("submit_review.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Review submitted successfully!");
            // Clear form or update UI as needed
            document.getElementById("reviewForm").reset();
            // Fetch and display updated reviews
            fetchReviews();
        } else {
            alert("Error submitting review. Please try again.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
