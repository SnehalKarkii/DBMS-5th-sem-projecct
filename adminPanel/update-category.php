<?php include "nav.php"; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "select * from category where id = '$id'";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            $_SESSION['remove'] = "<div class='display-message error-message'>Selected data is not present</div>";
            header("location:" . INDEXPAGE . 'adminPanel/manage-category.php');
        }
    }
}



?>


<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Update Category </strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="data-input normal-word-space">
                <label for="title">Title</label>
                <input type="text" placeholder="Enter the title" name="title" id="title" value="<?php echo $title; ?>" required>
            </div>

            <div class="data-input normal-word-space current-image">
                <label for="currentimage">Current Image</label>
                <?php
                if ($current_image != "") {

                ?>
                    <img src="<?php echo INDEXPAGE; ?>images/category/<?php echo $current_image; ?>" width="150px" required>
                <?php
                } else {
                    $_SESSION['image-not'] = "<div class='display-message error-message'>Selected data is not present</div>";
                }

                ?>
                <input type="text" value="<?php echo $current_image; ?>" id="image" required>

            </div>



            <div class="data-input normal-word-space">
                <label for="newimage">Image</label>
                <input type="file" id="newimage" name="image">
            </div>


            <div class=" data-radio input normal-word-space">
                <label for="featured">Featured</label>
                <span class="radio">
                    <span>Yes</span>
                    <input type="radio" name="featured" value="Yes" <?php if ($featured == 'Yes') {
                                                                        echo "checked";
                                                                    } ?> required>

                    <span>No</span>
                    <input type="radio" name="featured" value="No" <?php if ($featured == 'No') {
                                                                        echo "checked";
                                                                    } ?> required>
                </span>

            </div>

            <div class="data-radio input normal-word-space">
                <label for="active">Active</label>
                <span class="radio active">
                    <span>Yes</span>
                    <input type="radio" name="active" value="Yes" <?php if ($active == 'Yes') {
                                                                        echo "checked";
                                                                    } ?> required>

                    <span>No</span>
                    <input type="radio" name="active" value="No" <?php if ($active == 'No') {
                                                                        echo "checked";
                                                                    } ?> required>
                </span>



            </div>
    </div>


    <div class="data-input normal-word-space">

    </div>

    <div class="text-center submit">
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <button class="link-btn btn-add-color" name="submit">Update Category</button>
    </div>

    </form>


    <?php

    if (isset($_POST['submit'])) {

        //Get all the values from our form
        $id = $_GET['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //Updating New Image if selected
        //Check whether the image is selected or not
        if (isset($_FILES['image']['name'])) {
            //Get the Image Details
            $imagename = $_FILES['image']['name'];

            //Check whether the image is available or not
            if ($imagename != "") {

                // taking the extension from the image
                $ext = end(explode('.', $imagename));


                // Renaming the image
                $imagename = "food_Image" . rand(000, 200) . '.' . $ext;
                $srcpath = $_FILES['image']['tmp_name'];
                $des_path = "../images/category/" . $imagename;


                // uploading the Image
                $upload = move_uploaded_file($srcpath, $des_path);

                //checking whether image is uploaded or not
                if (!$upload) {
                    $_SESSION['upload'] = "<div class='display-message error-message'>Failed to Upload Image.Try again later</div>";
                    header("location:" . INDEXPAGE . 'adminPanel/add-category.php');
                    die();
                }

                // Remove the Current Image if available
                if ($current_image != "") {
                    $remove_path = "../images/category/" . $current_image;

                    $remove = unlink($remove_path);

                    //CHeck whether the image is removed or not
                    //If failed to remove then display message and stop the processs
                    if (!$remove) {
                        //Failed to remove image
                        $_SESSION['upload'] = "<div class='display-message error-message'>Failed to Remove Image.Try again later</div>";
                        header("location:" . INDEXPAGE . 'adminPanel/add-category.php');
                        die(); //Stop the Process
                    }
                }
            } else {
                $imagename = $current_image;
            }
        } else {
            $imagename = $current_image;
        }

        //Update the Database
        $sql2 = "update category set 
                title = '$title',
                image_name = '$imagename',
                featured = '$featured',
                active = '$active' 
                where id=$id
            ";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //4. REdirect to Manage Category with MEssage
        //CHeck whether executed or not
        if ($res2) {
            //Category Updated
            $_SESSION['update'] = "<div class='display-message success-message'>Successfully updated category</div>";
            header('location:' . INDEXPAGE . 'adminPanel/manage-category.php');
        } else {
            //failed to update category
            $_SESSION['update'] = "<div class='display-message error-message'>Failed to Update Category.Try again later</div>";
            header('location:' . INDEXPAGE . 'adminPanel/manage-category.php');
        }
    }

    ?>
</div>
</div>
<?php include 'footer.php'; ?>