<?php
require 'nusoap.php';

$client = new nusoap_client("http://localhost/Web_Services/Assignment/Book_Library_Webservices/bookstore_server.php?wsdl");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Book Price by ISBN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>The Paper Trail</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sriracha&display=swap');

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f5f5f5;
    }

    .header .logo {
        font-size: 25px;
        font-family: 'Sriracha', cursive;
        color: #000;
        text-decoration: none;
        margin-left: 30px;
    }

    .nav-items {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: #f5f5f5;
        margin-right: 20px;
    }

    .nav-items a {
        text-decoration: none;
        color: #000;
        padding: 35px 20px;
    }


    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        background: url('book_background.jpg') no-repeat center center fixed;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }
    
    .btn-default {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 4px;
    }

    .btn-default:hover {
        background-color: #555;
    }

    h2, h3 {
        color: #333;
    }

    /* CSS for footer */
    .footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #302f49;
      padding: 40px 80px;
      position: fixed;
      bottom: 0;
      width: 100%;
      height: 220px; 
    }

    .footer .copy {
      color: #fff;
    }

    .bottom-links {
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 40px 0;
    }

    .bottom-links .links {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0 40px;
    }

    .bottom-links .links span {
      font-size: 20px;
      color: #fff;
      text-transform: uppercase;
      margin: 10px 0;
    }

    .bottom-links .links a {
      text-decoration: none;
      color: #a1a1a1;
      padding: 10px 20px;
    }
  </style>
</head>
<body>
  <header class="header">
    <a href="#" class="logo">The Paper Trail</a>
    <nav class="nav-items">
      <a href="homepage.php">Home</a>
      <a href="isbn.php">ISBN Validation</a>
      <a href="index.html">Book Review</a>
      <a href="bookstore_client.php">Price Check</a>
      <a href="youtube.html">More Info</a>
    </nav>
  </header>

<div class="container">
  <h2>Book Prices by ISBN</h2>
  <form class="form-inline" action="" method="POST">
    <div class="form-group">
      <label for="isbn">ISBN</label>
      <input type="text" name="isbn" class="form-control" placeholder="Enter ISBN" required/>
    </div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
  <p>&nbsp;</p>
  <h3>
  <?php
	if(isset($_POST['submit']))
	{
		$isbn = $_POST['isbn'];
		
		$response = $client->call('get_price',array("isbn"=>$isbn));

		if(empty($response))
			echo "Price of that book is not available";
		else
			echo "Price: " . $response;
	}
   ?>
  </h3>
</div>
<footer class="footer">
    <div class="copy">&copy; 2023 Web Services Assignment</div>
    <div class="bottom-links">
      <div class="links">
        <span>More Info</span>
        <a href="homepage.php">Home</a>
        <a href="isbn.php">ISBN Validation</a>
        <a href="index.html">Book Review</a>
        <a href="bookstore_client.php">Price Check</a>
        <a href="youtube.html">More Info</a>
      </div>
    </div>
  </footer>
</body>
</html>
