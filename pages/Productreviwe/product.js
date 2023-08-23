function redirectToPage() {
    window.location.href = "../../index.php";
  }// <!-- -----------------Table that display the comments --------------- -->
 document.addEventListener("DOMContentLoaded", function() {
    const addToCartButton = document.getElementById("add-to-cart");
    const quantityInput = document.getElementById("quantity");
    const increaseButton = document.getElementById("increase");
    const decreaseButton = document.getElementById("decrease");

    increaseButton.addEventListener("click", function() {
      quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    decreaseButton.addEventListener("click", function() {
      if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    });

    addToCartButton.addEventListener("click", function() {
      const quantity = parseInt(quantityInput.value);
      if (quantity > 0) {
        alert(`Added ${quantity} products to the cart`);
      }
      
    });
 
  });