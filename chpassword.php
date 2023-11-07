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
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$confirmpassword = $_POST['confirmpassword'];


  $userId = $_COOKIE['user_id'];

  $sqlUser = "SELECT password FROM users where user_id = '$userId'";

  $result = $conn->query($sqlUser);


  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $password = $row["password"];
    
  } else {
      
  }

if ($oldpassword != $password) 
    {
        echo "Invalid old password. Please try again.";
    } 
elseif ($newpassword != $confirmpassword) 
    {
        echo "New password and confirm password do not match. Please try again.";
    } 
else 
    {
        $sql = "UPDATE users SET password = '$newpassword' WHERE user_id = '$userId'";

        if ($conn->query($sql) === TRUE) {
            echo "Password changed successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }


// Close the database connection
$conn->close();
?>
