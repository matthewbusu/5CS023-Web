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

      if ($hashedOldpass != $hashedPass) 
      {
          echo "Old Password doesn't Match";
      } 
        elseif ($newpassword != $confirmpassword) 
      {
          echo "New password and confirm password do not match. Please try again.";
      } 
        elseif (strlen($newpassword) < $passwordMinlength)
      {
          echo "New Password does not meet the minimum Length";
      }
        elseif ($passwordUppercase && !preg_match('/[A-Z]/', $newpassword)) 
      {
          echo "Password must contain at least one uppercase letter.";
      }
        elseif ($passwordLowercase && !preg_match('/[a-z]/', $newpassword)) 
      {
          echo "Password must contain at least one lowercase letter.";
      } 
        elseif ($passwordNumber && !preg_match('/[0-9]/', $newpassword)) 
      {
          echo "Password must contain at least one number.";
      }
        else 
      {
          $hashedNewpass = hash('sha256', $newpassword);
          $sql = "UPDATE users SET password = '$hashedNewpass' WHERE user_id = '$userId'";
  
          if ($conn->query($sql) === TRUE) {
              echo "Password changed successfully.";
          } else {
              echo "Error updating password: " . $conn->error;
          }
      }
  
    } 
    else {
      echo "Error to update Password";
  
    }
  



// Close the database connection
$conn->close();
?>
