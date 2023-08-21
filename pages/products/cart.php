<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <!-- Add your CSS and JavaScript files here -->
</head>
<body>

<div class="main-container">
    <div class="product-container">
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        // Place your PHP code here<?php
session_start();
require_once '../../php/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in
    // Redirect or show an error message
echo "not loggedi in";
} else {
    // User is logged in

    // Get the cart ID from the session
    $cartId = $_SESSION['cart_id'];

    // Retrieve the products in the cart
    $stmt = $conn->prepare("SELECT cp.product_id, p.name, cp.quantity FROM cart_products cp INNER JOIN product p ON cp.product_id = p.id WHERE cp.cart_id =:cart_id");
    $stmt->bindParam(':cart_id', $cartId);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the products in the cart
    foreach ($products as $product) {
        echo "Product ID: " . $product['product_id'] . "<br>";
        echo "Name: " . $product['name'] . "<br>";
        echo "Quantity: " . $product['quantity'] . "<br>";
        echo "<br>";
    }
}
?>
    </div>
</div>

</body>
</html>