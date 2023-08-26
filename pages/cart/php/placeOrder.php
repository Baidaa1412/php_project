<?php
include_once '../../../php/connection.php';

// session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $address = file_get_contents('php://input');

  // $userId = $_SESSION['userId'];
  $userId = 1;

  $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
  $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

  $result = $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $cartId = $result['id'];


  $stmt = $conn->prepare("INSERT INTO orders (customer_id, address) VALUES (:userId, :address)");
  $stmt->bindParam(':address', $address);
  $stmt->bindParam(':userId', $userId);
  $result = $stmt->execute();

  $lastInsertedId = $conn->lastInsertId();


  $stmt = $conn->prepare("SELECT product_id, quantity FROM cart_products WHERE cart_id = :cart_id");
  $stmt->bindParam(':cart_id', $cartId);
  $stmt->execute();

  $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmt = $conn->prepare("INSERT INTO orders_product (orderId, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
  foreach ($result as $row) {
    $stmt->bindParam(':order_id', $lastInsertedId);
    $stmt->bindParam(':product_id', $row['product_id']);
    $stmt->bindParam(':quantity', $row['quantity']);
    $stmt->execute();
  }
  $conn->query("delete from cart_products where cart_id = $cartId");
  header('Location: ../../../index.php');
}
