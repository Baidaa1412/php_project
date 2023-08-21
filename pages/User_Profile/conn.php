<?php
// Connect to the database (replace with your actual connection code)
$host = 'localhost';
$dbname = 'presentodb';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// $userId=1;
// Query to retrieve user information
// $query = "SELECT name, email, bio FROM User WHERE id = :id";
// $stmt = $conn->prepare($query);
// $stmt->bindParam(':id', $userId); // $userId should be the user's ID you want to retrieve
// $stmt->execute();

// Fetch the user information
// $user = $stmt->fetch(PDO::FETCH_ASSOC);


// Check if the connection was successful
// if ($conn) {
//     echo "Connected to the database successfully!";
// } else {
//     echo "Connection failed!";
// }


?>