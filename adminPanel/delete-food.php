<?php 
    
    include "config/connect.php";


    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        
        $id = $_GET['id'];
        $imagename = $_GET['image_name'];

        //CHeck whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // Deleting image from the folder
            //Get the Image Path
            $path = "../images/food/".$imagename;

            //Remove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if(!$remove)
            {
                //Failed to Remove image
                "<div class='display-message error-message'>Failed to remove image</div>";
                header('location:'.INDEXPAGE.'admin/manage-food.php');
                //Stop the Process of Deleting Food
                die();
            }

        }

        //Delete Food from Database
        $sql = "delete from food where id=$id";
        $res = mysqli_query($conn, $sql);

        
        if($res)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='display-message success-message'>successfully deleted food</div>";
            header("location:" . INDEXPAGE . 'adminPanel/manage-food.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['add-food'] = "<div class='display-message error-message'>Failed to delete Food</div>";
            header("location:" . INDEXPAGE . 'adminPanel/manage-food.php');
        }

    }
    else
    {
        //Redirect to Manage Food Page
        
        $_SESSION['unauthorize'] = "<div class='display-message error-message'>Unauthorized Access.</div>";
        header('location:'.INDEXPAGE.'admin/manage-food.php');
    }

?>