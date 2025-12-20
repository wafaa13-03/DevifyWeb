<?php
$host = "localhost";
$dbname = "devify_db";
$username = "devify_user";   // your MySQL user
$password = "myfirstDB!";    // your MySQL password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
