<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form inputs
    $firstName = $_POST['first name']
    $lastName = $_POST['last name']
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "Example@2024#"; // Your actual database password
    $dbname = "users";

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, username, email, phonenumber, password) VALUES (?, ?, ?, ?, ?, ?S)");
    $stmt->bind_param("ssssss",$firstName, $lastName, $username, $email, $phonenumber, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error; // This will help you identify the SQL error
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
