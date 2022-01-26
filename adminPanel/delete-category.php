<?php
include 'config/connect.php';

if(isset($_GET['id']) AND isset($_GET['image_name'])){
   $id = $_GET['id'];
   $imagename = $_GET['image_name'];


   if($imagename != ""){
    //    Giving the destination path
       $path = "../images/category/".$imagename;
    
    //    Remove the image from the physical path
       $remove = unlink($path);
    

       if(!$remove){
           $_SESSION['remove']= "<div class='display-message error-message'>Failed to Delete Image.Try again later</div>";
           header("location:" . INDEXPAGE . 'adminPanel/manage-category.php');
           die();
        }
        
    }
    
   $sql = "delete from category where id = '$id'";

   $res = mysqli_query($conn,$sql);

//    Checking whether the query is working correctly or not
   if($res){
    $_SESSION['delete-category']= "<div class='display-message success-message'>Successfully delete the item</div>";
    header("location:" . INDEXPAGE . 'adminPanel/manage-category.php');
   }
}
