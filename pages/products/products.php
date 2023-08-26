<?php
include_once '../../php/connection.php';

if (isset($_GET['category']) && is_numeric($_GET['category'])) {
    $selectedCategoryID = $_GET['category'];
} else {
    echo "Invalid category selection.";
    exit;
}
$query = "SELECT * FROM product WHERE category_id = :category_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':category_id', $selectedCategoryID, PDO::PARAM_INT);

$result = $stmt->execute();

if ($result) {
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Error retrieving products.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/style.css" />
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
            gap: 80px;
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
            cursor: pointer;
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

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .product-card {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <!-- LOGO -->
        <div class="logo"><img src='../../images/logo.png' onclick="redirectToPage()"' /></div>

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
            <li><a href="/">Flower</a></li>
            <li><a href="/">Chocolate</a></li>
            <li><a href="/">Cake</a></li>
            <li><a href="/">Plants</a></li>
            <li><a href="/">Jewelry</a></li>
            </ul>
        </li>
        <li><a href="../../pages/mainpage/contactus.php"><i class="fa-solid fa-headset"></i></a></li>
        <li><a href="/"><i class="fas fa-shopping-cart"></i></a></li>
        <li class="user">
          <a href="/"><i class="fas fa-user"></i></a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown">
            <li><a href="./pages/login-regist/signup.html">Sign up</a></li>
            <li><a href="../login-regist/login.php">Log in</a></li>
            
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

        // Query to retrieve the selected category's name
        if (isset($_GET['category']) && is_numeric($_GET['category'])) {
            $selectedCategoryID = $_GET['category'];
        } else {
            // Handle invalid category ID or no category selected
            echo "Invalid category selection.";
            exit;
        }

        // Query to retrieve category name for the selected category
        $categoryQuery = "SELECT name FROM category WHERE id = :category_id";
        $stmt = $conn->prepare($categoryQuery);
        $stmt->bindParam(':category_id', $selectedCategoryID, PDO::PARAM_INT);

        $categoryResult = $stmt->execute();

        if ($categoryResult) {
            $categoryRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryName = $categoryRow['name'];

            // Display the category name in a header
            echo '<h2>' . $categoryName . '</h2';
        } else {
            // Handle query execution error
            echo "Error retrieving category name.";
        }
        ?>
    </header>
    <div class="main-container">
        <div class="product-container">
        <?php
        foreach ($products as $row) {
            $productName = $row['name'];
            $imageData = $row['picture'];
            $base64Image = base64_encode($imageData);
            $productDescription = $row['description'];
            $productPrice = $row['price'];
            $productId = $row['id'];

            echo "<div class='product-card productTranstion $productId'>";
            echo "<div class='product-info' data-product-id='$productId'>";
            echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Product Image">';
            echo '<h2>' . $productName . '</h2>';
            echo '<p>' . $productDescription . '</p>';
            echo '<p>Price: JD' . $productPrice . '</p>';
            echo '</div>';
            echo '<div class="add-to-cart-container">';
            echo '<button class="add_to_cart_button">Add to Cart</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
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
    let product = document.querySelectorAll(' .productTranstion'); product.forEach(card=> card.addEventListener('click', handleCardClick));
            function handleCardClick(event) {
            const product = event.currentTarget.classList[2];
            window.location.href = `../Productreviwe/product.php?product=${product}`;
            }
            </script>
</body>

</html>