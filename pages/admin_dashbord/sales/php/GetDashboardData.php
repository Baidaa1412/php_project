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

    $stmt = $conn->prepare("SELECT o.id AS 'order_id', u.name AS 'customer_name', u.email AS 'customer_email', u.phone_number AS 'customer_phone_number', o.address AS 'order_address', p.name AS 'product_name', op.quantity AS 'order_quantity', p.price AS 'product_price', c.name AS 'category_name', o.data_of_order as 'date_of_order', o.status as 'order_status' FROM orders o JOIN orders_product op ON o.id = op.orderId JOIN USER u ON u.id = o.customer_id JOIN product p ON op.product_id = p.id JOIN category c ON c.id = p.category_id ORDER by o.data_of_order DESC;

    ");

    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res;

    $stmt = $conn->prepare("SELECT DATE_FORMAT(data_of_order, '%Y-%m') AS month, MONTHNAME(data_of_order) AS month_name, COUNT(o.id) AS total_sales, SUM(p.price * op.quantity) AS total_revenue FROM orders o JOIN orders_product op ON op.orderId = o.id JOIN product p ON p.id = op.product_id GROUP BY month, month_name ORDER BY month;
    ");
      $stmt->execute();
      $respone[] = $stmt->fetchAll();

    echo json_encode($respone);
  } else
    echo json_encode('code_1');
}
