document.addEventListener("DOMContentLoaded", function () {
    fetchAdminReviews();
});

function fetchAdminReviews() {
    fetch("get_admin_review.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const adminReviewsList = document.getElementById("adminReviewsList");
                adminReviewsList.innerHTML = "";

                const table = document.createElement("table");
                table.className = "review-table";

                // Create table header
                const thead = document.createElement("thead");
                thead.innerHTML = `
                    <tr>
                        <th>Restaurant Name</th>
                        <th>User Name</th>
                        <th>Rating</th>
                        <th>Review Text</th>
                        <th>Action</th>
                    </tr>
                `;
                table.appendChild(thead);

                // Create table body
                const tbody = document.createElement("tbody");
                data.reviews.forEach(review => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${review.restaurant_name}</td>
                        <td>${review.user_name}</td>
                        <td>${review.rating}</td>
                        <td>${review.review_text}</td>
                        <td><button onclick="deleteReview(${review.id})">Delete</button></td>
                    `;
                    tbody.appendChild(row);
                });
                table.appendChild(tbody);

                adminReviewsList.appendChild(table);
            } else {
                console.error("Error fetching reviews.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function deleteReview(reviewId) {
    fetch(`delete_review.php?id=${reviewId}`, {
        method: "DELETE"
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchAdminReviews(); // Refresh the reviews after deletion
        } else {
            console.error("Error deleting review.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
