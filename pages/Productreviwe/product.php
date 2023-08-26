<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="./product.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Document</title>
</head>

<body>
  <nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><img src="../../images/logo.png" onclick="redirectToPage()"></div>
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
          <a>Categories</a>

          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <?php
            require("../../php/connection.php");
            try {
              $sql = "SELECT name FROM category limit 5";
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
            ?>

          </ul>
        </li>
        <li><a href="../../pages/mainpage/contactus.php"><i class="fa-solid fa-headset"></i></a></li>
        <li><a onclick="window.location.href = '../../pages/cart/cart.html'"
><i class="fas fa-shopping-cart"></i></a></li>
        <li class="user">
          <a href="/"><i class="fas fa-user"></i></a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="../pages/login-regist/signup.html">Sign up</a></li>
            <?php
            session_start();

            // Check if the user is logged in
            if (isset($_SESSION['user'])) {
              $loggedInUser = $_SESSION['user'];
              echo " <a href='./pages/User_Profile/Profile.php'>Profile</a> <a href='./pages/login-regist/logout.php'>Log Out</a>";
            } else {
              echo "<a href='./pages/login-regist/signup.html'>Sign up</a><br>";
              echo "<a href='./pages/login-regist/login.html'>Log in</a>";
            }
            ?>
        </li>
      </div>
    </ul>
  </nav>
  <section>
    <?php

    if (isset($_GET['product']) && is_numeric($_GET['product'])) {
      $productId = $_GET['product'];

      // Query to retrieve product information
      $query = "SELECT id, picture, name, price, discount, stock, description FROM product WHERE id = :id";
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


    <!-- Display Product -->
    <div class="con">
      <div class="product-container">
        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="product Image">
        <div class="product-details">
          <h1 class="product-title"><?php echo $product['name']; ?></h1>

          <p class="product-description"><?php echo $product['description']; ?></p>

          <?php if ($product['stock'] > 0) { ?>
            <p class="in_stock"><span class="green-dot"></span><?php echo "" ?> in stock</p>
            <p class="product-price"><?php echo $product["price"]; ?> JD</p>
            <p class="product-discountprice"><?php echo $priceAfterDiscount; ?> JD</p>
            <button class="add-to-cart-button" id="add-to-cart" <?php $id = $product['id'];
                                                                echo "data-id='$id'";
                                                                echo $product['stock'] <= 0 ? 'disabled' : ''; 
                                                                ?>>>
              <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
          <?php } else { ?>
            <p class="in_stock"><?php echo "Out of stock"; ?></p>
          <?php } ?>

          <div class="quantity-container">
            <button class="quantity-button" id="decrease">-</button>
            <input type="number" id="quantity" value="1" min="1" <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
            <button class="quantity-button" id="increase">+</button>
          </div>
        </div>
      </div>
    </div>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Product Comments</title>
    </head>

    <body>

      <h1>Product Comments</h1>

      <?php

      if (isset($_GET['product']) && is_numeric($_GET['product'])) {
        $productId = $_GET['product'];
      } else {
        // Handle invalid product ID or no product selected
        echo "Invalid product selection.";
        exit;
      }

      // Query to retrieve comments and relevant user information
      $commentsQuery = "SELECT r.*, u.name AS user_name FROM review r JOIN user u ON r.userId = u.id WHERE r.productId = :product_id";
      $stmt = $conn->prepare($commentsQuery);
      $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);

      $commentsResult = $stmt->execute();

      if ($commentsResult) {
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
        // Handle query execution error
        echo "Error retrieving comments.";
      }

      // Process comments
      foreach ($comments as $comment) {
        $commentText = $comment['comment'];
        $username = $comment['user_name'];

        // Display the comment along with the user's username
        echo '<p class="rev1"><strong><i class="fas fa-user"></i> ' . $username . '</strong>' . '</p>';
        echo '<p class="rev1">' . $commentText . '</p>';
        echo '<hr>'; // Add a horizontal line between comments
      }

      // Add comment form
      echo '<div class="comment-form">';
      echo '<form method="post">';
      echo '<input type="hidden" name="product_id" value="' . $productId . '">';
      echo '<textarea name="comment" placeholder="Write your comment" class="comment-input"></textarea>';
      echo '<button type="submit" class="comment-button">Submit Comment</button>';
      echo '</form>';
      echo '</div>';

      echo '</div>'; // Close the product-card div
      ?>

      <?php
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        try {
          // Get the values from the submitted form
          $productId = $_POST['product_id'];
          $comment = $_POST['comment'];

          // Insert the comment into the database
          $insertQuery = "INSERT INTO review (productId, comment) VALUES (?, ?)";
          $stmt = $conn->prepare($insertQuery);
          $stmt->execute([$productId, $comment]);

          echo "Comment added successfully.";
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
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

                include_once '../../php/connection.php';
                try {
                  $sql = "SELECT name FROM category limit 5";
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
                <li><a href="../mainpage/aboutus.php" style="text-decoration: none;">About Us</a></li>
                <li><a href="../mainpage/contactus.php">Contact Us</a></li>
                <li><a href="../mainpage/terms.php">Terms and conditions </a></li>
                <li><a href="../mainpage/policy.php">privacy policy </a></li>
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


  <script>
    function redirectToPage() {
      window.location.href = "../../index.php";
    }
  </script>
  <script src="product.js">
  </script>
</body>