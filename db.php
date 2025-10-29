<?php
// Start the session on every page
session_start();

// Database connection details
$servername = "localhost";
$username = "root"; // Your MySQL username (default is often 'root')
$password = "";     // Your MySQL password (default is often empty)
$dbname = "motoshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>