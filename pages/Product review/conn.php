<?php
// Connect to the database (replace with your actual connection code)
$host = 'localhost';
$dbname = 'presentodb';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Check if the connection was successful
// if ($conn) {
//     echo "Connected to the database successfully!";
// } else {
//     echo "Connection failed!";
// }

?>