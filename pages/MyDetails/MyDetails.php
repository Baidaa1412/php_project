<?php
require("conn.php");

$userId=1;
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

<body>

  <!-- -------------------Nav Bar----------------- -->
  <nav class="navbar">
    <img class="brand-img" src="../../images/Screenshot_2023-08-18_141921-removebg-preview (1).png" alt="logo">
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
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
			<div class="sidebar-logo">
        <img src="../../images/user.png" alt="Logo">
      </div>
			<nav class="menu">
				<a href="#" class="menu-item is-active">My Details</a>
				<a href="../User_Profile/Profile.php" class="menu-item">Profile</a>
				<a href="#" class="menu-item">Orders</a>
				<a href="#" class="menu-item">Favorites</a>
			</nav>

		</aside>
  <!-- -------------------/SideBar----------------- -->

  <!-- -----------------------------------Main------------------------------- -->
<section>
  <!-- ---------------------User Name Div--------------- -->
  <div class="div_main">
    <!-- <label for="username">User Name:</label>
    <span id="username">Amjad</span>
    <button id="button1">Change Name</button> -->
    <p>Name: <span id="name"><?php echo $user['name']; ?></span>
     <button id="btn6" onclick="editField('name')">Edit</button></p>

</div>
  <!-- ---------------------/User Name Div--------------- -->


  <!-- ---------------------User Email Div--------------- -->
<div class="div_main" >
    <p>Email: <span id="email"><?php echo $user['email']; ?></span>
     <button id="btn6" onclick="editField('email')">Edit</button></p>


</div>
  <!-- ---------------------/User Email Div--------------- -->


  <!-- ---------------------User password Div--------------- -->
<div class="div_main">
    <p>Password: <span id="password"><?php echo $user['password']; ?></span>
     <button id="btn6" onclick="editField('password')">Edit</button></p>

</div>
  <!-- ---------------------/User password Div--------------- -->


  <!-- ---------------------User password Div--------------- -->
  <div class="div_main">
    <p>Number Phon: <span id="phon"><?php echo $user['phone_number']; ?></span>
     <button id="btn6" onclick="editField('phon')">Edit</button></p>

</div>
  <!-- ---------------------/User password Div--------------- -->



  <!-- ---------------------User Bio Div--------------- -->
<div class="div_main">
   <p>User Bio: 
    <textarea id="userbio" readonly><?php echo $user['bio']; ?></textarea>
    <button id="editButton" onclick="toggleEditMode()">Edit</button>
    <button id="saveButton" onclick="saveChanges()" style="display: none;">Save</button></p>
</div>
  <!-- ---------------------/User Bio Div--------------- -->


  <!-- ---------------------Change Image Div--------------- -->
  <div class="image-container">
    <img id="image-icon" src="default-image.jpg" alt="Icon">
    <div class="btn_divs">
    <button id="change-button">Change Image</button>
    <button id="button2" onclick="saveChanges()" >Save</button>
    <!-- <button id="button2" onclick="saveChanges()" style="display: none;">Save</button> -->
</div>
  </div>
  <input type="file" id="image-input" accept="image/*" style="display: none;">
    <br>
  </div>
  </div>
  <!-- ---------------------/Change Image Div--------------- -->

  
</section>
      <!-- -----------------------------------/Main------------------------------- -->


    <script src="./MyDetails.js"></script>
</body>

</html>