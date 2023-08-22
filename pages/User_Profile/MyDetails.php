<?php
require("../../php/connection.php");

$userId=2;
// Query to retrieve user information
$query = "SELECT name, email ,password ,phone_number , bio FROM user WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $userId); // $userId should be the user's ID you want to retrieve
$stmt->execute();

// Fetch the user information
$user = $stmt->fetch(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyDetails</title>

  <link rel="stylesheet" href="./MyDetails.css" />
  <link rel="stylesheet" href="./mediaqueries.css" />
  
</head>

  <!-- -------------------Nav Bar----------------- -->

  <nav class="navbar">
    <img class="brand-img" src="../../images/logo.png" alt="logo">
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="../User_Profile/profile.php">About</a></li>
        <!-- <li><a href="#">Contact</a></li> -->
      </ul>
    </div>
  </nav>

  <!-- -------------------/Nav Bar----------------- -->


  
  
  <!-- -------------------SideBar----------------- -->
  <div class="app">
		<div class="menu-toggle">
			<div class="hamburger">
				<span></span>
			</div>
		</div>

		<aside class="sidebar">
			<!-- <h3>Menu</h3> -->
			<nav class="menu">
				<a href="../User_Profile/MyDetails.php" class="menu-item is-active">My Details</a>
				<a href="./profile.php" class="menu-item">Profile</a>
				<!-- <a href="#" class="menu-item">Orders</a>
				<a href="#" class="menu-item">Favorites</a> -->
			</nav>

		</aside>
  <!-- -------------------/SideBar----------------- -->


  <!-- -----------------------------------Main------------------------------- -->
<!-- Inside your <section> element -->
<form method="POST" action="update.php">
  <!-- User Name Div -->
  <div class="div_main">
    <p>
      Name:
      <input type="text" name="name" value="<?php echo $user['name']; ?>" />
    </p>
  </div>

  <!-- User Email Div -->
  <div class="div_main">
    <p>
      Email:
      <input type="email" name="email" value="<?php echo $user['email']; ?>" />
    </p>
  </div>

  <!-- User password Div -->
  <div class="div_main">
    <p>
      Password:
      <input type="password" name="password" value="<?php echo $user['password']; ?>" />
    </p>
  </div>

  <!-- User phone Div -->
  <div class="div_main">
    <p>
      Number Phone:
      <input type="tel" name="phone_number" value="<?php echo $user['phone_number']; ?>" />
    </p>
  </div>

  <!-- User Bio Div -->
  <div class="div_main">
    <p>
      User Bio:
      <textarea name="bio"><?php echo $user['bio']; ?></textarea>
    </p>
  </div>

  <!-- Save Button -->
  <div class="div_main">
    <button type="submit" id="saveButton">Save</button>
  </div>
</form>

  
      <!-- -----------------------------------/Main------------------------------- -->


    <script src="./MyDetails.js"></script>
</body>

</html>














