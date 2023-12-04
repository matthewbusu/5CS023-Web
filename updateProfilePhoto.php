<?php

require_once 'access.php';

session_start();  

// Database connection parameters
$servername = "localhost";
$dbname = "blogdb";
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$encodedCookie = $_COOKIE['user_id'];
$encryptedValue = base64_decode($encodedCookie);
$userId = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
  $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/5CS023/img/profilePhoto/';
  
  $originalPhoto = $_FILES["image"]["name"];
  $extension = pathinfo($originalPhoto, PATHINFO_EXTENSION);
  $uniqueName = time() . '_' . uniqid() . '.' . $extension;
  $targetFile = $targetDir . $uniqueName;



      // Move the uploaded file to the specified directory
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
          // Save metadata to the database
          
          
          $photo = $uniqueName; 
          
          $sql = "UPDATE users SET photo = '$photo' WHERE user_id = '$userId'";
          
          

          if ($conn->query($sql) === TRUE) {
             
            $success = 1;
          } else {
              
                  
          }
      } else {
         
              $success = 10;
      }
  }
else {
  
  $success = 10;
}

$conn->close();

setcookie('success', $success, time()+3600, '/');
header("Location: account.php");

?>