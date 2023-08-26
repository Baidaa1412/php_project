<?php
// Start the session
session_start();

include_once '../../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database using prepared statement
    $query = "SELECT * FROM user WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
    $result = $stmt->execute();

    if ($result && $stmt->rowCount() === 1) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $userId = $result['id'];


        $_SESSION['user'] = $email;
        $_SESSION['userId'] = $userId;
        $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        
        $result = $stmt->execute();
    
        if ($result && $stmt->rowCount() === 0) {
            $insertStmt = $conn->prepare("INSERT INTO cart (user_id) VALUES (:user_id)");
            $insertStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $insertResult = $insertStmt->execute();
        }

        header('Location: ../../index.php'); // Corrected redirection
        exit();
    } else {
        // Failed login
        echo "Invalid email or password.";
    }
}

// Close the database connection (not strictly needed for PDO as it is automatically closed when the script ends)
$conn = null;
?>
