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
$blog_id = $_POST['blog_id'];


 //SQL query to delete data
$sql = "DELETE FROM `blog` WHERE blog_id=$blog_id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Registration successful!";
    header("Location: myblogs.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>