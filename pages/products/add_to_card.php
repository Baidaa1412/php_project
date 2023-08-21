<?php
session_start();
require_once '../../php/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in
    // Redirect or show an error message
    // ...
} else {
    // User is logged in

    // Get the product ID from the request
    $product_id = $_POST['product_id']; // Assuming it's passed via POST

    // Get the cart ID from the session
    $cart_id = $_SESSION['cart_id'];

    // Insert the product into the cart
    $stmt = $conn->prepare("INSERT INTO cart_products (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, 1)");
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    // Set success message
    $_SESSION['success_message'] = 'Product added to cart successfully.';

    // Redirect the user to the cart page or show a success message
    // ...
}
?>

<!-- Add this HTML and JavaScript code to your HTML file -->
<div id="success-message" style="display: none;">
    <?php echo isset($_SESSION['success_message']) ? $_SESSION['success_message'] : ''; ?>
</div>

<script>
    // Display success message popup for 2 seconds
    var successMessage = document.getElementById('success-message');
    if (successMessage.innerHTML.trim() !== '') {
        successMessage.style.display = 'block';
        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 2000);
    }
</script>

<?php
unset($_SESSION['success_message']); // Clear the success message after displaying
?>