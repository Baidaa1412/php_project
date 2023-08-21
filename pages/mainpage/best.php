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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "presentodb";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = "SELECT * FROM product WHERE is_best_seller = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
      while ($row = $result->fetch_assoc()) {
        $title = $row['name'];
        $image =  base64_encode($row['picture']??null);
        echo '<div class="card">';
        echo  "<img src='" ."data:image/jpeg;base64," . $image. "' alt='partener Image'>";
        echo '<div class="card-body">';
        echo '<h1 class="card-text">' . $row['description'] . '</h1>';
         echo '<h3 class="card-text">' . $row['price'] ."JD". '</h3>';
        echo '<button class="addto-cart">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
    }
    
        }
    else {
      echo "<h1 class='no-data'>Partners</h1>";

        echo '';
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
