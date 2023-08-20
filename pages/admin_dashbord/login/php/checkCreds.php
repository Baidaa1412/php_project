<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

$stmt = $conn->prepare('SELECT * FROM admin WHERE :email = email and :password = password');

$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($stmt->rowCount() === 0)
  echo json_encode('invalied');
else{
  session_start();
  $_SESSION['isLogedIn'] = true;
  echo json_encode('valid');
}

}