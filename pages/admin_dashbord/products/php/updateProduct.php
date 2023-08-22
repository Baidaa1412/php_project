<?php
include_once '../../../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $json = file_get_contents('php://input');
  $product = json_decode($json);

  $id = $product->id;
  $picture = $product->picture;
  $name = $product->name;
  $stock = $product->stock;
  $discount = $product->discount;
  $price = $product->price;
  $bestSeller = $product->best_seller;
  $file = explode(',' ,$picture);
  $URI = $file[0];
  $picture = base64_decode($file[1]); 
 
  $stmt = $conn->prepare("UPDATE product 
  SET picture = :picture, name = :name, price = :price, stock = :stock, 
      is_best_seller = :bestSeller, discount = :discount , URI = :URI 
  WHERE id = :id");

  $stmt->bindParam(':picture', $picture);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':stock', $stock);
  $stmt->bindParam(':bestSeller', $bestSeller);
  $stmt->bindParam(':discount', $discount);
  $stmt->bindParam(':URI', $URI);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  if($stmt)
    echo json_encode('succecful');
  else  
    echo json_encode('failed');  
}
