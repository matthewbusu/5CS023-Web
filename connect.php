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

// SQL query to insert data
$sql = "INSERT INTO users (name, surname, email, password) VALUES ('$name', '$surname', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
    header("Location: login.html");
} else {
    echo "<script>alert('Error: $error_message');</script>";
}

$conn->close();
?>
