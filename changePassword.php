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
$username = "root";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get data from HTML file
$oldpassword = $_POST['oldpassword'];
$hashedOldpass = hash('sha256', $oldpassword);

$newpassword = $_POST['newpassword'];
$confirmpassword = $_POST['confirmpassword'];


$encodedCookie = $_COOKIE['user_id'];
$encryptedValue = base64_decode($encodedCookie);
$userId = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

  $sqlUser = "SELECT password FROM users where user_id = '$userId'";

  $result = $conn->query($sqlUser);
  

  if ($result->num_rows > 0) {
   
      $row = $result->fetch_assoc();
      $hashedPass = $row["password"];

      if ($hashedOldpass != $hashedPass) {
          echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Error!</strong> Old password does not not match.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
              ";
      } elseif ($newpassword != $confirmpassword) {
          echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Error!</strong> New password and confirm password do not match. Please try again.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
               ";
      } elseif (strlen($newpassword) < $passwordMinlength) {
          echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Password</strong>  must be at least $passwordMinlength characters long.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
               ";
      
      } elseif ($passwordUppercase && !preg_match('/[A-Z]/', $newpassword)) {
          echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Password</strong> must contain at least one uppercase letter.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
              ";
      
      } elseif ($passwordLowercase && !preg_match('/[a-z]/', $newpassword)) {
          echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Password</strong> must contain at least one lowercase letter.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
              ";
      
      } elseif ($passwordNumber && !preg_match('/[0-9]/', $newpassword)) {
            echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Password</strong> must contain at least one Number.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
              ";
      }
        else 
      {
          $hashedNewpass = hash('sha256', $newpassword);
          $sql = "UPDATE users SET password = '$hashedNewpass' WHERE user_id = '$userId'";
  
          if ($conn->query($sql) === TRUE) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Password!</strong> changed successfuly.
                <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>
            ";
          } else {
              echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Error</strong> updating password.
                  <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
              </div>
              ";
          }
      }
  
    } 
    else {
      echo "
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Error</strong> updating password.
          <a href='account.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
      </div>
      ";
  
    }
// Close the database connection
$conn->close();
?>
</blog>