document.addEventListener("DOMContentLoaded", function() {
    // Get references to various HTML elements by their IDs or classes
    const links = document.querySelectorAll(".links a");
    const sections = document.querySelectorAll(".section");
    const fetchButton = document.getElementById("fetchButton");
    const createButton = document.getElementById("createButton");
    const deleteButton = document.getElementById("deleteButton");
    const isbnInput = document.getElementById("isbn");
    const createIsbnInput = document.getElementById("createIsbn");
    const deleteIsbnInput = document.getElementById("deleteIsbn");
    const bookNameInput = document.getElementById("book_name");
    const authorNameInput = document.getElementById("author_name");
    const priceInput = document.getElementById("price");
    const reviewInput = document.getElementById("review");
    const reviewContainer = document.getElementById("reviewContainer");
    const createMessage = document.getElementById("createMessage");
    const updateMessage = document.getElementById("updateMessage");
    const deleteMessage = document.getElementById("deleteMessage");

    // Event listeners for navigation links
    links.forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            const targetSectionId = this.getAttribute("href");
            // Hide all sections and display the target section
            sections.forEach(section => {
                section.style.display = "none";
            });
            document.querySelector(targetSectionId).style.display = "block";
        });
    });

    // Event listener for fetching reviews
    fetchButton.addEventListener("click", function() {
        const isbn = isbnInput.value.trim();
        if (isbn !== "") {
            fetchReviews(isbn);
        }
    });

    // Event listener for creating a review
    createButton.addEventListener("click", function() {
        const isbn = createIsbnInput.value.trim();
        const bookName = bookNameInput.value.trim();
        const authorName = authorNameInput.value.trim();
        const price = priceInput.value.trim();
        const review = reviewInput.value.trim();

        if (isbn !== "" && bookName !== "" && authorName !== "" && price !== "" && review !== "") {
            createReview(isbn, bookName, authorName, price, review);
        } else {
            createMessage.textContent = "Please fill in all fields.";
        }
    });

    // Event listener for deleting a review
    deleteButton.addEventListener("click", function() {
        const isbn = deleteIsbnInput.value.trim();

        if (isbn !== "") {
            deleteReview(isbn);
        } else {
            deleteMessage.textContent = "Please enter an ISBN.";
        }
    });

    // Function to fetch reviews using a provided ISBN
    function fetchReviews(isbn) {
        // Display a loading message while fetching
        reviewContainer.innerHTML = "Fetching reviews...";

        // Make an HTTP GET request to fetch reviews
        fetch("http://localhost/WebService_Assignment/The-Paper-Trail-Bookstore/read.php?isbn=" + isbn)
            .then(response => response.json())
            .then(data => {
                if (data.records) {
                    // If reviews are found, display them in the container
                    const reviews = data.records;
                    let reviewHtml = "";
                    reviews.forEach(review => {
                        reviewHtml += `
                            <div class="review-item">
                                <p><strong>Book Name:</strong> ${review.book_name}</p>
                                <p><strong>Author:</strong> ${review.author_name}</p>
                                <p><strong>Review:</strong> ${review.review}</p>
                            </div>
                        `;
                    });
                    reviewContainer.innerHTML = reviewHtml;
                } else {
                    // If no reviews are found, display a message
                    reviewContainer.innerHTML = "No reviews found.";
                }
            })
            .catch(error => {
                console.error("Error fetching reviews:", error);
                reviewContainer.innerHTML = "An error occurred while fetching reviews.";
            });
    }

    // Function to create a new review
    function createReview(isbn, bookName, authorName, price, review) {
        const data = {
            isbn: isbn,
            book_name: bookName,
            author_name: authorName,
            price: price,
            review: review
        };

        // Display a message while creating the review
        createMessage.textContent = "Creating review...";

        // Make an HTTP POST request to create a review
        fetch("http://localhost/WebService_Assignment/The-Paper-Trail-Bookstore/create.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.message === "Review was created.") {
                createMessage.textContent = "Review created successfully.";
            } else {
                createMessage.textContent = "Failed to create review.";
            }
        })
        .catch(error => {
            console.error("Error creating review:", error);
            createMessage.textContent = "An error occurred while creating the review.";
        });
    }

    // Function to delete a review
    function deleteReview(isbn) {
        // Display a message while deleting the review
        deleteMessage.textContent = "Deleting review...";

        const data = {
            isbn: isbn
        };

        // Make an HTTP POST request to delete a review
        fetch("http://localhost/WebService_Assignment/The-Paper-Trail-Bookstore/delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.message === "Review was deleted.") {
                deleteMessage.textContent = "Review deleted successfully.";
            } else {
                deleteMessage.textContent = "Failed to delete review.";
            }
        })
        .catch(error => {
            console.error("Error deleting review:", error);
            deleteMessage.textContent = "An error occurred while deleting the review.";
        });
    }
});
