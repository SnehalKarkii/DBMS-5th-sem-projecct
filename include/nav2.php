<?php include "adminPanel/config/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>

<style>
    li{
        padding: 10px 30px;
        border: 1px solid green;
        margin-left: 10px;
        font-weight: bold;
    }

</style>

<body>
    <!--**********Navbar Section*********-->
    <header>
        <div class="normal-word-space navbar">
            <nav>
                <div class="logo">
                    <p>Shree</p>
                </div>
                <ul>
                    <li><a href="<?php echo INDEXPAGE; ?>customer-login.php">Login</a></li>
                    <li><a href="<?php echo INDEXPAGE; ?>customer-signup.php">Sign up</a></li>
                </ul>
            </nav>
           
    </header>