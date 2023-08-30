<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Paper Trail</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sriracha&display=swap');

    body {
      margin: 0;
      box-sizing: border-box;
    }

    /* CSS for header */
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

    /* CSS for main element */
    .intro {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 520px;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), url("library_art.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .intro h1 {
      font-family: sans-serif;
      font-size: 60px;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0;
    }

    .intro p {
      font-size: 20px;
      color: #d1d1d1;
      text-transform: uppercase;
      margin: 20px 0;
    }

    .intro button {
      background-color: #5edaf0;
      color: #000;
      padding: 10px 25px;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4)
    }

    .achievements {
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 40px 80px;
    }

    .achievements .work {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0 40px;
    }

    .achievements .work i {
      width: fit-content;
      font-size: 50px;
      color: #333333;
      border-radius: 50%;
      border: 2px solid #333333;
      padding: 12px;
    }

    .achievements .work .work-heading {
      font-size: 20px;
      color: #333333;
      text-transform: uppercase;
      margin: 10px 0;
    }

    .achievements .work .work-text {
      font-size: 15px;
      color: #585858;
      margin: 10px 0;
    }

    .about-me {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 80px;
      border-top: 2px solid #eeeeee;
    }

    .about-me img {
      width: 500px;
      max-width: 100%;
      height: auto;
      border-radius: 10px;
    }

    .about-me-text h2 {
      font-size: 30px;
      color: #333333;
      text-transform: uppercase;
      margin: 0;
    }

    .about-me-text p {
      font-size: 15px;
      color: #585858;
      margin: 10px 0;
    }

    /* CSS for footer */
    .footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #302f49;
      padding: 40px 80px;
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

    h1 {
      text-align: center;
      padding: 20px;
      color: #333;
  }

    table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th, td {
      border: 1px solid #ddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <!-- navigation bar -->
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
  <main>
    <div class="intro">
      <h1>The Paper Trail Bookstore</h1>
      <p>Books are the plane, and the train, and the road. They are the destination, and the journey. They are home.</p>
      </div>
    <div class="achievements">
      <div class="work">
        <a href="isbn.php"> <i class="fa fa-book"></i></a>
        <p class="work-heading">ISBN Validation</p>
        <p class="work-text">Here, you can check the validity of your favourite book's ISBN code. You can check for both ISBN 10 and ISBN 13.</p>
      </div>
      <div class="work">
        <a href="index.html"> <i class="fas fa-atom"></i></a>
        <p class="work-heading">Book Review</p>
        <p class="work-text">You will be able to explore or update existing books, create new ones or even delete them.</p>
      </div>
      <div class="work">
        <a href="bookstore_client.php"> <i class="fa fa-dollar-sign"></i></a>
        <p class="work-heading">Price Check</p>
        <p class="work-text">If you ever find any of our books interesting and wish to provide yourself with one, you can check its price there.</p>
      </div>
    </div>
    <br>
    <h1>Bestsellers</h1>
    
    <?php
    $xml = simplexml_load_file('bestsellers.xml');
    
    if ($xml === false) {
        die('Error loading XML file.');
    }
    
    echo '<table>';
    echo '<tr><th>Name</th><th>Description</th></tr>';
    
    foreach ($xml->book as $book) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($book->name) . '</td>';
        echo '<td>' . htmlspecialchars($book->description) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
    ?>

    <br><br>
    <div class="about-me">
      <div class="about-me-text">
        <h2>About Us</h2>
        <p>This project has been created by Navish Khadooa and Praveer Seetahul.<br> Our respective student IDs are 2015349 and 2016328</p>
      </div>
      <img src="The-Crying-Book.jpg" alt="me">
    </div>
  </main>
  <!-- footer -->
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