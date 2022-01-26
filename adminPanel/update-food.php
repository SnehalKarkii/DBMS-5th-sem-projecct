<?php include 'nav.php' ?>
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "select * from food where id=$id";

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    //Get the Individual Values of Selected Food
    $title = $row['title'];
    $description = $row['description'];
    $price = $row['price'];
    $currentimage = $row['image_name'];
    $currentcategory = $row['category_id'];
    $featured = $row['featured'];
    $active = $row['active'];
} else {
    //Redirect to Manage Food
    header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
}
?>


<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Update Food</strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="data-input normal-word-space">
                <label for="title">Title</label>
                <input type="text" placeholder="Enter the title" name="title" id="title" value="<?php echo $title; ?>" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="desc">Description</label>
                <textarea name="desc" cols="100" rows="5" required><?php echo $description; ?> </textarea>
            </div>

            <div class="data-input normal-word-space">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" required>
            </div>


            <div class="data-input normal-word-space">
                <label for="price">Price</label>
                <input type="text" placeholder="Enter the price" name="price" id="price" value="<?php echo $price; ?>" required>

            </div>

            <div class="data-input normal-word-space current-image">
                <label for="cimage">Current Image</label>
                <?php
                if ($currentimage != "") {

                ?>
                    <img src="<?php echo INDEXPAGE; ?>images/food/<?php echo $currentimage; ?>" width="150px" required>
                <?php
                } else {
                    $_SESSION['image-not'] = "<div class='display-message error-message'>Selected data is not present</div>";
                }

                ?>
                <input type="text" value="<?php echo $currentimage; ?>" name="currentImage" id="cimage" required>

            </div>



            <div class="data-input normal-word-space">
                <label for="category">Category</label>
                <span class="select">
                    <select name="category" id="category" required>

                        <?php

                        //Create SQL to get all active categories from database
                        $sql1 = "select * from category where active='Yes'";

                        //Executing qUery
                        $res1 = mysqli_query($conn, $sql1);


                        $count = mysqli_num_rows($res1);

                        if ($count > 0) {

                            while ($row = mysqli_fetch_assoc($res1)) {
                                $id = $row['id'];
                                $title = $row['title'];
                        ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                            }
                        } else {
                            //we do not have category
                            ?>
                            <option value="0">No Category Found</option>
                        <?php
                        }
                        ?>

                </span>
                </select>

            </div>

            <div class="data-radio input normal-word-space">
                <label for="featured">Featured</label>
                <span class="radio">
                    <span>Yes</span>
                    <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") {
                                                                        echo "checked";
                                                                    } ?> required>

                    <span>No</span>
                    <input type="radio" name="featured" value="No" <?php if ($featured == "No") {
                                                                        echo "checked";
                                                                    } ?> required>
                </span>

            </div>

            <div class="data-radio input normal-word-space">
                <label for="active">Active</label>
                <span class="radio active">
                    <span>Yes</span>
                    <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") {
                                                                        echo "checked";
                                                                    } ?> required>
                    <span>No</span>
                    <input type="radio" name="active" value="No" <?php if ($active == "No") {
                                                                        echo "checked";
                                                                    } ?> required>
                </span>
            </div>
    </div>

    <div class="text-center submit">
        <button class="link-btn btn-add-color" name="submit">Update food</button>
    </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $price = $_POST['price'];
        $current_image = $_POST['currentImage'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        //Check whether upload button is clicked or not
        if (isset($_FILES['image']['name'])) {
            $imagename = $_FILES['image']['name'];
            //Check whether th file is available or not
            if ($imagename != "") {
                //Rename the Image
                $tmp  = explode('.', $imagename);
                $ext = end($tmp);
                $imagename = "Food-Name-" . rand(000, 999) . '.' . $ext;
                //Get the Source Path and DEstination PAth
                $src_path = $_FILES['image']['tmp_name']; //Source Path
                $dest_path = "../images/food/" . $imagename; //DEstination Path
                //Upload the image
                $upload = move_uploaded_file($src_path, $dest_path);
                /// CHeck whether the image is uploaded or not
                if (!$upload) {
                    $_SESSION['upload'] = "<div class='display-message error-message'>Failed to upload Image</div>";
                    echo "<script>window.location.href='http://localhost/dbms/adminPanel/manage-food.php'</script>";
                    // header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
                    die();
                }
                // Remove current Image if Available
                if ($current_image != "") {
                    $remove_path = "../images/food/" . $current_image;
                    $remove = unlink($remove_path);
                    //Check whether the image is removed or not
                    if (!$remove) {
                        //FAiled to Insert Data
                        $_SESSION['add-food'] = "<div class='display-message error-message'>Failed to remove image</div>";
                        echo "<script>window.location.href='http://localhost/dbms/adminPanel/manage-food.php'</script>";
                        // header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
                        die();
                    }
                }
            } else {
                $imagename = $current_image; //Default Image when Image is Not Selected
            }
        } else {
            $imagename = $current_image; //Default Image when Button is not Clicked
        }
        //Update the Food in Database
        $sql3 = "update food set 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$imagename',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                where id=$id
            ";
        $res3 = mysqli_query($conn, $sql3);
        if ($res3) {
            $_SESSION['update'] = "<div class='display-message success-message'>food update Successfully</div>";
            // header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
            echo "<script>window.location.href='http://localhost/dbms/adminPanel/manage-food.php'</script>";
        } else {

            $_SESSION['update'] = "<div class='display-message error-message'>Failed to update food</div>";
            // header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
            echo "<script>window.location.href='http://localhost/dbms/adminPanel/manage-food.php'</script>";
        }
    }

    ?>

    <?php include 'footer.php'; ?>