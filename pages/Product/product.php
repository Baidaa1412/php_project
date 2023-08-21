<?php
require("conn.php");

$userId=1;
// Query to retrieve user information
$query = "SELECT picture ,name, price, description FROM product WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $userId); // $userId should be the user's ID you want to retrieve
$stmt->execute();

// Fetch the user information
$product = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./product.css">
</head>
<body>

      <!-- ---------------------------Display Product ---------------------- -->

    <div class="product-container">
        <img class="product-image" src="image" alt="Product Image">
        <div class="product-details">
          <h1 class="product-title"><?php echo $product['name']; ?></h1>
          <p class="product-description"><?php echo $product['price']; ?> $</p>
          <p class="product-price"><?php echo $product['description']; ?></p>
          <button class="add-to-cart-button">Add to Cart</button>
        </div>
      </div>

     <!-- ---------------------------/Display Product ---------------------- -->


      <!-- ---------------------------Text Area ---------------------- -->

      <div id="comments">
    <h2>Product Comments</h2>
    <div id="commentList"></div>
    
    <h3>Add Your Comment</h3>
    <form id="commentForm">
        <textarea id="commentText" placeholder="Your Comment" required></textarea>
        <button type="submit">Submit Comment</button>
    </form>
</div>

      <!-- ---------------------------/Text Area ---------------------- -->
      
    <script src="./product.js"></script>
</body>
</html>