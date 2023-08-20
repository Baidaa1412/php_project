<!DOCTYPE html>
<html lang="en">

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
      display: flex;
      justify-content: space-between;
      align-items: center;
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
      <h1>Terms and Conditions</h1>
      <p>These terms (as well as all documents referred to herein) specify the Terms and Conditions (the “Terms”) which will apply when an order (‘Order’) is placed from the products (the “Products”) referred to on the Floward (‘Floward’, ‘Our’, ‘us’, ‘we’) website or mobile application(s) (iPhone or Android) (the “Platforms”). Please read these terms carefully before ordering any of our Products.
        If you have any questions concerning these Terms, please contact us before placing any Order.
        If you do not agree to these Terms, then you may not use the Platforms.</p>
      <h4 class="toggle-description">Compensation and Refund Policy<i class="fas fa-chevron-down"></i></h4>
      <p class="description">Your satisfaction is our priority, with 100% Customer Satisfaction Guarantee with every flower arrangement and gift we deliver to your beloved ones! If - for any reason - you are not satisfied with the arrangement that we have delivered, we will provide a replacement as soon as possible. If you do not require a replacement, you may be eligible for a partial refund in the form of Floward credit which will be available for use for up to 12 months. You also may be offered compensation.</p>

      <h4 class="toggle-description">Cancellation Policy<i class="fas fa-chevron-down"></i></h4>
      <p class="description">If an order is cancelled 24 hours before the start of the delivery slot or if the recipient is refusing the order prior to receiving the location of delivery (before delivery and preparing of the order), we will do our best to process your cancellation request which might be eligible for 100% refund.</p>

      <h4 class="toggle-description">Rescheduling Orders<i class="fas fa-chevron-down"></i></h4>
      <p class="description">We understand that in some circumstances you might request your order to be rescheduled, and we will do our best to accommodate your request. In cases where your order was not prepared yet, you will be able to reschedule the order for up to a maximum of 10 days. Otherwise, you will be able to reschedule your order for not more than 48hr later so that we can guarantee that the best quality products are delivered.</p>

      <h4 class="toggle-description">Return Policy <i class="fas fa-chevron-down"></i></h4>
      <p class="description">If you are dissatisfied with our product quality and you wish to return the delivered items, please contact our customer care team through our platforms to schedule a pick-up within 48hrs of delivery.
        Depending on the country in which the products were to be delivered, you will have up to 48 hours to return the product(s), Floward return policy will be in line with applicable laws of the country.<i class="fas fa-chevron-down"></i></h4>
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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const toggleDescriptions = document.querySelectorAll(".toggle-description");

      toggleDescriptions.forEach((toggle) => {
        toggle.addEventListener("click", () => {
          const description = toggle.nextElementSibling;
          description.classList.toggle("show-description");

          const icon = toggle.querySelector("i");
          icon.classList.toggle("fa-chevron-down");
          icon.classList.toggle("fa-chevron-up");
        });
      });
    });
  </script>
</body>

</html>
