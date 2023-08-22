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

    $stmt = $conn->prepare("SELECT p.category_id, c.name AS category_name, DATE_FORMAT(o.data_of_order, '%Y-%m') AS month, COUNT(o.id) AS total_sales, SUM(p.price * op.quantity) AS total_revenue FROM orders o JOIN orders_product op ON op.orderId = o.id JOIN product p ON p.id = op.product_id JOIN category c ON c.id = p.category_id GROUP BY p.category_id, category_name, month ORDER BY month ASC, total_sales DESC;
    ");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res;

    $stmt = $conn->prepare("SELECT c.imageURL, c.id, c.image, c.name, COUNT(p.id) AS total_products FROM category c JOIN product p ON p.category_id = c.id GROUP BY c.image, c.name;
    ");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as &$value) {
      $value['image'] = base64_encode($value['image']);
    }
    $respone[] = $res;
    if ($stmt)
      echo json_encode($respone);
    else
      echo json_encode('failed');
  } else
    echo json_encode('code_1');
}
