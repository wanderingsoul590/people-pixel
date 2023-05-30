$(document).ready(function() {
    // Get the current URL
    var url = new URL(window.location.href);

    // Get the value of the "id" parameter
    var id = url.searchParams.get("id");

    $('#myTable').DataTable({
        "ajax": {
            "url": "fetch_attendance.php", // PHP script to fetch data from MySQL table
            "type": "POST", // Set the request type to POST
            "data": function (d) {
                // Add additional parameters to the data object
                d.id = id;
                // You can add more parameters as needed
            },
            "dataSrc": "" // Use an empty string as the data source
        },
        "columns": [
            { "data": "name" },
            { "data": "checkin" },
            { "data": "checkout" },
            { "data": "date" },
            { "data": "day" }
        ],
        "columnDefs": [
            { "width": "400px", "targets": 0 } // Set width of the first column to 400px
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true,
        "lengthMenu": [6, 10, 25, 50, 100, 500, 1000, 5000],
        order: [[3, 'desc']],
        "language": {
            "lengthMenu": "Show _MENU_ entries per page",
            "search": "Search:",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Excel',
                text:'<i class="fa-solid fa-file-excel"></i> Export Excel',
                exportOptions: {
                    modifier: {
                        page: 'all' // Export all data, ignoring pagination
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'PDF',
                text: '<i class="fa-solid fa-file-pdf"></i> Export PDF',
                exportOptions: {
                    modifier: {
                        page: 'all' // Export all data, ignoring pagination
                    }
                }
            }
        ]
    });

    $(function ()
    {
        var table = $('#myTable').DataTable();

        $("#btnExport").click(function(e)
        {
            table.page.len( -1 ).draw();
            window.open('data:application/vnd.ms-excel,' +
                encodeURIComponent($('#myTable').parent().html()));
            setTimeout(function(){
                table.page.len(10).draw();
            }, 1000)

        });
    });

    $('#employee_table').DataTable({
        "ajax": {
            "url": "fetch_employee.php", // PHP script to fetch data from MySQL table
            "dataSrc": "" // Use an empty string as the data source
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "designation" },
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="employee_actions">' +
                        '<span class="delete-btn" data-id='+data.id+'><i class="fa-solid fa-trash"></i>' +
                        '</span><span class="profile-btn" title="profile"><a href="./profile.php?id='+data.id+'"><i class="fa-solid fa-user"></i></span>' +
                        '</div>';
                }
            }
        ],
        "columnDefs": [
            { "width": "400px", "targets": 1 } // Set width of the first column to 400px
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true,
        "lengthMenu": [6, 10, 25, 50, 100],
        "language": {
            "lengthMenu": "Show _MENU_ entries per page",
            "search": "Search:",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
    });

    var employee_table = $('#employee_table').DataTable();

    // Handle delete button click event
    $('#employee_table').on('click', '.delete-btn', function() {
        var employeeId = $(this).data('id');

        if (confirm("Are you sure you want to delete this employee?")) {
            // Send Ajax request to delete the employee
            $.ajax({
                url: 'delete_employee.php',
                type: 'POST',
                data: {id: employeeId},
                success: function(response) {
                    // Remove the row from the data table
                    $('#employeeTable').DataTable().row($(this).closest('tr')).remove().draw(false);
                    employee_table.ajax.reload(null, false);
                    alert(response);
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while deleting the employee: " + error);
                }
            });
        };

    });

    $('#new_employee').on('click', function (){

        var url = "../create-account.php";
        var newWindow = window.open(url, '_blank', 'location=yes,height=670,width=520,scrollbars=yes,status=yes, top=100, left=500');



        // Define a message event listener to receive messages from child windows
        window.addEventListener('message', receiveMessage, false);

        // Handle the received message from the child window
        function receiveMessage(event) {
            var data = event.data;

            $('.alert_container').html(`<div class="alert alert_message alert-info alert-dismissible fade" role="alert">
                    <strong id="alert_data"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
            $('#alert_data').html(data.message)
            $('.alert_message').addClass('show');

            var dataTable = $('#employee_table').DataTable();

            function refreshDataTable() {
                dataTable.ajax.reload(null, false); // Reload the DataTable without resetting the current page
            }

            refreshDataTable();
        }
    })



    let calender_dates = $('.calendar td');


    calender_dates.on('contextmenu', function (event) {


        if( $(".custom-menu") ){
            $(".custom-menu").remove();
        }

        event.preventDefault(); // Prevent the default browser context menu from appearing

        calender_dates.removeClass('active_date'); // Remove 'active_date' class from all calendar dates
        $(this).addClass('active_date'); // Add 'active_date' class to the clicked calendar date

        var date = $(this).data("date");

        if( $(this).hasClass('holiday') ){
            var customMenu = $("<div>").addClass("custom-menu")
                .append(
                    $("<form>").attr("action", "").attr("method", "post")
                        .append(
                            $("<input>").attr("type", "hidden").val(date).attr("name",'holiday_date'),
                            $("<button>").attr("id", "remove_holiday").addClass("dt-button buttons-html5").attr("name",'remove_holiday')
                                .append($("<i>").addClass("fa-solid fa-trash")).append("&nbsp; Remove Holiday")
                        )
                );
        }else {
            var customMenu = $("<div>").addClass("custom-menu")
                .append(
                    $("<form>").attr("action", "").attr("method", "post")
                        .append(
                            $("<input>").attr("type", "text").attr("placeholder", "Holiday Name").attr("name",'holiday_name').attr('required','true'),
                            $("<input>").attr("type", "hidden").val(date).attr("name",'holiday_date'),
                            $("<button>").attr("id", "new_holiday").addClass("dt-button buttons-html5").attr("name",'add_holiday')
                                .append($("<i>").addClass("fa-solid fa-plus")).append("&nbsp; Add Holiday")
                        )
                );
        }


        $("body").append(customMenu);

        customMenu.css({
            display: "flex",
            left: event.clientX,
            top: event.clientY
        });

        customMenu.on("click", function (event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document level
        });

        $(document).on("click", function (event) {
            customMenu.remove();
            calender_dates.removeClass('active_date'); // Remove 'active_date' class from all calendar dates
        });


    });



    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

});