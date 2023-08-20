
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Document</title>
  <style>
   

.containerabout1 h4 {
  cursor: pointer;
}

.containerabout1 .description {
  display: none;
}

.containerabout1 .show-description {
  display: block;
}

.containerabout1 h4 i {
  transition: transform 0.3s ease-in-out;
}

.containerabout1 h4.show-description i {
  transform: rotate(180deg);
}

  </style>
</head>

<body>
  
<nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><img src="../../images/logo.png"  /></div>

    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>

      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="../../index.php" style="text-decoration: none;">Home</a></li>
        <li><a href="./aboutus.php" style="text-decoration: none;">About</a></li>

        <li class="categories">
          <a >Categories</a>

          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="/">Flower</a></li>
            <li><a href="/">Chocolate</a></li>
            <li><a href="/">Cake</a></li>
            <li><a href="/">Plants</a></li>
            <li><a href="/">Jewelry</a></li>
          </ul>
        </li>
        <li><a href="/"><i class="fa-solid fa-location-dot"></i></a></li>
        <li><a href="/"><i class="fas fa-shopping-cart"></i></a></li>
        <li class="user">
          <a href="/"><i class="fas fa-user"></i></a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="/">Sign up</a></li>
            <li><a href="/">Log in</a></li>
            <li><a href="/">Contact us</a></li>
          </ul>
        </li>
      </div>
    </ul>
  </nav>

  <div class="containerabout1">
    <div class="textpolicy">
      <h1>Privacy Policy</h1>
      <p>At Presento, we are committed to safeguarding the privacy of the information you provide when using our website. This policy outlines the types of information we collect, how we use it, and how we share it. Please read this privacy policy carefully to understand how we handle your personal information.</p>
      <h4 class="toggle-description">Information We Collect <i class="fas fa-chevron-down"></i></h4>
      <p class="description">When you visit our website, we may collect non-personal information such as the type of browser you are using, your operating system, and the web pages you have visited on our site. We use this information to enhance your experience on the website and improve its performance.</p>
      <h4 class="toggle-description">Use of Information <i class="fas fa-chevron-down"></i></h4>
      <p class="description">We use the collected information to improve and customize your experience on our website and ensure the better delivery of our services. We may use your email address to send updates about products and promotional offers, though you will always have the option to opt-out of receiving these communications.</p>
      <h4 class="toggle-description">Sharing of Information <i class="fas fa-chevron-down"></i></h4>
      <p class="description">We do not sell or trade your personal information to third parties. We may share some information with our authorized service partners to facilitate the services you have requested, such as order deliveries.</p>
      <h4 class="toggle-description">Your Rights <i class="fas fa-chevron-down"></i></h4>
      <p class="description">You have the right to access, correct, and delete your personal information that we hold. You can also request us to stop using your personal information, if you do not wish to receive updates or promotional offers from us.</p>
      <h4 class="toggle-description">Information Security <i class="fas fa-chevron-down"></i></h4>
      <p class="description">We implement appropriate security measures to protect your personal information from unauthorized access, use, modification, or disclosure.</p>
      <h4 class="toggle-description">Changes to Privacy Policy <i class="fas fa-chevron-down"></i></h4>
      <p class="description">We may update the privacy policy from time to time. Any changes will be posted on this page, and it is recommended to check it periodically.</p>
      <h4 class="toggle-description">Contact Us <i class="fas fa-chevron-down"></i></h4>
      <p class="description">If you have any inquiries about our privacy policy, please contact us through [appropriate contact method].</p>
    </div>
  </div>
  <footer>
      <div class="footer">
        <div class="container">     
            <div class="row">                       
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="single_footer">
                        <h4>CATEGORISE</h4>
                        <ul>
                        <li><a href="/">Flower</a></li>
                        <li><a href="/">Chocolate</a></li>
                        <li><a href="/">Cake</a></li>
                        <li><a href="/">Plants</a></li>
                         <li><a href="/">Jewelry</a></li>
                        </ul>
                    </div>
                </div><!--- END COL --> 
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single_footer single_footer_address">
                        <h4>GET TO KNOW US</h4>
                        <ul>
                        <li><a href="./aboutus.php" style="text-decoration: none;">About Us</a></li>
                            <li><a href="./contactus.php">Contact Us</a></li>
                            <li><a href="./terms.php">Terms and conditions </a></li>
                            <li><a href="./policy.php">privacy policy  </a></li>
                            <li><a href="../../index.php#partener">Parteners</a></li>
                        </ul>
                    </div>
                </div><!--- END COL -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single_footer single_footer_address">
                        <h4>Subscribe today</h4>
                        <div class="signup_form">                           
                            <form action="#" class="subscribe">
                                <input type="text" class="subscribe__input" placeholder="Enter Email Address">
                                <button type="button" class="subscribe__btn"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="social_profile">
                        <ul>
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="mailto:baidaaalkhalaf14@gmail.com"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>                          
                </div><!--- END COL -->         
            </div><!--- END ROW --> 
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <p class="copyright">Copyright © 2023 <a href="#">presento</a>.</p>
                </div><!--- END COL -->                 
            </div><!--- END ROW -->                 
        </div><!--- END CONTAINER -->
    </div>
</footer>
  <script>document.addEventListener("DOMContentLoaded", function () {
  const toggleDescriptions = document.querySelectorAll(".toggle-description");
  
  toggleDescriptions.forEach((toggle) => {
    toggle.addEventListener("click", () => {
      const description = toggle.nextElementSibling;
      description.classList.toggle("show-description");
    });
  });
});

</script>
</body>

</html>
