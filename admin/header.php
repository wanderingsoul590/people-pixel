<?php
include_once "../db_connect.php";
session_start();

$admin = ['dalsaniyaankit557@gmail.com', 'vg@pixelideas.site'];
// Check if the user is logged in
if ( !isset($_SESSION['email']) || ! in_array($_SESSION['email'], $admin) ) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - <?php echo $currentPage;?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<div class="admin_c">
    <div class="admin_menu">
        <div class="menu_header">
            <img src="../assets/logo.png">
        </div>
        <div class="admin_nav">
            <ul>
                <li><a href="/admin/" class="<?php echo ($currentPage === 'Attendance') ? 'active' : ''; ?>"><i class="fa-solid fa-fingerprint"></i> &nbsp; Attendance</a></li>
                <li><a href="employee.php" class="<?php echo ($currentPage === 'Employee') ? 'active' : ''; ?>"><i class="fa-solid fa-user-tie"></i> &nbsp; Employee</a></li>
                <li><a href="holidays.php" class="<?php echo ($currentPage === 'Holidays') ? 'active' : ''; ?>"><i class="fa-solid fa-mug-hot"></i> &nbsp; Holidays</a></li>
                <li><a href="leave_request.php" class="<?php echo ($currentPage === 'Leave Request') ? 'active' : ''; ?>"><i class="fa-solid fa-message"></i> &nbsp; Leave Request</a></li>
            </ul>
        </div>
    </div>
    <div class="admin_main">








