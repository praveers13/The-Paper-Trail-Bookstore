<?php
class Review{   
    // Define the name of the database table
    private $reviewTable = "book_review";      
    
    // Public properties to store review data
    public $isbn;
    public $book_name;
    public $author_name;
    public $price;
    public $review;
      
    // Database connection
    private $conn;
	
    // Constructor to initialize the database connection
    public function __construct($db){
        $this->conn = $db;
    }	
	
    // Function to read reviews
    function read() {	
        if ($this->isbn) {
            // Prepare a SQL SELECT statement to retrieve a specific review by ISBN
            $stmt = $this->conn->prepare("
                SELECT isbn, book_name, author_name, review FROM ".$this->reviewTable." 
                WHERE isbn = ?");
            $stmt->bind_param("s", $this->isbn);					
        } else {
            // Prepare a SQL SELECT statement to retrieve all reviews
            $stmt = $this->conn->prepare("SELECT * FROM ".$this->reviewTable);		
        }		
        $stmt->execute();			
        $result = $stmt->get_result();		
        return $result;	
    }

    // Function to create a new review
    function create(){
        // Prepare a SQL INSERT statement using a prepared statement to avoid SQL injection
        $stmt = $this->conn->prepare("
            INSERT INTO ".$this->reviewTable."(isbn, book_name, author_name, price, review)
            VALUES(?,?,?,?,?)");
        
        // Sanitize and bind variables to prevent SQL injection
        $this->isbn = htmlspecialchars(strip_tags($this->isbn));
        $this->book_name = htmlspecialchars(strip_tags($this->book_name));
        $this->author_name = htmlspecialchars(strip_tags($this->author_name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->review = htmlspecialchars(strip_tags($this->review));
        
        // Bind the variables to the SQL statement
        //"sssss" represents the datatype string, isbn - string, book_name-string, author_name-string, price-string, review-string
        $stmt->bind_param("sssss", $this->isbn, $this->book_name, $this->author_name, $this->price, $this->review);
        
        if($stmt->execute()){
            return true;
        }
     
        return false;		 
    }

    // Function to delete a review
    function delete(){
        // Prepare a SQL DELETE statement
        $stmt = $this->conn->prepare("
            DELETE FROM ".$this->reviewTable." 
            WHERE isbn = ?");
                
        // Sanitize and bind variables to prevent SQL injection
        $this->isbn = htmlspecialchars(strip_tags($this->isbn));
         
        // Bind the ISBN variable to the SQL statement
        $stmt->bind_param("s", $this->isbn);
         
        if($stmt->execute()){
            return true;
        }
         
        return false;
    }
}
?>
