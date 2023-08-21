<!DOCTYPE html>
<html>
<head>
    <title>Partners</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card1 {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 250px;
            text-align: center;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }

        .card1 img {
            max-width: 100%;
            height: auto;
          
        }

        .card1 h3 {
            margin-top: 10px;
            font-size: 1.2em;
            
        }

        .no-data {
            display: none;
        }
    </style>
</head>

<body>
    
    <div class="container">
    <div class="category-container">
  <?php
// Include the PDO connection file
include '../../php/connection.php';

try {
    // Query to retrieve categories
    $query = "SELECT  id, name, picture_cat FROM category";
    $statement = $conn->query($query);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Process and display categories as HTML cards
    foreach ($result as $row) {
        $categoryId = $row['id']; // Get the category ID
        $categoryName = $row['name'];
        $imageData = $row['picture_cat'];
        $base64Image = base64_encode($imageData);
        
        // Generate HTML card for each category
        echo '<div class="category-card">';
        echo '<a href="../products/products.php?category=' . $categoryId . '">'; // Pass category ID as a parameter
        echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="category Image">';
        echo '<h2>' . htmlspecialchars($categoryName) . '</h2>'; // Using htmlspecialchars to prevent XSS
        echo '</div>';
    }
} catch(PDOException $e) {
    // Handle PDO exception
    die("Query failed: " . $e->getMessage());
} finally {
    // Close the database connection (PDO)
    $conn = null;
}
?>
  </div>

    </div>
</body>
</html>