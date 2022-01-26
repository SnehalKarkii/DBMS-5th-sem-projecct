<?php

include 'config/connect.php';
// Getting id throgh add admin page
$id = $_GET['id'];

// Query to delte the selected row
$sql = "delete from customer_signup where id = $id";

$res = mysqli_query($conn,$sql);

// Checking whether query is working or not
if($res){
    $_SESSION['delete'] = "<div class='display-message success-message'>Selected row deleted Successfully</div>";
    header("location:".INDEXPAGE."adminPanel/manage-customers.php");
}else{
    $_SESSION['delete'] = "<div class='display-message error-message'>Failed to Delete.Try again later</div>";
    header("location:".INDEXPAGE."adminPanel/manage-customers.php");
}
