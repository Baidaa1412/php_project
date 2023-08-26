<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $json = file_get_contents('php://input');
  $user = json_decode($json);

  $picture = $user->picture;
  $name = $user->name;
  $email = $user->email;
  $phoneNumber = $user->phoneNumber;
  $address = $user->address;

  $file = explode(',' ,$picture);
  $URI = $file[0];
  $picture = base64_decode($file[1]); 
 
  $stmt = $conn->prepare("INSERT INTO user (picture, name,email , phone_number , address, pictureURI) 
  VALUES (:picture, :name,:email , :phone_number , :address, :URI)");
  

  $stmt->bindParam(':picture', $picture);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phone_number', $phoneNumber);
  $stmt->bindParam(':address', $address);
  $stmt->bindParam(':URI', $URI);
  $stmt->execute();

  if($stmt)
    echo json_encode('succecful');
  else  
    echo json_encode('failed');  
}
