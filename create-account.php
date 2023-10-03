<?php
include_once "header.php";

$hashedPassword = password_hash('123', PASSWORD_DEFAULT);
$sql =  "UPDATE employe SET password = '$hashedPassword' WHERE email = 'maahi.pixelideas@gmail.com';";

if ($con->query($sql) === TRUE) {
    echo "yes maahi";
}else{
echo "Error: " . $con->error;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['name'] )){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "SELECT * FROM employe WHERE email = '$email'";

    // Execute the query
    $result = $con->query($sql);

    // Check if any matching rows exist
    if ($result->num_rows > 0) {
        // Email is already registered
        echo "Email is already registered.";
    } else {
        // Email is not registered

        $sql = "INSERT INTO employe (name, email, phone, designation, password, leave_number) VALUES ('$name', '$email', '99865959895', '$designation', '$hashedPassword', '18')";
        
        if ($con->query($sql) === TRUE) {
            ?>
            <script>
                // Access the parent window using the 'window.opener' property
                var parentWindow = window.opener;

                // Send data to the parent window using the 'postMessage()' method
                var data = { message: 'Employee Account Created Successfully!' };
                parentWindow.postMessage(data, '*');

                // Close the child window
                window.close();

            </script>
            <?php
        } else {
            ?>
            <script>
                // Access the parent window using the 'window.opener' property
                var parentWindow = window.opener;

                // Send data to the parent window using the 'postMessage()' method
                var data = { message: '<?php echo "Error: " . $con->error; ?>' };
                parentWindow.postMessage(data, '*');

                // Close the child window
                window.close();

            </script>
            <?php
        }

        // Close the connection
        $con->close();
    }


}

?>

<div class="ls_container">
    <div class="card">
        <img src="./assets/logo.png">
        <h2 class="card_title">Create Account</h2>
        <form class="card_form" action="" method="post">
            <div class="input">
                <input type="text" class="input_field" name="name" required placeholder="Enter full name"/>
            </div>
            <div class="input">
                <input type="text" class="input_field" name="email" required placeholder="Enter email"/>
            </div>
            <div class="input">
                <input type="text" class="input_field" name="designation" required placeholder="Enter designation"/>
            </div>
            <div class="input">
                <input type="password" class="input_field" name="password" required placeholder="Enter password"/>
            </div>
            <button class="card_button">Create Account</button>
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


<?php
include_once "footer.php";
?>
