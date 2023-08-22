<?php
// Connect to the database (replace with your actual connection code)
$host = 'localhost';
$dbname = 'presentodb';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

if ($conn) {
    echo "";
} else {
    echo "Connection failed!";
}

?>