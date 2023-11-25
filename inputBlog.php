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

session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    exit();
}

// Database connection parameters
$servername = "localhost";
$dbname = "blogdb";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get data from HTML file
$title = $_POST['title'];
$blog = $_POST['blog'];


$encodedCookie = $_COOKIE['user_id'];

$encryptedValue = base64_decode($encodedCookie);

$userId = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);


if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/5CS023/img/blogImg/';

    
    $originalPhoto = $_FILES["image"]["name"];
    $extension = pathinfo($originalPhoto, PATHINFO_EXTENSION);
    $uniqueName = time() . '_' . uniqid() . '.' . $extension;
    $targetFile = $targetDir . $uniqueName;

    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
       
        $filename = $uniqueName; 
        $sql = "INSERT INTO blog (user_id, title, blog, filename) VALUES ('$userId', '$title', '$blog', '$filename')";

        if ($conn->query($sql) === TRUE) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success</strong> Your post has been added to everyone's wall.
                <a href='indexBlogger.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error</strong> Sorry, there was an error with this upload.
                <a href='blogger.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>
            ";
        }
    } else {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error</strong> Sorry, there was an error with this upload.
            <a href='blogger.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>
        ";
    }
} else {
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Error</strong> There is a problem when uploading the image to the blog.
        <a href='blogger.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
    </div>
    ";
}


$conn->close();





?>