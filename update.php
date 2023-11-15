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
    $_SESSION['success_message'] = "Update successful!";
    header("Location: account.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
