<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Document</title>
</head>

<body>

  <nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><img src="./images/logo.png" onclick="redirectToPage()"></div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>

      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="index.php" style="text-decoration: none;">Home</a></li>
        <li><a href="./pages/mainpage/aboutus.php" style="text-decoration: none;">About</a></li>

        <li class="categories">
          <a>Categories</a>

          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "presentodb";

            $conn = new mysqli($servername, $username, $password, $dbname, 4306);

            if ($conn->connect_error) {
              die("فشل الاتصال: " . $conn->connect_error);
            }
            $sql = "SELECT name FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<div class='cat'>";
                echo "<li>" . $row["name"] . "</li>";
                echo "</div>";
              }
            } else {
              echo "<h1 class='no-data'>Partners</h1>";
              echo "";
            }
            ?>
            <!-- <li><a href="/">Flower</a></li>
            <li><a href="/">Chocolate</a></li>
            <li><a href="/">Cake</a></li>
            <li><a href="/">Plants</a></li>
            <li><a href="/">Jewelry</a></li> -->
          </ul>
        </li>
        <li><a href="./pages/mainpage/contactus.php"><i class="fa-solid fa-headset"></i></a></li>
        <li><a href="/"><i class="fas fa-shopping-cart"></i></a></li>
        <li class="user">
          <a href="/"><i class="fas fa-user"></i></a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="./pages/login-regist/signup.html">Sign up</a></li>
            <li><a href="./pages/login-regist/login.html">Log in</a></li>
            <li><a href="./pages/example/mainpage/contactus.php">Contact us</a></li>
          </ul>
        </li>
      </div>
    </ul>
  </nav>
  <div class="page_wraper">
    <section class="maincon">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src='./images/sliderimg1.png' alt="First slide"><button id="but1">
              SHOP NOW
            </button>
          </div>

          <div class="carousel-item">
            <img class="d-block w-100" src='./images/sliderimg2.png' alt="Second slide"><button id="but2">
              GIFT NOW
            </button>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src='./images/sliderimd3.png' alt="Third slide"> <button id="but3">
              SHOP NOW
            </button>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>

    <section>
      <div id="partener"> <?php include './pages/mainpage/category.php' ?> </div>

      <div id="partener"> <?php include './pages/mainpage/best.php' ?> </div>

    </section>


  </div>

  <footer>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4 col-xs-12">
            <div class="single_footer">
              <h4>CATEGORISE</h4>
              <ul>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "presentodb";

                $conn = new mysqli($servername, $username, $password, $dbname, 4306);

                if ($conn->connect_error) {
                  die("فشل الاتصال: " . $conn->connect_error);
                }
                $sql = "SELECT name FROM category";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<div class='cat'>";
                    echo "<li>" . "<a>" . $row["name"] . "</li>" . "</a>";

                    echo "</div>";
                  }
                } else {
                  echo "<h1 class='no-data'>Partners</h1>";
                  echo "";
                }
                ?>
            </div>
          </div><!--- END COL -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="single_footer single_footer_address">
              <h4>GET TO KNOW US</h4>
              <ul>
                <li><a href="./pages/mainpage/aboutus.php" style="text-decoration: none;">About Us</a></li>
                <li><a href="./pages/mainpage/contactus.php">Contact Us</a></li>
                <li><a href="./pages/mainpage/terms.php">Terms and conditions </a></li>
                <li><a href="./pages/mainpage/policy.php">privacy policy </a></li>
                <li><a href="#partener">Paterners</a></li>
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



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./javascript/main.js"></script>

</html>