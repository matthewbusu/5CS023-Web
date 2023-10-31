<?php

session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    exit();
}

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
//$sql = "INSERT INTO blog (title, blog) VALUES ('$title', '$blog')";
/*if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Registration successful!";
    header("Location: Index_Blogger.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/5CS023/img/';
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $userId = $_COOKIE['user_id'];


    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "File already exists.";
    } else {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save metadata to the database
            $filename = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO blog (user_id, title, blog, filename) VALUES ('$userId', '$title', '$blog', '$filename')";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: Index_blogger.php");
            } else {
                echo "Error saving metadata to the database: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Error uploading file.";
}


$conn->close();





?>