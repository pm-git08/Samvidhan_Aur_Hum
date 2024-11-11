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

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate password match
if ($password !== $confirm_password) {
    echo '<script>alert("Password do not match!"); window.location.href = "index.html";</script>';
    exit;
}

// Hash the password (recommended for security)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute an SQL statement to insert the data
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    // Successful registration
    echo '<script>alert("Registration successful!"); window.location.href = "index.html";</script>';
} else {
    // Registration failed
    echo "Registration failed. Please try again.";
}

$stmt->close();
$conn->close();
?>
