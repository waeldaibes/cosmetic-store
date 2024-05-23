<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cosmetic-store"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$text = $_POST['text'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO tbl_contactus (FullName, email, phonenumber, text) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fullname, $email, $phonenumber, $text);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to home page after successful submission
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
