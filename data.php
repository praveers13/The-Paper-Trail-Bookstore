<?php

function get_price($isbn)
{
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'review_db';

    // Create a connection to the database
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the query
    $stmt = $conn->prepare("SELECT price FROM book_review WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);

    // Execute the query
    $stmt->execute();

    // Get the result
    $stmt->bind_result($price);
    $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return isset($price) ? $price : null;
}
