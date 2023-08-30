<?php
// Set headers to allow cross-origin requests and define content type
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include necessary files
require_once 'db.php'; // this file contains database connection code
require_once 'functions.php'; //this file contains additional functions

// Create a new instance of the Database class to establish a database connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Review class, passing the database connection
$review = new Review($db);

// Get 'isbn' value from query parameters if provided, otherwise set it to an empty string
$review->isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';

// Call the 'read' function to fetch reviews based on provided ISBN
$result = $review->read();

// Check if there are reviews returned from the query
if ($result->num_rows > 0) {
    // Initialize an array to store the review records
    $review_arr = array();
    $review_arr["records"] = array();
    
    // Loop through each row returned from the query
    while ($row = $result->fetch_assoc()) {
        // Extract individual columns from the row
        extract($row);
        
        // Create a review item array for the current row
        $review_item = array(
            "isbn" => $isbn,
            "book_name" => $book_name,
            "author_name" => $author_name,
            "review" => $review
        );
        
        // Add the review item to the records array
        array_push($review_arr["records"], $review_item);
    }
    
    // Set response code to 200 OK
    http_response_code(200);
    
    // Encode and echo the review records as JSON
    echo json_encode($review_arr);
} else {
    // Set response code to 404 Not Found
    http_response_code(404);
    
    // Return a JSON message indicating no review found for the provided ISBN
    echo json_encode(
        array("message" => "No review found for the provided ISBN.")
    );
}
?>
