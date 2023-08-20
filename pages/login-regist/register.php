<?php
// Retrieve form inputs
$fullName = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$location = $_POST['location'];

// Database connection details
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "presentodb";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $sql = "INSERT INTO user (name, email, password, phone_number, address) VALUES (:name, :email, :password, :phone, :address)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $mobile);
    $stmt->bindParam(':address', $location);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Form submitted successfully.";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>