<?php include "config/connect.php"; ?>
<?php

if(!isset($_SESSION['user'])){
    // $_SESSION['login'] = "<div class='display-message error-message'>first login</div>";
    header("location:".INDEXPAGE."adminPanel/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
    <nav class="title-letter-space text-uppercase">
        <ul>
            <li><a href="index.php">home</a></li>
            <li><a href="manage-admin.php">admin</a></li>
            <li><a href="manage-customers.php">Customers</a></li>
            <li><a href="manage-category.php">category</a></li>
            <li><a href="manage-food.php">food</a></li>
            <li><a href="manage-order.php">order</a></li>
        </ul>

        <div class="text-center submit logout">
            <a href ="logout.php" class="link-btn btn-danger-color">Log out</a>
        </div>
    </nav>