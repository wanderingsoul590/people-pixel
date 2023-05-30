<?php
$currentPage = 'Employee';

include_once "./header.php";

?>
    <div class="container">
        <h2><?php echo $currentPage; ?></h2>

        <div class="data_table_wrapper data_table_wrapper_attendace">
            <div class="dt-buttons">
                <button id="new_employee" class="dt-button buttons-html5"><i class="fa-solid fa-user-plus"></i> &nbsp; Add Employee</button>
            </div>
            <table id="employee_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="alert_container">

        </div>

    </div>

<?php

require_once './footer.php';




