<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = $_POST['term'];

$sql = "SELECT country_name FROM country WHERE country_name LIKE '$searchTerm%'";
$result = $conn->query($sql);

if ($result) {
    $suggestions = array();
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['country_name'];
    }
    echo json_encode(['suggestions' => $suggestions]);
} else {
    echo json_encode(['suggestions' => []]);
}

// Close the database connection
$conn->close();
?>
