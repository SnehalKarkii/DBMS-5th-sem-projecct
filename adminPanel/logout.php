<?php

include "config/connect.php";

// unset the username
session_destroy();

header("location:".INDEXPAGE."adminPanel/login.php");

?>