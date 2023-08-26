<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data = file_get_contents('php://input');
  $data = json_decode($data);
  $id = $data->id;
  $status = $data->status;

  $res = $conn->query("UPDATE orders set status = $status where id = $id");
}
