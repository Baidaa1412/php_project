<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  session_start();

  try {
    $cred = $_SESSION['isLogedIn'];
  } catch (Exception $e) {
    echo json_encode('code_1');
    exit;
  }

  if ($cred[0]) {
    $stmt = $conn->prepare('SELECT * FROM admin WHERE id = :id');
    $stmt->bindParam(':id', $cred[1]);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($res[0]);
  } else
    echo json_encode('code_1');
}
