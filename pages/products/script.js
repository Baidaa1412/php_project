// Get all elements with the "add-to-cart-button" class
const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

// Iterate through each "Add to Cart" button
addToCartButtons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id'); // Get the product ID from the attribute

        // Send an AJAX request to add the product to the cart_products table
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true); // Replace 'add_to_cart.php' with your PHP script
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Product added successfully, show the popup message
                    const popup = document.getElementById('popup');
                    popup.style.display = 'block';
                    setTimeout(() => {
                        popup.style.display = 'none';
                    }, 2000); // Hide popup after 2 seconds
                } else {
                    console.error('Error adding product to cart:', xhr.responseText);
                }
            }
        };
        xhr.send(`product_id=${productId}`);
    });
});
