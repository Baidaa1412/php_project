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
    /* أنماط الأزرار مع الأيقونات */
    .contact-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin: 10px;
      transition: background-color 0.3s ease;
    }

    .contact-button i {
      margin-right: 5px;
    }

    .contact-button:hover {
      background-color: #0056b3;
    }
    .container1 {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
    }

    .image {
      flex: 1;
      padding: 20px;
    }

    .image img {
      max-width: 80%;
      height: auto;
      margin-left: 5%;
      margin-top: -7%;
      
    }

    .info {
      flex: 1;
      padding: 20px;
      background-color: #f1f1f1;
    }

    .info h2 {
      margin-top: 0;}
 
  </style>
</head>

<body>
<nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><img src="../../images/logo.png"  onclick="redirectToPage()" /></div>

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
        <a href="../../pages/categories/category.php" style="text-decoration:none">Categories</a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="/">Flower</a></li>
            <li><a href="/">Chocolate</a></li>
            <li><a href="/">Cake</a></li>
            <li><a href="/">Plants</a></li>
            <li><a href="/">Jewelry</a></li>
          </ul>
        </li>
        <li><a href="../mainpage/contactus.php"><i class="fa-solid fa-headset"></i></a></li>
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

  <div class="container1">
    
    <div class="info">
      <h2>Contact Us</h2>
      <p><b>Phone:</b>+962796960490<br><b>Timings:</b> 7:00 AM to 1:00 AM<br><br>

      <b> Whatsapp:</b>+962796960490
    <br><br>
    <b>For Media Enquiries</b><br>
        Email: pr@Presento.com<br><br>
        <b>  For Corporate Bulk Orders</b>
    <br>
    Email: sale@Presento.com</p><div class="callbtn">
  <a href="mailto:your-email@example.com" class="contact-button"style="background-color:red" >
    <i class="fas fa-envelope"></i>
    Contact us
  </a>


  <a href="https://wa.me/00962796960490" class="contact-button" style="background-color:green">
    <i class="fab fa-whatsapp"></i>
whatsapp  </a>

<a href="tel:+962796960490" class="contact-button">
    <i class="fas fa-phone"></i>
Call us  </a></div>
    </div>
    <div class="image">
      <img src="../../images/contact.png" alt="Image" />
    </div>
  </div>


    </div>

</body>

</html>
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
   
function redirectToPage() {
    window.location.href = "../../index.php";
  }
 
  </script>
</body>

</html>