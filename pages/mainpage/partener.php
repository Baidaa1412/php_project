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
    <div  class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "presentodb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }
        $sql = "SELECT name_parteners, picture_parteners FROM parteners";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1>Partners</h1>";
            echo "<div class='card-container'>";
            while ($row = $result->fetch_assoc()) {
                $img = base64_encode($row['picture_parteners']??null);
                echo "<div class='card1'>";
                echo  "<img src='" ."data:image/jpeg;base64," . $img. "' alt='partener Image'>";
                echo "<h3>" . $row["name_parteners"] . "</h3>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<h1 class='no-data'>Partners</h1>";
            echo "";
        }

        // إغلاق الاتصال بقاعدة البيانات
        $conn->close();
        ?>
    </div>
</body>
</html>