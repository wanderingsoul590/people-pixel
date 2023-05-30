<?php
date_default_timezone_set('Asia/Kolkata');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";  // Database host
$username = "u548343843_people";  // Database username
$password = "F12@kzimLl";  // Database password
$database = "u548343843_people";  // Database name

// Create a new MySQLi connection
$con = new mysqli($host, $username, $password, $database);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Connection is successful, perform database operations...

