<?php
echo 'cron is working';
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

// Get the current date
$currentDate = date('Y-m-d');

// Check if today's date is listed in the holiday table
$holidayQuery = "SELECT * FROM holiday WHERE holiday_date = '$currentDate'";
$holidayResult = mysqli_query($con, $holidayQuery);

if ($holidayResult && mysqli_num_rows($holidayResult) == 0) {

    // Retrieve the list of users who did not have any check-in or check-out entries for the current day
    $query = "SELECT id FROM employe WHERE id NOT IN (SELECT id FROM attendance WHERE date = '$currentDate')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Update the records with "LEAVE" for both check-in and check-out fields
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['id'];
            $day = date('l');
            $updateQuery = "INSERT INTO attendance (id, checkin, checkout, date, day) VALUES ($userId, 'LEAVE', 'LEAVE', '$currentDate', '$day')";
            mysqli_query($con, $updateQuery);
        }
    }

}

