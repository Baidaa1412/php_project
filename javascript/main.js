function redirectToPage() {
    window.location.href = "./index.php";
  }
 
  document.addEventListener("DOMContentLoaded", function() {
    var userDropdown = document.getElementById("userDropdown");
  
    userDropdown.addEventListener("click", function() {
      var dropdown = this.querySelector(".dropdown");
      dropdown.classList.toggle("show");
    });
  
    // إغلاق القائمة المنسدلة إذا تم النقر خارجها
    window.addEventListener("click", function(event) {
      if (!event.target.matches('.user *')) {
        var dropdowns = document.querySelectorAll(".dropdown");
        dropdowns.forEach(function(dropdown) {
          if (dropdown.classList.contains("show")) {
            dropdown.classList.remove("show");
          }
        });
      }
    });
  });