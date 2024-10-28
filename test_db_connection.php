<?php
$servername = "localhost";       // Database server (usually "localhost" with Laragon)
$username = "root";              // Default Laragon database username
$password = "";                  // Default Laragon database password is blank
$dbname = "pblsdm";  // Replace with the name of the database you created in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully to the database!";
?>
