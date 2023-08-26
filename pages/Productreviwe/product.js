function redirectToPage() {
    window.location.href = "../../index.php";
  }
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

    addToCartButton.addEventListener("click", function(e) {
      const quantity = parseInt(quantityInput.value);
      let product ={
        id:e.currentTarget.getAttribute("data-id"),
        quantity:quantity
      }
      if (quantity > 0) {
        fetch("./addToCart.php", {
          method: "POST",
          headers: {
            "Content0-Type": "application/json",
          },
          body: JSON.stringify(product),
        })
      }
      
    });
 
  });