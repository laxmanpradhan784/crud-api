<?php
$servername = "localhost"; // Change if your server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "students"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
