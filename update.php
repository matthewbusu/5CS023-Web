<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Blog</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>  
</head>
<body>

<?php

require_once 'access.php';

// Database connection parameters
$servername = "localhost";
$username = "root";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get data from HTML file
$name = $_POST['name'];
$encryptedName = openssl_encrypt($name, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$surname = $_POST['surname'];
$encryptedSurname = openssl_encrypt($surname, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$email = $_POST['email'];
$encryptedEmail = openssl_encrypt($email, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$encodedCookie = $_COOKIE['user_id'];
$encryptedValue = base64_decode($encodedCookie);
$userId = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

// SQL query to insert data
$sql = "UPDATE users SET name = '$encryptedName', surname = '$encryptedSurname', email = '$encryptedEmail' WHERE user_id = '$userId'";

if ($conn->query($sql) === TRUE) {
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your personal details have been changed successfuly.
        <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
    </div>
    ";
} else {
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> There was a problem with updating you personal details. 
        <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
    </div>
    ";
}

$conn->close();
?>
</body>