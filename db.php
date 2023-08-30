<?php
// Define a PHP class named Database
class Database{
	
	// Private properties to store database connection information
	private $host  = 'localhost';          // Database host
    private $user  = 'root';               // Database username
    private $password   = "";             // Database password
    private $database  = "review_db";     // Database name
    
    // Public method to establish a database connection
    public function getConnection(){		
		// Create a new mysqli object to connect to the database using provided credentials
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		
		// Check if there was an error while establishing the connection
		if($conn->connect_error){
			// If there was an error, terminate the script and display an error message
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			// If connection was successful, return the database connection object
			return $conn;
		}
    }
}
?>
