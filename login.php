<?php
include_once "header.php";

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['email'] )){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM employe WHERE email = '$email'";
//    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = $con->query($sql);

    // Check if a matching user is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $storedPassword)) {
            // Password is correct, proceed with login
            session_start();

            // Store relevant user information in the session
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];

            // Redirect the user to the desired page
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password.";
        }
    } else {
        // No user found with the provided email
        echo "Invalid email or password.";
    }

    // Close the connection
    $con->close();

}



?>

<div class="ls_container">
    <div class="card">

        <img src="./assets/logo.png">

        <h2 class="card_title">Login</h2>

        <form class="card_form" action="login.php" method="post">
            <div class="input">
                <input type="text" class="input_field" name="email" required placeholder="Enter your email"/>
            </div>

            <div class="input">
                <input type="password" class="input_field" name="password" required placeholder="Enter your password"/>
            </div>

            <button class="card_button">Login</button>

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
