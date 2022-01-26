<?php

include "../adminPanel/config/connect.php";

// unset the username
unset($_SESSION['user-access']);
header("location:".INDEXPAGE."index.php");

?>