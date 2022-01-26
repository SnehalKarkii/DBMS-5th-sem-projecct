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

<body>
    <!--**********Navbar Section*********-->
    <header>
        <div class="normal-word-space navbar">
            <nav>
                <div class="logo">
                    <p>Shree</p>
                </div>
                <ul>
                    <li><a href="<?php echo INDEXPAGE; ?>index.php">home</a></li>
                    <li><a href="<?php echo INDEXPAGE; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo INDEXPAGE; ?>food.php">food</a></li>
                    <li><a href="<?php echo INDEXPAGE; ?>order-details.php">order</a></li>
                    <li>
                                                
                        <a href="#"><?php if($_SESSION['user-access']){echo $_SESSION['user-access'];} ?></a>
                        <ul class="dropdown">
                            
                            <li><a href="include/unset-user.php">logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
           
    </header>