<?php

require_once 'access.php';


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
$name = $_POST['name'];
$encryptedName = openssl_encrypt($name, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$surname = $_POST['surname'];
$encryptedSurname = openssl_encrypt($surname, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$email = $_POST['email'];
$encryptedEmail = openssl_encrypt($email, 'aes-256-cbc', $encryptKey, 0, $encryptIV);

$password = $_POST['password'];

$quote = $_POST['quote'];
//$encryptedValue = openssl_encrypt($userId, 'aes-256-cbc', $encryptKey, 0, $encryptIV);
//$encodedValue = base64_encode($encryptedValue); 

// Password validation
if (strlen($password) < $passwordMinlength) {
    echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Password</strong>  must be at least $passwordMinlength characters long.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
         ";
} elseif ($passwordUppercase && !preg_match('/[A-Z]/', $password)) {
    echo "Password must contain at least one uppercase letter.";
} elseif ($passwordLowercase && !preg_match('/[a-z]/', $password)) {
    echo "Password must contain at least one lowercase letter.";
} elseif ($passwordNumber && !preg_match('/[0-9]/', $password)) {
      echo "Password must contain at least one number.";
} else {
    $hashedPass = hash('sha256', $password);
    // SQL query to insert data
    $sql = "INSERT INTO users (name, surname, email, password, photo, quote ) VALUES ('$encryptedName', '$encryptedSurname', '$encryptedEmail', '$hashedPass', 'photo.jpg', '$quote')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Registration successful!";
        header("Location: index.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 
}
     





/* if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/5CS023/img/';
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    echo "Phase 2";


    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "File already exists.";
    } else {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save metadata to the database
            $filename = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO users (name, surname, email, password, photo, quote ) VALUES ('$name', '$surname', '$email', '$password', '$filename', '$quote')";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: index.html");
            } else {
                echo "Error saving metadata to the database: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Error uploading file.";
} */






// SQL query to insert data
// $sql = "INSERT INTO users (name, surname, email, password, photo, quote ) VALUES ('$name', '$surname', '$email', '$hashedPass', 'photo.jpg', '$quote')";
// if ($conn->query($sql) === TRUE) {
//     $_SESSION['success_message'] = "Registration successful!";
//     header("Location: index.html");
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
$conn->close();
?>
