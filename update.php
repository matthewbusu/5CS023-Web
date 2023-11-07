<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get data from HTML file
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password']; 

$userId = $_COOKIE['user_id'];

// SQL query to insert data
$sql = "UPDATE users SET name = '$name', surname = '$surname', email = '$email' WHERE user_id = '$userId'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Update successful!";
    header("Location: Index_Blogger.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
