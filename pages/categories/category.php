<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <style>
    
    .category-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
  margin-bottom: 3rem;
}

.category-card {
    display: inline-block; /* Display categories in a row */
    border: 1px solid #ccc;
    padding: 20px;
    margin: 10px;
    width: 250px;
    background-color: #FFFFFF;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    transition: box-shadow 0.3s;
    position: relative;
}

.category-card:hover {
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Highlight on hover */
}

.category-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.category-card h2 {
    font-size: 18px;
    color: #4BA2A5;
    margin: 0;
    text-align: center;
    transition: text-decoration 0.3s; /* For removing underline on hover */
}

.category-card a {
    text-decoration: none;
    color: #4BA2A5;
}

.category-card h2:hover {
    text-decoration: none; /* Remove underline on hover */
}

   </style>
  <title>Document</title>
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
        <li><a href="index.php" style="text-decoration: none;">Home</a></li>
        <li><a href="./pages/mainpage/aboutus.php" style="text-decoration: none;">About</a></li>

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
            <li><a href="./pages/login-regist/signup.html">Sign up</a></li>
            <li><a href="./pages/login-regist/login.html">Log in</a></li>
            <li><a href="./pages/example/mainpage/contactus.php">Contact us</a></li>
          </ul>
        </li>
      </div>
    </ul>
  </nav>
    
  <div class="category-container">
  <?php
// Assuming your database connection credentials
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "presentodb";

// Create a connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve categories
$query = "SELECT  id, name, picture_cat FROM category";
$result = $conn->query($query);

// Process and display categories as HTML cards
while ($row = $result->fetch_assoc()) {
    $categoryId = $row['id']; // Get the category ID
    $categoryName = $row['name'];
    $imageData = $row['picture_cat'];
    $base64Image = base64_encode($imageData);
    // Generate HTML card for each category
    echo '<div class="category-card">';
    echo '<a href="../products/products.php?category=' . $categoryId . '">'; // Pass category ID as a parameter
    echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="category Image">';
    echo '<h2>' . $categoryName . '</h2>';
    echo '</div>';
}

// Close the database connection
$conn->close();
?>
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

</body>
</html>