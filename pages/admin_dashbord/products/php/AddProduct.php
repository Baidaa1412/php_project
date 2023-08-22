<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $json = file_get_contents('php://input');
  $product = json_decode($json);

  $picture = $product->picture;
  $name = $product->name;
  $stock = $product->stock;
  $discount = $product->discount;
  $price = $product->price;
  $bestSeller = $product->best_seller;
  $file = explode(',' ,$picture);
  $URI = $file[0];
  $picture = base64_decode($file[1]); 
 
  $stmt = $conn->prepare("INSERT INTO product (picture, name, price, stock, is_best_seller, discount, URI , category_id) 
  VALUES (:picture, :name, :price, :stock, :bestSeller, :discount, :URI , 1)");
  

  $stmt->bindParam(':picture', $picture);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':stock', $stock);
  $stmt->bindParam(':bestSeller', $bestSeller);
  $stmt->bindParam(':discount', $discount);
  $stmt->bindParam(':URI', $URI);
  $stmt->execute();

  if($stmt)
    echo json_encode('succecful');
  else  
    echo json_encode('failed');  
}
