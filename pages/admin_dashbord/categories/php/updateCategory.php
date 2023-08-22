<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $json = file_get_contents('php://input');
  $category = json_decode($json);

  $id = $category->id;
  $picture = $category->picture;
  $name = $category->name;

  $file = explode(',' ,$picture);
  $URI = $file[0];
  $picture = base64_decode($file[1]); 
 
  $stmt = $conn->prepare("UPDATE category 
  SET image = :picture, name = :name, imageURL = :URI 
  WHERE id = :id");

  $stmt->bindParam(':picture', $picture);
  $stmt->bindParam(':name', $name);

  $stmt->bindParam(':URI', $URI);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  if($stmt)
    echo json_encode('succecful');
  else  
    echo json_encode('failed');  
}
