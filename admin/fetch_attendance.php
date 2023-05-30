<?php
include_once '../db_connect.php';

function isDate($value)
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

if ( $_POST['id'] ){
    $id = $_POST['id'];

    $query = "SELECT e.name, a.checkin, a.checkout, a.date, a.day
          FROM attendance a
          INNER JOIN employe e ON a.id = e.id
          WHERE a.id = $id;";
}else{
    $query = "SELECT e.name, a.checkin, a.checkout, a.date, a.day
          FROM attendance a
          INNER JOIN employe e ON a.id = e.id";
}

$result = mysqli_query($con, $query);

if ($result === false) {
    die("Query execution failed: " . mysqli_error($con));
}

$data = array();
while ($row = mysqli_fetch_assoc($result)) {

    if( isDate($row['checkin']) ){
        if( $row['checkout'] == NULL ){
            $row['checkin'] = date('h:i A', strtotime($row['checkin']));
            $row['checkout'] = 'Not Defined';
        }else{
            $row['checkin'] = date('h:i A', strtotime($row['checkin']));
            $row['checkout'] = date('h:i A', strtotime($row['checkout']));
        }

    }

    $row['date'] = date('d-m-Y', strtotime($row['date']));

    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);


// Close the database connection
mysqli_close($con);
