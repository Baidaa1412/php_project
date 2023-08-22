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

    $stmt = $conn->prepare("SELECT p.name AS 'product_name', SUM(op.quantity) AS 'total_sold_quantity' FROM orders o JOIN orders_product op ON o.id = op.orderId JOIN product p ON op.product_id = p.id GROUP BY p.name ORDER BY total_sold_quantity DESC LIMIT 8;
    ");

    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res;

    $stmt = $conn->prepare("SELECT 
    (SELECT SUM(p.stock) FROM product p) AS 'total_available_stock',
    (SELECT SUM(op.quantity) FROM orders o JOIN orders_product op ON o.id = op.orderId WHERE DATE(o.data_of_order) = CURDATE()) AS 'total_sold_quantity_today',
    (SELECT SUM(op.quantity) FROM orders_product op) AS 'total_sold_items',
    (SELECT COUNT(*) FROM category) AS 'number_of_categories';
");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    $stmt = $conn->prepare("SELECT name , id, picture,URI, stock, discount, price, is_best_seller AS 'best_seller' ,status FROM product");
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
