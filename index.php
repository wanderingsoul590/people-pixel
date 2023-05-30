<?php
echo 'hello this is test dsbvkjdsbvsdkjb';
session_start();
include_once "header.php";

$checkin = false;
$checkout = false;
$today_date = date("Y-m-d");
$id = $_SESSION['id'];

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}


$admin = ['dalsaniyaankit557@gmail.com', 'vg@pixelideas.site'];
// Check if the user is logged in
if ( isset($_SESSION['email']) || in_array($_SESSION['email'], $admin) ) {
    echo "<a href='./admin' class='admin_button'>Admin</a>";
}


$sql = "SELECT * FROM `attendance` WHERE `id` = '$id' AND `date` = '$today_date'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $checkin = true;
    $_SESSION['checkin_time'] = date("l, d F Y H:i:s", strtotime($row['checkin']));
    $checkin_time =  date('h:i A', strtotime($row['checkin']));
    if( $row['checkout'] !== NULL ){
        $checkout = true;
        $checkout_time = date('h:i A', strtotime($row['checkout']));
    }

}else{
    $checkin = false;
    $checkout = false;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['type'] ) ){

    $type = $_POST['type'];

    $day = date('l');

    $checkin_column = date("Y-m-d H:i:s");



    // Prepare the SQL statement based on the type of attendance
    if ($type === "checkin") {
        $sql = "INSERT INTO attendance (id, checkin, date, day) VALUES ('$id', '$checkin_column', '$today_date', '$day')";
    } elseif ($type === "checkout") {
        $sql = "UPDATE attendance SET checkout = '$checkin_column' WHERE `id` = '$id' AND `date` = '$today_date'";
    }

    // Execute the SQL statement
    if ($con->query($sql) === TRUE) {
        if ($type === "checkin") {
            $checkin = true;

            $body = "Hello Admin, <br> <b> ".$_SESSION['name']." </b>Checkin at <b>$checkin_column<b>";
            px_mail('vg@pixelideas.site', $_SESSION['name']." - Checkin", $body);

        } elseif ($type === "checkout") {
            $checkout = true;

            $body = "Hello Admin, <br> <b>".$_SESSION['name']."</b> Checkin at <b>$checkin_time</b> and Checkout at <b>$checkin_column</b>";
            px_mail('vg@pixelideas.site', $_SESSION['name']." - Checkout", $body);

        }
        header("Location: index.php");
    } else {
        echo "Error recording attendance: " . $con->error;
    }

    // Close the connection
}

?>

<div class="ls_container">
    <div class="card">
    <h2  style="text-align: center;font-size: 23px;" class="card_title"><?php echo "Howdy,&nbsp;" . $_SESSION['name'] . "!"; ?></h2>
        <h3 class="attendance_timer"><span class="hours">00</span> : <span class="minute">00</span> : <span class="second">00</span> </h3>
    <form id="attendanceForm" method="post" action="index.php">
        <input type="hidden" name="type" id="attendanceType">
        <?php
        if( ! $checkin ){
            ?>
                <button class="attendance_button checkin" onclick="setAttendanceType('checkin')">Check-in</button>
            <?php
        }elseif( ! $checkout ){
            ?>
                <button class="attendance_button checkout" onclick="setAttendanceType('checkout')">Check-out</button>
                <p style="display: none" class="chechin_time"><?php echo $_SESSION['checkin_time'];?></p>
                <span class="show_check_time">Check-in Time : <?php echo $checkin_time; ?></span>
            <?php
        }else{
            ?>
                <p style="display: none" class="chechin_time"><?php echo $_SESSION['checkin_time'];?></p>
                <p style="display: none" class="is_checkout">true</p>
                <span class="show_check_time">Check-in Time : <?php echo $checkin_time; ?></span>
                <span class="show_check_time">Check-out Time : <?php echo $checkout_time; ?></span>
            <?php
        }
        ?>

    </form>
    </div>
</div>
<ul class="background">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>

    function setAttendanceType(type) {
        document.getElementById("attendanceType").value = type;
        document.getElementById("attendanceForm").submit();
    }

    jQuery('document').ready(function (){


        var checkin_time = $('.chechin_time').html();
        var is_checkout = $('.is_checkout').html();

        if ( checkin_time ){
            let msec = Date.parse(checkin_time);
            let start = new Date(msec).getTime();

            var myfunc = setInterval(function() {
                var now = new Date().getTime();
                var timeleft = now - start + 4000;

                var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

                $('.hours').html(('0'+hours).slice(-2))
                $('.minute').html(('0'+minutes).slice(-2))
                $('.second').html(('0'+seconds).slice(-2))
            }, 1000)

            if( is_checkout ){

                var now = new Date().getTime();
                var timeleft = now - start + 4000;

                var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

                $('.hours').html(('0'+hours).slice(-2))
                $('.minute').html(('0'+minutes).slice(-2))
                $('.second').html(('0'+seconds).slice(-2))

                clearInterval(myfunc);

            }
        }

    });
</script>