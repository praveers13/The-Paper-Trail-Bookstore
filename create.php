<?php
// Set headers to allow cross-origin requests and define allowed methods and headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Check if the incoming request method is POST, otherwise return a 405 Method Not Allowed response
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(array("message" => "Invalid request method. Only POST requests are allowed."));
    exit(); // Terminate script execution
}

// Include necessary files
require_once('db.php'); // this file contains database connection code
require_once ('functions.php'); //  this file contains additional functions(create)

// Create a new instance of the Database class to establish a database connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Review class, passing the database connection
$review = new Review($db);

// Retrieve JSON data from the request's body and decode it
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are present in the JSON data
if (!empty($data->isbn) && !empty($data->book_name) &&
    !empty($data->author_name) && !empty($data->price) && !empty($data->review)) {

    // Assign JSON data to Review object's properties
    $review->isbn = $data->isbn;
    $review->book_name = $data->book_name;
    $review->author_name = $data->author_name;
    $review->price = $data->price;
    $review->review = $data->review;

    // Attempt to create a new review record in the database
    if ($review->create()) {
        http_response_code(201); // Set response code to 201 Created
        echo json_encode(array("message" => "Review was created."));
    } else {
        http_response_code(503); // Set response code to 503 Service Unavailable
        echo json_encode(array("message" => "Unable to create review."));
    }
} else {
    http_response_code(400); // Set response code to 400 Bad Request
    echo json_encode(array("message" => "Unable to create review. Data is incomplete."));
}
?>
