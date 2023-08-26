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

  <title>Home</title>
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
      <div class="menu ">
        <li><a href="index.php" style="text-decoration: none;">Home</a></li>
        <li><a href="./pages/mainpage/aboutus.php" style="text-decoration: none;">About</a></li>

        <li class="categories">
          <a href="./pages/categories/category.php" style="text-decoration:none">Categories</a>
        </li>
        <li><a href="./pages/mainpage/contactus.php"><i class="fa-solid fa-headset"></i></a></li>
        <li onclick="window.location.href = './pages/cart/cart.html'"><i class="fas fa-shopping-cart"></i></li>
        <li class="user" id="userDropdown">
          <a><i class="fas fa-user"></i></a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><?php
                session_start();
                // Check if the user is logged in
                if (isset($_SESSION['user'])) {
                  $loggedInUser = $_SESSION['user'];
                  echo " <a href='./pages/User_Profile/Profile.php'>Profile</a> <a href='./pages/login-regist/logout.php'>Log Out</a>";
                } else {
                  echo "<a href='./pages/login-regist/signup.html'>Sign up</a><br>";
                  echo "<a href='./pages/login-regist/login.html'>Log in</a>";
                }
                ?></li>
          </ul>
        </li>

    </ul>

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
            <img class="d-block w-100" src='./images/sliderimg1.png' alt="First slide"><a href="./pages/categories/category.php">
              <button id="but1" style="width:15%; height:10%; color:white; margin-left:65%;">
                SHOP NOW
              </button>
          </div>

          <div class="carousel-item">
            <img class="d-block w-100" src='./images/sliderimg2.png' alt="Second slide"><a href="./pages/categories/category.php">
              <button id="but2" style="width:15%; height:10%; color:white">
                Gift NOW
              </button>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src='./images/sliderimd3.png' alt="Third slide"><a href="./pages/categories/category.php">
              <button id="but3">
                SHOP NOW
              </button>
            </a>
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


      <img src="./images/White Beige Minimalist Elegant Classy Book Review Blog Banner (3).png"><a href="./pages/categories/category.php"><button id="but6" style="
  background-color: rgb(1, 139, 139);
   color:rgb(8, 8, 8);
    z-index: 1;
     position: absolute;
      margin-left: -60%;
      margin-top: 20%;

      height: 8%;
      width: 10%;
      cursor: pointer;
      border-radius: 5px;
    font-weight: 600;">


          SHOP NOW
        </button></a>
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
                include_once './php/connection.php';
                try {
                  $sql = "SELECT name FROM category limit 5";
                  $stmt = $pdo->query($sql);

                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo "<div class='cat'>";
                      echo "<li><a>" . $row["name"] . "</a></li>";
                      echo "</div>";
                    }
                  } else {
                    echo "<h1 class='no-data'>Partners</h1>";
                  }
                } catch (PDOException $e) {
                  echo "فشل الاتصال: " . $e->getMessage();
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