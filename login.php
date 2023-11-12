<?php

require_once 'access.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    session_start();

$servername = "localhost";
$username = "root";
$dbname = "test";


$conn = new mysqli($servername, $username, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];
$hashedPass = hash('sha256', $password);

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Successful login
    $_SESSION['authenticated'] = true;
    $sql = "SELECT user_id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];
        

        $encryptedValue = openssl_encrypt($userId, 'aes-256-cbc', $encryptKey, 0, $encryptIV);


        $encodedValue = base64_encode($encryptedValue);
        


        $_SESSION['user_id'] = $encodedValue;
        // Store user_id in a cookie valid for 1 hour
        setcookie('user_id', $encodedValue, time()+3600, '/');
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