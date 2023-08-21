<?php
// Include the connection file
include '../../php/connection.php';

// Start the session
session_start();

// Retrieve user input
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Query to check if the user exists in the database
    $query = "SELECT id FROM user WHERE email = :email AND password = :password";
    $statement = $conn->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->execute();

    if ($statement->rowCount() === 1) {
        // Fetch the user ID
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $userID = $row['id'];

        // Check if the user already has a cart
        $query = "SELECT id FROM cart WHERE user_id = :user_id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':user_id', $userID);
        $statement->execute();
        $cartID = $statement->fetchColumn();

        if (!$cartID) {
            // The user doesn't have a cart, so create one
            $query = "INSERT INTO cart (user_id) VALUES (:user_id)";
            $statement = $conn->prepare($query);
            $statement->bindParam(':user_id', $userID);
            $statement->execute();

            $cartID = $conn->lastInsertId();
        }

        // Store the user ID and cart ID in session variables
        $_SESSION['user_id'] = $userID;
        $_SESSION['cart_id'] = $cartID;

        // Successful login
      header('Location: ../../index.php');
    } else {
        // Failed login
        echo "Invalid email or password.";
    }
} catch (PDOException $e) {
    // Handle PDO exception
    die("Query failed: " . $e->getMessage());
} finally {
    // Close the database connection
    $conn = null;
}
?>