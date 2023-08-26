<?php
include_once '../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  session_start();
  $userId = $_SESSION['userId'];
  $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
  $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

  $result = $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $cartId = $result['id'];

  $newstmt = $conn->prepare("SELECT p.id, p.picture as 'picture' , p.URI as 'pictureURL' ,p.name , cp.quantity , p.price from cart c join cart_products cp on cp.cart_id = c.id join product p on p.id = cp.product_id where cp.cart_id = :cartId;
  ");
  $newstmt->bindParam(':cartId', $cartId);
  $result = $newstmt->execute();
  $result = $newstmt->fetchAll(PDO::FETCH_ASSOC);
  
  foreach ($result as &$value) {
    $value['picture'] = base64_encode($value['picture']);
  }
  echo json_encode($result);
}
