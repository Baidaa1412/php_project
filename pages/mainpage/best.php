<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best Seller Products</title>
  <style>
    .cont2 {
      display: flex;
      flex-wrap:wrap ;
      padding: 20px;
    
    }
    
    .card {
      margin: 10px;
      width: 300px;
      border: 1px solid #e3e3e3;
      border-radius: 8px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
      height:4%;
    }
    
    .card:hover {
      transform: translateY(-5px);
    }
    
    .card img {
      max-width: 100%;
      height: 330px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    
    .card-body {
      padding: 10px;
    }
    
    .best-seller-badge {
      background-color: #f44f5a;
      color: white;
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 4px;
      display: inline-block;
      margin-bottom: 8px;
    }
    
    .card-text {
      font-size: 30px;
      color: #555;
      text-align:left;
    }
    .addto-cart {
    background-color: #4BA2A5;
    color: #FFFFFF;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}
  </style>
</head>
<body>
  <h1>Best Selling Flowers & Gifts</h1>
  <div class="cont2">
    <?php
    $servername = "localhost:4306";
    $username = "root";
    $password = "";
    $dbname = "presentodb";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $sql = "SELECT * FROM product WHERE is_best_seller = 1";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($result) > 0) {
        foreach ($result as $row) {
          $title = $row['name'];
          $image = base64_encode($row['picture'] ?? null);
          $productId = $row['id'];
          echo "<div class='card productTranstion $productId'>";
          echo  "<img src='data:image/jpeg;base64," . $image . "' alt='partner Image'>";
          echo '<div class="card-body">';
          echo '<h1 class="card-text">' . $row['name'] . '</h1>';
          echo '<h3 class="card-text">' . $row['price'] . "JD" . '</h3>';
          echo '<button class="addto-cart">Add to Cart</button>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo "<h1 class='no-data'>No best-selling products available.</h1>";
      }
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $conn = null; // Close the database connection
    ?>
  </div>
  <script>
    let product = document.querySelectorAll('.productTranstion');

    product.forEach(card => card.addEventListener('click', handleCardClick));

    function handleCardClick(event) {
      const product = event.currentTarget.classList[2];
      window.location.href = `./pages/Productreviwe/product.php?product=${product}`;
      
    }
  </script>
</body>
</html>