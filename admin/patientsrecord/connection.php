<?php
$servername = "localhost";
$username = "root";
$password = ""; // or your database password
$database = "banquerohanHSRS_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
