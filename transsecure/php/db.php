<?php
// Database configuration
$servername = "sql6.freesqldatabase.com";
$username = "sql6683400";
$password = "zarzMSl2LT";
$database = "sql6683400";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

