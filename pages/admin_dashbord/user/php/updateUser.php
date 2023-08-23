<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $json = file_get_contents('php://input');
  $user = json_decode($json);

  $id = $user->id;
  $picture = $user->picture;
  $name = $user->name;
  $Email = $user->email; 
  $PhoneNumber = $user->phoneNumber;
  $file = explode(',' ,$picture);
  $URI = $file[0];
  $picture = base64_decode($file[1]); 
  

  $stmt = $conn->prepare("UPDATE user 
  SET picture = :picture, name = :name , email = :Email,phone_number = :PhoneNumber , pictureURI = :URI 
  WHERE id = :id");

  $stmt->bindParam(':picture', $picture);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':Email', $Email);
  $stmt->bindParam(':PhoneNumber', $PhoneNumber);
  $stmt->bindParam(':URI', $URI);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  if($stmt)
    echo json_encode('succecful');
  else
    echo json_encode('failed'); 
}
