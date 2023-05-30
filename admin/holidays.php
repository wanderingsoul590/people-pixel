<?php
$currentPage = 'Holidays';

include_once "./header.php";

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    if( isset( $_POST['holiday_name'] ) ){
        // Retrieve the form data
        $holidayName = $_POST['holiday_name'];
        $holidayDate = $_POST['holiday_date'];


        // Insert the data into the holiday table
        $sql = "INSERT INTO holiday (holiday_name, holiday_date) VALUES ('$holidayName', '$holidayDate')";
        if ($con->query($sql) === TRUE) {
            header("Refresh:0");
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }else{
        $holidayDate = $_POST['holiday_date'];

        // Check if a record with the same date already exists
        $checkSql = "SELECT * FROM holiday WHERE holiday_date = '$holidayDate'";
        $checkResult = $con->query($checkSql);
        if ($checkResult->num_rows > 0) {
            // If a record exists, delete it
            $deleteSql = "DELETE FROM holiday WHERE holiday_date = '$holidayDate'";
            if ($con->query($deleteSql) === TRUE) {
                header("Refresh:0");
            } else {
                echo "Error deleting record: " . $con->error;
            }
        }

    }

}


//// Import data for every Sunday
//$start_date = "2023-01-01"; // Start date of the year
//$end_date = "2023-12-31";   // End date of the year
//
//$current_date = $start_date;
//while ($current_date <= $end_date) {
//    $day_of_week = date("w", strtotime($current_date));
//    if ($day_of_week == 0) {
//        // It's a Sunday, import data
//        $holiday_name = "Sunday";
//        $holiday_date = $current_date;
//
//        // Insert the data into the holiday table
//        $sql = "INSERT INTO holiday (id, holiday_name, holiday_date) VALUES (NULL, '$holiday_name', '$holiday_date')";
//        if (!mysqli_query($con, $sql)) {
//            echo "Error inserting data: " . mysqli_error($con);
//        }
//    }
//
//    $current_date = date("Y-m-d", strtotime($current_date . "+1 day"));
//}
//
//// Import data for second and fourth Saturdays
//$start_date = "2023-01-01"; // Start date of the year
//$end_date = "2023-12-31";   // End date of the year
//
//$current_date = $start_date;
//while ($current_date <= $end_date) {
//    $day_of_week = date("w", strtotime($current_date));
//    $week_number = ceil(date("j", strtotime($current_date)) / 7);
//
//    if ($day_of_week == 6 && ($week_number == 2 || $week_number == 4)) {
//        // It's the second or fourth Saturday, import data
//        $holiday_name = "Saturday";
//        $holiday_date = $current_date;
//
//        // Insert the data into the holiday table
//        $sql = "INSERT INTO holiday (id, holiday_name, holiday_date) VALUES (NULL, '$holiday_name', '$holiday_date')";
//        if (!mysqli_query($con, $sql)) {
//            echo "Error inserting data: " . mysqli_error($con);
//        }
//    }
//
//    $current_date = date("Y-m-d", strtotime($current_date . "+1 day"));
//}




?>
    <div class="container">
        <h2><?php echo $currentPage; ?></h2>

        <div class="data_table_wrapper">
            <form method="GET" action="" class="select_month_wrapper">
                <select name="month" class="custom_select">
                    <?php
                    $months = array(
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December'
                    );

                    $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('n');

                    foreach ($months as $monthNum => $monthName) {
                        $selected = ($monthNum == $selectedMonth) ? 'selected' : '';
                        echo "<option value=\"$monthNum\" $selected>$monthName</option>";
                    }
                    ?>
                </select>

                <select name="year" class="custom_select">
                    <?php
                    $startYear = 2020;
                    $endYear = 2030;
                    $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

                    for ($year = $startYear; $year <= $endYear; $year++) {
                        $selected = ($year == $selectedYear) ? 'selected' : '';
                        echo "<option value=\"$year\" $selected>$year</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Go" class="dt-button buttons-html5">
            </form>

            <?php
            // Retrieve selected month and year from the form
            $month = isset($_GET['month']) ? $_GET['month'] : date('n');
            $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

            // Get the first day and number of days in the month
            $firstDay = date('N', strtotime("$year-$month-01"));
            $totalDays = date('t', strtotime("$year-$month-01"));

            // Output the calendar table
            echo '<table class="calendar">';
            echo '<tr>';
            echo "<th>Mon</th>";
            echo "<th>Tue</th>";
            echo "<th>Wed</th>";
            echo "<th>Thu</th>";
            echo "<th>Fri</th>";
            echo "<th>Sat</th>";
            echo "<th>Sun</th>";
            echo '</tr>';

            $day = 1;
            $blankCells = $firstDay - 1;

            while ($blankCells > 0) {
                echo '<td class="empty"></td>';
                $blankCells--;
            }

            while ($day <= $totalDays) {
                if ($firstDay > 7) {
                    echo '</tr><tr>';
                    $firstDay = 1;
                }

                $dateString = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));

                // Check if the date exists in the 'holiday' table
                // Assuming the connection to the database is already established
                $query = "SELECT * FROM holiday WHERE holiday_date = '$dateString'";
                $result = mysqli_query($con, $query);

                if( $dateString == date('Y-m-d') ){
                    if (mysqli_num_rows($result) > 0) {
                        $holiday_name = mysqli_fetch_assoc($result)['holiday_name'];
                        echo '<td class="today holiday" data-date='.$dateString.'>' . $day. '<span>'.$holiday_name.'</span>' . '</td>';
                    }else{
                        echo '<td class="today" data-date='.$dateString.'>' . $day . '</td>';
                    }
                }elseif ( mysqli_num_rows($result) > 0 ){
                    $holiday_name = mysqli_fetch_assoc($result)['holiday_name'];
                    echo '<td class="holiday" data-date='.$dateString.'>' . $day. '<span>'.$holiday_name.'    </span>' . '</td>';
                }else{
                    echo '<td data-date='.$dateString.'>' . $day . '</td>';

                }

                $day++;
                $firstDay++;
            }

            while ($firstDay <= 7) {
                echo '<td class="empty"></td>';
                $firstDay++;
            }

            echo '</tr>';
            echo '</table>';
            ?>
        </div>



        <div class="alert_container">

        </div>

    </div>

<?php

require_once './footer.php';




