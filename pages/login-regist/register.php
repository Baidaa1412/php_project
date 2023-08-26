<?php

include_once '../../php/connection.php';

try {
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