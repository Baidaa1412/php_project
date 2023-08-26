<?php
include_once '../../php/connection.php';
// session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $json = file_get_contents('php://input');
  $data = json_decode($json);
  $userId = 1;
  $productId = $data->id;
  $quantity = $data->quantity;

  $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
  $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

  $result = $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $cartId = $result['id'];



  $stmt = $conn->prepare("INSERT INTO cart_products (cart_id, product_id, quantity)
  VALUES (:cart_id, :product_id, :quantity)
  ON DUPLICATE KEY UPDATE quantity = quantity + :new_quantity");


  $stmt->bindParam(':cart_id', $cartId);
  $stmt->bindParam(':product_id', $productId);
  $stmt->bindParam(':quantity', $quantity);
  $stmt->bindParam(':new_quantity', $quantity);
  $stmt->execute();

  if ($stmt)
    echo json_encode('succecful');
  else
    echo json_encode('failed');
}
