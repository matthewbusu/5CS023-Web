<?php

require_once 'access.php';

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


$encodedCookie = $_COOKIE['user_id'];

$encryptedValue = base64_decode($encodedCookie);

$userId = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

// SQL query to insert data

// if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
//     $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/5CS023/img/';
//     $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    

//     // Check if the file already exists
//     if (file_exists($targetFile)) {
//         echo "File already exists.";
//     } else {
//         // Move the uploaded file to the specified directory
//         if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
//             // Save metadata to the database
//             $filename = basename($_FILES["image"]["name"]);
//             $sql = "INSERT INTO blog (user_id, title, blog, filename) VALUES ('$userId', '$title', '$blog', '$filename')";
            
//             if ($conn->query($sql) === TRUE) {
//                 echo "
//                 <div class='alert alert-success alert-dismissible fade show' role='alert'>
//                     <strong>Success</strong> your post has been added to everyone's wall.
//                     <a href='Index_blogger.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
//                 </div>
//                 ";
//             } else {
//                 echo "
//                 <div class='alert alert-warning alert-dismissible fade show' role='alert'>
//                     <strong>Error</strong> Sorry, there was an error with this upload.
//                     <a href='blogger.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
//                 </div>
//                 ";
//             }
//         } else {
//             echo "
//             <div class='alert alert-warning alert-dismissible fade show' role='alert'>
//                 <strong>Error</strong> Sorry, there was an error with this upload.
//                 <a href='blogger.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
//             </div>
//             ";
//         }
//     }
// } else {
//     echo "
//       <div class='alert alert-warning alert-dismissible fade show' role='alert'>
//           <strong>Error</strong> There is a problem when uploading the Image to the blog.
//           <a href='blogger.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
//       </div>
//       ";
    
// }

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
                <a href='Index_blogger.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
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