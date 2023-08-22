<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = json_decode(file_get_contents("php://input"));
  $stmt = $conn->prepare('update user set status = 0 where id = :id');
  $stmt->bindParam(':id' , $id);
  $stmt->execute();

  if($stmt)
    echo json_encode('notFalied');
  else
  echo json_encode("falied");
}