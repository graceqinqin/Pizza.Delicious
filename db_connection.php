<?php
// db_connection.php

// Database credentials
$servername = "localhost"; // or your host (if not localhost)
$username = "root";        // your database username
$password = "";            // your database password (leave empty for localhost)
$dbname = "pizza";         // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
