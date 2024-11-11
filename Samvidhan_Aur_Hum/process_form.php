<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute an SQL statement to insert the data
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "New record created successfully";

$stmt->close();
$conn->close();
?>