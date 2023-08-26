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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>



  <title>Document</title>

  <style>
    @import "https://fonts.googleapis.com/css?family=Open+Sans:800&display=swap";

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .wrapper {
      position: relative;
      margin: 0 auto;
      max-width: 100%;
      height: 480px;
      overflow: hidden;

    }

    .overflow {
      display: grid;
      grid-auto-columns: minmax(300px, auto);
      grid-gap: 15px;
      grid-auto-flow: column;
      padding: 10px;
      width: 90%;
      height: 100%;
      transform: translateX(0px);
      transition: all 1s ease;

    }

    .bloco {
      height: 70%;
      width: 85%;
      border: 1px solid black;
      align-items: center;
      justify-content: center;
      color: black;
      cursor: pointer;
      text-align: center;
      border-radius: 10px;
      border: none;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease-in-out;


    }

    .bloco:hover {
      transform: translateY(-5px);
    }

    .next {
      position: absolute;
      right: 0;
      top: 45%;
      z-index: 9;
      opacity: 1;
      outline: none;
      font-size: 25px;
      text-shadow: #01c7e9 2px;
      background-color: white;
      border-radius: 50%;
      width: 3%;

    }

    .next :hover {
      font-size: larger;
      outline: none;

    }

    .previous {
      position: absolute;
      left: 0;
      top: 45%;
      z-index: 9;
      opacity: 0;
      font-size: 25px;
      outline: none;
      background-color: white;
      border-radius: 50%;
      width: 3%;

    }

    @media(max-width:767px) {
      .wrapper {
        max-width: 100%;
      }

      .overflow {
        grid-auto-columns: minmax(200px, auto);
      }
    }
  </style>
</head>

<body>
    <h1>Categories</h1>
<div class="wrapper">
  <button class="previous"> <i class="fas fa-arrow-left"></i> </button>
  
  <?php
$servername = "localhost:4306";
$username = "root";
$password = "";
$dbname = "presentodb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        echo '<div class="overflow">';
        foreach ($result as $row) {
       
            $img = base64_encode($row['image'] ?? null);
            $categoryId = $row['id']; // Get the category ID
            echo "<div class='bloco cardTranstion $categoryId'>";
          
            echo "<img src='" . "data:image/jpeg;base64," . $img . "' alt='partner Image'>";
            echo "<br>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<h1 class='no-data'>Partners</h1>";
    }
} catch (PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}

$conn = null; // Close the database connection
?>

  <button class="next" > <i class="fas fa-arrow-right"></i> </button>
</div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function doTheMagic() {
      let btnNext = document.querySelector('.next');
      let btnPrevious = document.querySelector('.previous');
      let overflow = document.querySelector('.overflow');
      let block = document.querySelector('.bloco');
      let allBlocks = document.querySelectorAll('.bloco');
      let blockWidth = block.offsetWidth;

      let position = 0;
      let maxWidth = overflow.offsetWidth;
      let allBlocksWidth = allBlocks.length * blockWidth;

      if (allBlocksWidth < maxWidth) {
        btnPrevious.style.opacity = "0";
        btnNext.style.opacity = "0";
      }

      function togglePrev(position) {
        if (position >= blockWidth) {
          btnPrevious.style.opacity = "1";
        } else {
          btnPrevious.style.opacity = "0";
        }
      }

      function toggleNext(position) {
        if ((allBlocksWidth - position) > maxWidth) {
          btnNext.style.opacity = "1";
        } else {
          btnNext.style.opacity = "0";
        }
      }

      btnNext.onclick = function() {
        if ((allBlocksWidth - position) > maxWidth) {
          position = position + blockWidth;
          overflow.style.transform = `translateX(-${position}px)`;
        }
        togglePrev(position);
        toggleNext(position);
      }

      btnPrevious.onclick = function() {
        if (position >= blockWidth) {
          position = position - blockWidth;
          overflow.style.transform = `translateX(-${position}px)`;
        }
        togglePrev(position);
        toggleNext(position);
      }

}




    function resize() {
      if (window.innerWidth < 768) {
        let overflow = document.querySelector('.overflow');
        overflow.style.transform = `translateX(0px)`;
        doTheMagic();
      } else {
        doTheMagic();
      }
    }

window.onresize = resize;
doTheMagic();


let cards = document.querySelectorAll('div.cardTranstion');

cards.forEach(card => card.addEventListener('click', handleCardClick));

function handleCardClick(event) {
  const category = event.currentTarget.classList[2];
  window.location.href = `./pages/products/products.php?category=${category}`;
}

 </script>
</body>

    </html>
