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

// Database connection parameters
$servername = "localhost";
$dbname = "blogdb";
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// get data from HTML file
$name = $_POST['name'];
$encryptedName = openssl_encrypt($name, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$surname = $_POST['surname'];
$encryptedSurname = openssl_encrypt($surname, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$email = $_POST['email'];
$encryptedEmail = openssl_encrypt($email, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$password = $_POST['password'];

$quote = $_POST['quote'];

$sql = "SELECT * FROM users WHERE email = '$encryptedEmail'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
if (strlen($password) < $passwordMinlength) {
    echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Password</strong>  must be at least $passwordMinlength characters long.
            <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>
         ";

} elseif ($passwordUppercase && !preg_match('/[A-Z]/', $password)) {
    echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Password</strong> must contain at least one uppercase letter.
            <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>
        ";

} elseif ($passwordLowercase && !preg_match('/[a-z]/', $password)) {
    echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Password</strong> must contain at least one lowercase letter.
            <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>
        ";

} elseif ($passwordNumber && !preg_match('/[0-9]/', $password)) {
      echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Password</strong> must contain at least one Number.
            <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>
        ";
} else {
    $hashedPass = hash('sha256', $password);

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
                
                $sql = "INSERT INTO users (name, surname, email, password, photo, quote ) VALUES ('$encryptedName', '$encryptedSurname', '$encryptedEmail', '$hashedPass', '$photo', '$quote')";
                
                

                if ($conn->query($sql) === TRUE) {
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Registration Successful!</strong> Please log in and enjoy you time blogging with us.
                            <a href='login.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                        </div>
                        ";
                } else {
                    echo "
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Error</strong> There was a problem saving your data, please try again.
                            <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                        </div>
                        ";
                }
            } else {
                echo "     
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Error!</strong> Sorry, there was an error uploading your file.
                        <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                    </div>
                    ";
            }
        }
     else {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Sorry, there was an error uploading your file.
            <a href='register.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>
        ";
    }
}
} 

$conn->close();
?>
</body>