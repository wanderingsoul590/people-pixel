<?php
include_once "../db_connect.php";


if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    // Get the employee ID from the Ajax request
    $employeeId = $_POST['id'];

    $deleteSql = "DELETE FROM employe WHERE id = '$employeeId'";
    if ($con->query($deleteSql) === TRUE) {
        $response = "Employee deleted successfully.";
    } else {
        $response = "Error deleting record: " . $con->error;
    }


    echo $response;
}