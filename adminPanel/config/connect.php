<?php

use JetBrains\PhpStorm\NoReturn;
// Sessions
session_start();


// Constant
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food_order');
define("INDEXPAGE",'http://localhost/dbms/');

// Making connection to database
$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die("Connection Failed");
?>