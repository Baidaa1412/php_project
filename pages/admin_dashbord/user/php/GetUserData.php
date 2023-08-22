<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();
  $cred = $_SESSION['isLogedIn'];

  $respone = [];
  if ($cred[0]) {
    $stmt = $conn->prepare('SELECT * FROM admin WHERE id = :id');
    $stmt->bindParam(':id', $cred[1]);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    $stmt = $conn->prepare("select picture , pictureURI , email , phone_number ,address , name from user ");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as &$value) {
      $value['picture'] = base64_encode($value['picture']);
    }
    $respone[] = $res;
    if ($stmt)
      echo json_encode($respone);
    else
      echo json_encode('failed');
  }
}
