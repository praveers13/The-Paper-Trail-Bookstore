<?php
// Set headers to allow cross-origin requests and define allowed methods and headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include necessary files
require_once ('db.php'); //  this file contains database connection code
require_once ('functions.php'); // this file contains additional functions (delete)

// Create a new instance of the Database class to establish a database connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Review class, passing the database connection
$review = new Review($db);

// Retrieve JSON data from the request's body and decode it
$data = json_decode(file_get_contents("php://input"));

// Check if the 'isbn' field is present in the JSON data
if (!empty($data->isbn)) {
	// Assign the 'isbn' value from JSON data to the Review object's property
	$review->isbn = $data->isbn;

	// Attempt to delete a review record from the database based on the provided ISBN
	if ($review->delete()) {    
		http_response_code(200); // Set response code to 200 OK
		echo json_encode(array("message" => "Review was deleted."));
	} else {    
		http_response_code(503); // Set response code to 503 Service Unavailable
		echo json_encode(array("message" => "Unable to delete review."));
	}
} else {
	http_response_code(400); // Set response code to 400 Bad Request
    echo json_encode(array("message" => "Unable to delete review. Data is incomplete."));
}
?>
