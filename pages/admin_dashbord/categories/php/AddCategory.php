<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $json = file_get_contents('php://input');
  $category = json_decode($json);

  $picture = $category->picture;
  $name = $category->name;

  $file = explode(',' ,$picture);
  $URI = $file[0];
  $picture = base64_decode($file[1]); 
 
  $stmt = $conn->prepare("INSERT INTO category (image, name, imageURL) 
  VALUES (:picture, :name, :URI)");
  

  $stmt->bindParam(':picture', $picture);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':URI', $URI);
  $stmt->execute();

  if($stmt)
    echo json_encode('succecful');
  else  
    echo json_encode('failed');  
}
