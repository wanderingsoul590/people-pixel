<?php

include_once '../db_connect.php';


// Fetch the employee data from the database
$query = "SELECT * FROM employe";
$result = mysqli_query($con, $query);

// Prepare the data array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($con);

// Return the data as JSON response
header('Content-Type: application/json');
echo json_encode($data);
