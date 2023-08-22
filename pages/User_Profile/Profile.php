<?php
require("../../php/connection.php");

$userId=2;
// Query to retrieve user information
$query = "SELECT name, email , phone_number	, bio FROM user WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $userId); // $userId should be the user's ID you want to retrieve
$stmt->execute();

// Fetch the user information
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link rel="stylesheet" href="./profile.css">
  <link rel="stylesheet" href="./mediaqueries.css">
</head>
<body>
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
			<!-- <div class="sidebar-logo">
        <img src="../../images/user.png" alt="Logo">
      </div> -->
			<nav class="menu">
				<a href="../User_Profile/MyDetails.php" class="menu-item">My Details</a>
				<a href="#" class="menu-item is-active">Profile</a>
				<!-- <a href="#" class="menu-item">Orders</a>
				<a href="#" class="menu-item">Favorites</a> -->
			</nav>

		</aside>
  <!-- -------------------/SideBar----------------- -->

  <!-- -------------------------Section---------------------- -->
  <div class="profile-card">
    <!-- <img class="profile-image" src="user_photo.jpg" alt="User Profile"> -->
    <div class="profile-info">
      <div class="profile-name"><?php echo $user['name']; ?></div><br>
      <div class="profile-email"><?php echo $user['email']; ?></div><br>
      <div class="profile-bio"><?php echo $user['bio']; ?></div><br>
      <div class="profile-bio"><?php echo $user['phone_number']; ?></div>
    </div>
  </div>

  <!-- -------------------------/Section---------------------- -->



<script src="./profile.js"></script>
</body>
</html>