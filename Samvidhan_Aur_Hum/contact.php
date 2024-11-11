<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "samvi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for empty fields
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
    echo "Please fill in all required fields.";
    exit;
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Prepare and execute an SQL statement to insert the data
$sql = "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "Thank you for contacting us! We will get back to you as soon as possible.";
} else {
    echo "An error occurred while submitting your message. Please try again later.";
}

$stmt->close();
$conn->close();
?>
