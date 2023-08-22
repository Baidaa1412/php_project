<?php
// checkout.php
session_start();
// Include header and navigation
include '../../php/connection.php'; // Include your PDO connection file

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo '<h1>Checkout</h1>';
    // Display form for shipping info, payment, etc.

    // Fetch and display product details for each item in the cart
    foreach ($_SESSION['cart'] as $productID) {
        // Fetch product details from the database based on $productID
        $productQuery = "SELECT * FROM product WHERE id = :productID";
        $productStatement = $conn->prepare($productQuery);
        $productStatement->bindParam(':productID', $productID, PDO::PARAM_INT);
        $productStatement->execute();
        $product = $productStatement->fetch(PDO::FETCH_ASSOC);

        // Display the product details within the checkout form
        echo '<div class="checkout-item">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($product['picture']) . '" alt="Product Image">';
        echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
        echo '<p>Price: JD' . htmlspecialchars($product['price']) . '</p>';
        // Additional checkout form fields, payment info, etc.
        echo '</div>';
    }

    // Display the total and the rest of the checkout form
} else {
    echo '<p>Your cart is empty.</p>';
}
?>