<?php

require_once 'access.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Successful login
    $_SESSION['authenticated'] = true;
    $sql = "SELECT user_id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];
        $encryptedValue = openssl_encrypt($userId, 'aes-256-cbc', $encryptionKey, 0, $encryptionKey);
        $_SESSION['user_id'] = $encryptedValue;
        // Store user_id in a cookie valid for 7 days
        setcookie('user_id', $encryptedValue, time() + (7 * 24 * 60 * 60), '/');
        header("Location: Index_blogger.php");
    }

    exit();
} else {
    // Invalid credentials
    echo "Invalid email or password";
}



$conn->close();
}

?>