<?php
$host = 'localhost';
$dbname = 'presentodb';
$username = 'root';
$password = '';

// $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);


// Check if the connection was successful
// if ($conn) {
//     echo "Connected to the database successfully!";
// } else {
//     echo "Connection failed!";
// }

try{
  $conn = new PDO("mysql:host=localhost;dbname=presentodb", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "database error" . $e->getMessage();
}
?>