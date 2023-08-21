<?php
// Get the selected category ID from the URL parameter
$selectedCategory = $_GET['category'];

// Include the PDO connection file
include_once '../../php/connection.php';

try {
    // Query to retrieve the selected category's name
    $categoryQuery = "SELECT name FROM category WHERE id = :selectedCategory";
    $categoryStatement = $conn->prepare($categoryQuery);
    $categoryStatement->bindParam(':selectedCategory', $selectedCategory, PDO::PARAM_INT);
    $categoryStatement->execute();

    if ($categoryStatement->rowCount() === 1) {
        $categoryRow = $categoryStatement->fetch(PDO::FETCH_ASSOC);
        $categoryName = $categoryRow['name'];

        // Display the category name in a header
        // echo '<h2>' . $categoryName . '</h2>';
    }
} catch(PDOException $e) {
    // Handle PDO exception
    die("Query failed: " . $e->getMessage());
}
?> 

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
        h2 {
           text-align: center;
            margin-bottom: 10px;  
             font-size: 4rem;
           color: #4BA2A5;
           margin-bottom: 5px;
           margin-top: 4vh;    
        }

       
      
      .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 3rem;
        
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap:80px;
            justify-content: center;
            align-items: center;
            padding: 2px;
            max-width: 1200px;
            margin-top: 3rem;
        }
        .product-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    width: 300px;
    background-color: #FFFFFF;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.product-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.product-card h2 {
    font-size: 20px;
    color: #4BA2A5;
    margin: 0;
    text-align: center;
}

.product-card p {
    color: #333;
    margin: 5px 0;
    text-align: center;
}

.add-to-cart-container {
    display: flex;
    align-items: center;
}

.product-price {
    font-weight: bold;
    color: #4BA2A5;
    margin-right: 10px;
}

.add-to-cart-button {
    background-color: #4BA2A5;
    color: #FFFFFF;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.add-to-cart-button:hover {
    background-color: #357f81;
}

.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

@media screen and (max-width: 768px) {
    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .product-card {
        width: calc(60% - 20px); /* Two cards in a row with margin in between */
    }
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
    

    <!-- Header Section -->
    <header>
        <?php
        // Get the selected category ID from the URL parameter
        $selectedCategory = $_GET['category'];

        // Include the PDO connection file

        try {
            // Query to retrieve the selected category's name
            $categoryQuery = "SELECT name FROM category WHERE id = :selectedCategory";
            // Assuming $conn is your PDO connection
            $categoryStatement = $conn->prepare($categoryQuery);
            $categoryStatement->bindParam(':selectedCategory', $selectedCategory, PDO::PARAM_INT);
            $categoryStatement->execute();

            if ($categoryStatement->rowCount() === 1) {
                $categoryRow = $categoryStatement->fetch(PDO::FETCH_ASSOC);
                $categoryName = $categoryRow['name'];

                // Display the category name in a header
                echo '<h2>' . $categoryName . '</h2>';
            }
        } catch(PDOException $e) {
            // Handle PDO exception
            die("Query failed: " . $e->getMessage());
        }
        ?> 
    </header>
    <div class="main-container">
        <div class="product-container">
            <?php
            // Get the selected category ID from the URL
            if (isset($_GET['category']) && is_numeric($_GET['category'])) {
                $selectedCategoryID = $_GET['category'];
            } else {
                // Handle invalid category ID or no category selected
                echo "Invalid category selection.";
                exit;
            }

            try {
                // Query to retrieve products for the selected category
                $query = "SELECT * FROM product WHERE category_id = :selectedCategoryID";
                $statement = $conn->prepare($query);
                $statement->bindParam(':selectedCategoryID', $selectedCategoryID, PDO::PARAM_INT);
                $statement->execute();

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    $productName = $row['name'];
                    $imageData = $row['picture'];
                    $base64Image = base64_encode($imageData);
                    $productDescription = $row['description'];
                    $productPrice = $row['price'];
                    $productId = $row['id']; // Adding product ID

                    echo '<div class="product-card">';
                    echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Product Image">';
                    echo '<h2>' . ucfirst(htmlspecialchars($productName)) . '</h2>';
                    echo '<p>' . htmlspecialchars($productDescription) . '</p>';
                    echo '<p>Price: JD' . htmlspecialchars($productPrice) . '</p>';
                    echo '<div class="add-to-cart-container">';
                    echo '<button class="add-to-cart-button" data-product-id="' . $productId . '">Add to Cart</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } catch(PDOException $e) {
                // Handle PDO exception
                die("Query failed: " . $e->getMessage());
            }
            ?>
        </div>
    </div>

    <div id="popup" class="popup">
        <p>Added to Cart!</p>
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
        </div><!--- END CONTAINER -->\
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add to Cart button click event
        $('.add-to-cart-button').click(function() {
            // Get the product ID from the data attribute
            var productId = $(this).data('product-id');

            // Send an AJAX request to add the product to the cart
            $.ajax({
                url: 'add_to_cart.php', // Replace with the path to your add_to_cart.php file
                method: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    // Display a success message or perform any other actions
                    alert('Product added to cart successfully.');
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script> 
</body> 

</html>