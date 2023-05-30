<?php
$currentPage = 'Attendance';
include_once "./header.php";


// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Prepare the month dropdown options
$months = array(
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
);

// Check if a month is selected from the dropdown, default to the current month
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : $currentMonth;

// Fetch the attendance data for the selected month
$sql = "SELECT date, COUNT(*) AS leave_count FROM attendance WHERE MONTH(date) = $selectedMonth AND YEAR(date) = $currentYear AND checkin = 'LEAVE' GROUP BY date";
$result = $con->query($sql);

// Prepare arrays for labels and data
$labels = [];
$data = [];

if ($result->num_rows > 0) {
    // Loop through the query results and populate the arrays
    while ($row = $result->fetch_assoc()) {
        $labels[] = date('d', strtotime( $row['date'] ));
        $data[] = $row['leave_count'];
    }
} else {
    // If no leave data found for the selected month, set all values to 0
    for ($day = 1; $day <= 30; $day++) {
        $labels[] = $day;
        $data[] = 0;
    }
}


?>

<div class="container">
    <h2><?php echo $currentPage; ?></h2>


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

    <div class="data_table_wrapper" >
        <h3 style="float: left">Leaves</h3>
        <div class="select_month_wrapper">
            <span for="month">Select Month: &nbsp;&nbsp;</span>
            <select class="custom_select" name="month" id="month">
                <?php foreach ($months as $month => $monthName) { ?>
                    <option value="<?php echo $month; ?>" <?php if ($month == $selectedMonth) echo 'selected'; ?>><?php echo $monthName; ?></option>
                <?php } ?>
            </select>
            <button onclick="changeMonth()" class="dt-button buttons-html5">Go</button>
        </div>
        <canvas id="leaveChart" style="height: 400px; width: 100%"></canvas>
    </div>

</div>




<?php

require_once './footer.php';

?>

<script>
    function changeMonth() {
        var selectedMonth = document.getElementById('month').value;
        var url = window.location.pathname + '?month=' + selectedMonth;
        window.location.href = url;
    }

    // Create the chart
    var ctx = document.getElementById('leaveChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Leave Count',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(0, 127, 251, 0.6)',
                borderColor: 'rgba(1, 83, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0, // Set the precision to 0
                        callback: function (value, index, values) {
                            return value.toFixed(0); // Format the value as integer
                        }
                    }
                }
            }
        }
    });
</script>



