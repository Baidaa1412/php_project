<?php    
require("../../php/connection.php");

// Check if the user is logged in
session_start();
if (!isset($_SESSION["user_id"])) {
    // Redirect to a login page or handle unauthorized access
    header("Location: Login.php");
    exit();
}

// Get the user ID from the session
$userId = $_SESSION["userID"];


    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // $userId = 1; // Set the user ID here
    
        // Sanitize and retrieve the updated values from the form
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"]; // Please consider securely hashing the password
        $phone_number = $_POST["phone_number"];
        $bio = $_POST["bio"];
    
        // Update query
        $query = "UPDATE user SET name = :name, email = :email, password = :password, phone_number = :phone_number, bio = :bio WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':bio', $bio);
    
        // Execute the update query
        if ($stmt->execute()) {
            // Redirect to the same page or another appropriate page after successful update
            header("Location: MyDetails.php");
            exit();
        } else {
            // Handle error if update query fails
            echo "Update failed.";
        }
    }
    
   
?>