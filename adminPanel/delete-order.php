<?php 

include "config/connect.php";

if($_GET['id']){
    $id = $_GET['id'];
    $sql = "delete from `order` where id = $id";
    $res = mysqli_query($conn,$sql);

    if($res){
        $_SESSION['delete'] = "<div class='display-message success-message'>successfully deleted</div>";
        header("location:" . INDEXPAGE . 'adminPanel/manage-order.php');
    }else{
        $_SESSION['delete'] = "<div class='display-message error-message'>Failed to delete order</div>";
        header("location:" . INDEXPAGE . 'adminPanel/manage-order.php');
    }
}

?>