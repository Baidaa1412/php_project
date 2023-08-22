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

  <title>Document</title>
</head>
<body>
<nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><img src="../../images/logo.png" onclick="redirectToPage()" ></div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>

      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="../../index.php" style="text-decoration: none;">Home</a></li>
        <li><a href="../../pages/mainpage/aboutus.php" style="text-decoration: none;">About</a></li>

        <li class="categories">
          <a >Categories</a>

          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
          <?php
require("conn.php");

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $sql = "SELECT name FROM category";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($result) > 0) {
    foreach ($result as $row) {
      echo "<div class='cat'>";
      echo "<li>" . $row["name"] . "</li>";
      echo "</div>";
    }
  } else {
    echo "<h1 class='no-data'>Partners</h1>";
    echo "";
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null; // Close the database connection
?>

          </ul>
        </li>
        <li><a href="./pages/mainpage/contactus.php"><i class="fa-solid fa-headset"></i></a></li>
        <li><a href="/"><i class="fas fa-shopping-cart"></i></a></li>
        <li class="user">
          <a href="/"><i class="fas fa-user"></i></a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="../pages/login-regist/signup.html">Sign up</a></li>
            <li><a href="./pages/login-regist/login.html">Log in</a></li>
            <li><a href="./pages/example/mainpage/contactus.php">Contact us</a></li>
          </ul>
        </li>
      </div>
    </ul>
  </nav>
  <section>
  <?php
require("conn.php");

if (isset($_GET['product']) && is_numeric($_GET['product'])) {
    $productId = $_GET['product'];
    
    // Query to retrieve product information
    $query = "SELECT picture, name, price, discount, stock, description FROM product WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT); // Bind as integer
    
    if ($stmt->execute()) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            $imageData = base64_encode($product['picture']);
            $priceAfterDiscount = $product['price'] * (1 - $product['discount'] / 100);
            
            // Now you can use $product, $imageData, and $priceAfterDiscount as needed
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Error executing the query.";
    }
} else {
    echo "Invalid product ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="./product.css">
</head>
<body>     



 <!-- Display Product -->
<div class="con">
  <div class="product-container">
    <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="product Image">
    <div class="product-details">
      <h1 class="product-title"><?php echo $product['name']; ?></h1>
      
      <p class="product-description"><?php echo $product['description']; ?></p>
      
      <?php if ($product['stock'] > 1) { ?>
        <p class="in_stock"><span class="green-dot"></span><?php echo ""?> in stock</p>
        <p class="product-price"><?php echo $product["price"]; ?> JD</p>
      <p class="product-discountprice"><?php echo $priceAfterDiscount; ?> JD</p>
        <button class="add-to-cart-button" id="add-to-cart" 
        <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
          <i class="fas fa-shopping-cart"></i> Add to Cart
        </button>
      <?php } else if ($product['stock'] === 1) { ?>
        <p class="in_stock"><?php echo "1 in stock"; ?></p>
        <button class="add-to-cart-button" id="add-to-cart">
          <i class="fas fa-shopping-cart"></i> Add to Cart
        </button>
      <?php } else { ?>
        <p class="in_stock"><?php echo "Out of stock"; ?></p>
      <?php } ?>
      
    <div class="quantity-container">
          <button class="quantity-button" id="decrease">-</button>
          <input type="number" id="quantity" value="1" min="1" <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
          <button class="quantity-button" id="increase">+</button>
        </div></div>
  </div>
</div>

<?php
    // make sure you have a post ID 1 in your "posts table"
    $post_id = 1;
?>
 
<form action="index.php" method="post">
 
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" required>
 
    <p>
        <label>Your name</label>
        <input type="text" name="name" required>
    </p>
 
 
 
    <p>
        <label>Comment</label>
        <textarea name="comment" required></textarea>
    </p>
 
    <p>
        <input type="submit" value="Add Comment" name="post_comment">
    </p>
</form>
</div>
<?php
$conn = mysqli_connect("localhost", "root", "", "presentodb");
 
if (isset($_POST["post_comment"]))
{
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    $reply_of = 0;
 
    mysqli_query($conn, "INSERT INTO comments(name, email, comment) VALUES ('" . $name . "', '" . $email . "', '" . $comment  );
    echo "<p>Comment has been posted.</p>";
}
 
?>
</section>
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

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT name FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<div class='cat'>";
            echo "<li><a>" . $row["name"] . "</a></li>";
            echo "</div>"; 
        }
    } else {
        echo "<h1 class='no-data'>No Categories Found</h1>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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
                            <li><a href="./pages/mainpage/policy.php">privacy policy  </a></li>
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
<script src="./product.js" ></script>
</body>
