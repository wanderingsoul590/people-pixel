<?php
$currentPage = 'Employee Profile';
include_once "./header.php";


if (  isset( $_GET['id'] ) ){
    $user_id = $_GET['id'];
}else{
    header( 'Location: index.php' );
}

// Prepare the SQL statement
$sql = "SELECT * FROM employe WHERE id = ?";

// Prepare the statement
$stmt = mysqli_prepare($con, $sql);

// Bind the user ID parameter
mysqli_stmt_bind_param($stmt, "i", $user_id);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Fetch the user data
$userData = mysqli_fetch_assoc($result);

// Close the statement
mysqli_stmt_close($stmt);

$currentYear = date('Y');

$sql = "SELECT COUNT(*) AS leave_count
FROM attendance
WHERE id = $user_id
  AND YEAR(date) = $currentYear
  AND checkin = 'LEAVE';";
$result = $con->query($sql);

if( $result ){
    $taken_leave = $result->fetch_assoc()['leave_count'];
}else{
    $taken_leave = 0;
}

?>
    <div class="container">
    <h2><?php echo $userData['name']; ?></h2>

    <div class="data_table_wrapper" >
        <table>
            <tr class="profile_info"><td>Name </td><td><?php echo $userData['name']; ?></td></tr>
            <tr class="profile_info"><td>Email </td><td><?php echo $userData['email']; ?></td></tr>
            <tr class="profile_info"><td>Phone Number </td><td><?php echo $userData['phone']; ?></td></tr>
            <tr class="profile_info"><td>Designation </td><td><?php echo $userData['designation']; ?></td></tr>
            <tr class="profile_info"><td>Total Leave </td><td><?php echo $userData['leave_number']; ?></td></tr>
            <tr class="profile_info"><td>Leave Balance </td><td><?php echo $userData['leave_number'] - $taken_leave; ?></td></tr>
        </table>
        </td>

    </div>

    <div class="data_table_wrapper data_table_wrapper_attendace">
        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th>Date</th>
                <th>Day</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

<?php

require_once './footer.php';




