<?php
// Retrieve user input
$formUsername = $_POST['username'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber']; // Added missing semicolon
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Database connection
$servername = "localhost";
$dbUsername = "root"; // Changed variable name to avoid confusion
$dbPassword = "Example@2024#";
$dbname = "users";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (username, email, phonenumber, password) VALUES (?, ?, ?, ?)");
    
    // Check if statement preparation was successful
    if ($stmt) {
        $stmt->bind_param("ssss", $formUsername, $email, $phonenumber, $password);
        
        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "Registration successful";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
