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

    $stmt = $conn->prepare("SELECT p.name AS 'product_name', SUM(op.quantity) AS 'total_sold_quantity' FROM orders o JOIN orders_product op ON o.id = op.orderId JOIN product p ON op.product_id = p.id GROUP BY p.name ORDER BY total_sold_quantity DESC;
    ");

    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    $stmt = $conn->prepare("SELECT SUM(op.quantity) AS 'total_sold_quantity_today' FROM orders o JOIN orders_product op ON o.id = op.orderId JOIN product p ON op.product_id = p.id WHERE DATE(o.data_of_order) = CURDATE() GROUP BY p.name ORDER BY total_sold_quantity DESC;
    ;");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    $stmt = $conn->prepare("SELECT count(*) AS 'number_of_categories' FROM category");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    $stmt = $conn->prepare("SELECT SUM(op.quantity) AS 'total_sold_items' FROM orders o JOIN orders_product op ON o.id = op.orderId;");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    $stmt = $conn->prepare("SELECT id, picture, stock, discount, price, is_best_seller AS 'best_seller' FROM product");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respone[] = $res[0];

    echo json_encode($respone);

  } else
    echo json_encode('code_1');
}
