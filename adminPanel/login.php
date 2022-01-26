<?php
include 'config/connect.php';

if (isset($_POST['submit'])) {

    // Taking the username from the login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Query fetching data username and password from the database
    $sql = "select * from admin where userName = '$username' and password = '$password'";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        // count cheking whether there is row available or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $_SESSION['login'] = "<div class='display-message success-message'>Login Successfully</div>";
            
            //Authentication or control access 
            $_SESSION['user'] = $username;
            header("location:" . INDEXPAGE . "adminPanel");
        } else {
            $_SESSION['not-login'] = "<div class='display-message error-message'>Invalid username or password</div>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login Form</title>
</head>
<style>
    body{
    height: 100vh;
    width: 100%;
    background-image   : linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(../images/bg3.jpg);
    background-size:cover;
    background-position: center;
    }
</style>
<body>

    <div class="container">
        <div class="login-form">

            <h2 class="text-center"> <strong class="title-letter-space text-uppercase ">Login </strong></h2>
            <?php
            if (isset($_SESSION['not-login'])) {
                echo $_SESSION['not-login'];
                unset($_SESSION['not-login']);
            }
            ?>


            <form action="#" method="post">


                <div class="data normal-word-space">
                    <label for="name">Username</label>
                    <input type="text" placeholder="Enter username" id="name" name="username" required>
                </div>

                <div class="data">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" placeholder="Enter password" name="password" required>
                </div>

                <div class="text-center submit">
                    <button class="link-btn btn-add-color" name="submit">submit</button>
                </div>


            </form>
        </div>
    </div>

</body>

</html>