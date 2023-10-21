<?php
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
    header("Location: Index_blogger.php");
    exit();
} else {
    // Invalid credentials
    echo "Invalid email or password";
}

$conn->close();
}
?>