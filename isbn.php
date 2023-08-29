<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wsdl = 'http://webservices.daehosting.com/services/isbnservice.wso?WSDL';
    $client = new SoapClient($wsdl, array('trace' => 1));

    $ISBN = $_POST['ISBN'];
    $isbn_type = $_POST['ISBNtype'];

    $request_param = array(
        'sISBN' => $ISBN
    );

    try {
        switch ($isbn_type) {
            case 'ISBN13':
                $response_param = $client->IsValidISBN13($request_param);
                $validationResult = $response_param->IsValidISBN13Result;
                break;
            case 'ISBN10':
                $response_param = $client->IsValidISBN10($request_param);
                $validationResult = $response_param->IsValidISBN10Result;
                break;
        }

        if ($validationResult === true) {
            $status = "Valid " . $isbn_type;
        } else {
            $status = "Invalid " . $isbn_type;
        }
    } catch (Exception $e) {
        $status = "Exception Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ISBN Verification</title>
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
            background: url('book_background.jpg') no-repeat center center fixed;
            background-size: cover;
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

        form {
            margin-top: 20px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        h2 {
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
        <h2>ISBN Verification</h2>
        <form method="POST" action="isbn.php">
            <div class="form-group">
                <label for="ISBN">ISBN :</label>
                <input type="text" name="ISBN" id="ISBN" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ISBNtype">ISBN Type:</label>
                <select name="ISBNtype" id="ISBNtype" class="form-control" required>
                    <option value="ISBN13">ISBN13</option>
                    <option value="ISBN10">ISBN10</option>
                </select>
            </div>
            <input type="submit" value="Verify" class="btn btn-default">
        </form>
        <h3><?php echo isset($status) ? $status : ''; ?></h3>
    </div>
    <footer class="footer">
        <div class="copy">&copy; 2023 Web Services Assignment</div>
        <div class="bottom-links">
        <div class="links">
            <span>More Info</span>
            <a href="homepage.html">Home</a>
            <a href="isbn.php">ISBN Validation</a>
            <a href="index.html">Book Review</a>
            <a href="bookstore_client.php">Price Check</a>
            <a href="youtube.html">More Info</a>
        </div>
        </div>
    </footer>
</body>
</html>
