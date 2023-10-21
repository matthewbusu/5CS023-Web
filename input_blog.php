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
$title = $_POST['title'];
$blog = $_POST['blog'];

// SQL query to insert data
$sql = "INSERT INTO blog (title, blog) VALUES ('$title', '$blog')";
if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Registration successful!";
    header("Location: Index_Blogger.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>