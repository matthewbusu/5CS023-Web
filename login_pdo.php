<?php

// Database credentials
$host = 'localhost';
$dbname = 'test';
$user = 'root';
$pass = '';

// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$email = $_POST['email'];
$password = $_POST['password'];
$hashedPass = hash('sha256', $password);


// Prepare the SQL statement with placeholders
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");

// Bind parameters
$stmt->bindParam(':username', $email);
$stmt->bindParam(':password', $hashedPass);

// Execute the query
$stmt->execute();

// Fetch the result
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Do something with the result
// For example, check if the user exists
if (!empty($result)) {
    $_SESSION['authenticated'] = true;
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = :email");
    $stmt->bindParam(':username', $email);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($result)) {
        echo "Ok";
    }
} else {
    echo "Invalid email or password";
}

$pdo = null;


?>