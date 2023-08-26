<?php
include_once '../../../../php/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_SESSION['isLogedIn'][1];
  $data = file_get_contents('php://input');
  $data = json_decode($data);
  $inp = $data->inp;
  $changeable = $data->changeable;
  $res = $conn->query("UPDATE admin set $changeable = '$inp' where id = $id");
  echo json_encode($res);
} 
