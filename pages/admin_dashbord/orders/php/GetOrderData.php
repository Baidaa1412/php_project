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

    $stmt = $conn->prepare("SELECT o.id AS 'order_id', u.name AS 'customer_name', u.phone_number AS 'customer_phone_number', o.address AS 'order_address', p.name AS 'product_name', op.quantity AS 'order_quantity', p.price AS 'product_price', o.data_of_order AS 'date_of_order', o.status AS 'order_status', p.picture , p.URI as 'imageURL' FROM orders o JOIN orders_product op ON o.id = op.orderId JOIN USER u ON u.id = o.customer_id JOIN product p ON op.product_id = p.id JOIN category c ON c.id = p.category_id ORDER BY o.data_of_order DESC;
    ");

    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as &$value) {
      $value['picture'] = base64_encode($value['picture']);
    }
    $respone[] = $res;
    echo json_encode($respone);
  } else
    echo json_encode('code_1');
}
