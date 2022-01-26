<?php include 'nav.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Add Food</strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="data-input normal-word-space">
                <label for="title">Title</label>
                <input type="text" placeholder="Enter the title" name="title" id="title" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="desc">Description</label>
                <textarea name="desc" id="" cols="100" rows="5" required></textarea>
            </div>

            <div class="data-input normal-word-space">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" required>
            </div>


            <div class="data-input normal-word-space">
                <label for="price">Price</label>
                <input type="text" placeholder="Enter the price" name="price" id="price" required>

            </div>


            <div class="data-input normal-word-space">
                <label for="category">Category</label>
                <span class="select">
                    <select name="category" id="category" required>

                        <?php
                        //Create PHP Code to display categories from Database
                        //Create SQL to get all active categories from database
                        $sql = "select * from category where active='Yes'";

                        //Executing qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            //WE have categories
                            while ($row = mysqli_fetch_assoc($res)) {
                                //get the details of categories
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


                        //2. Display on Drpopdown
                        ?>

                </span>
                </select>

            </div>

            <div class="data-radio input normal-word-space">
                <label for="featured">Featured</label>
                <span class="radio">
                    <span>Yes</span>
                    <input type="radio" name="featured" value="Yes" required>

                    <span>No</span>
                    <input type="radio" name="featured" value="No" required>
                </span>

            </div>

            <div class="data-radio input normal-word-space">
                <label for="active">Active</label>
                <span class="radio active">
                    <span>Yes</span>
                    <input type="radio" name="active" value="Yes" required>

                    <span>No</span>
                    <input type="radio" name="active" value="No" required>
                </span>



            </div>
    </div>


    <div class="data-input normal-word-space">

    </div>

    <div class="text-center submit">
        <button class="link-btn btn-add-color" name="submit">Add food</button>
    </div>
    </form>

    <?php

    //CHeck whether the button is clicked or not
    if (isset($_POST['submit'])) {
        //Add the Food in Database
        // Get the DAta from Form
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        //Check whether radion button for featured and active are checked or not
        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        } else {
            //Setting the Default Value
            $featured = "No";
        }

        if (isset($_POST['active'])) {
            $active = $_POST['active'];
        } else {

            //Setting Default Value
            $active = "No";
        }

        //Check whether the select image is clicked or not and upload the image only if the image is selected
        if (isset($_FILES['image']['name'])) {
            //Get the details of the selected image
            $imagename = $_FILES['image']['name'];

            //Check Whether the Image is Selected or not and upload image only if selected
            if ($imagename != "") {

                //Get the extension of selected image 
                $ext = end(explode('.', $imagename));

                // Create New Name for Image
                $imagename = "foodname-" . rand(000, 200) . "." . $ext;

                // Upload the Image

                // Source path is the current location of the image
                $src = $_FILES['image']['tmp_name'];

                //Destination Path for the image to be uploaded
                $dst = "../images/food/" . $imagename;

                //Finally Uppload the food image
                $upload = move_uploaded_file($src, $dst);

                //check whether image uploaded of not
                if (!$upload) {
                    //Failed to Upload the image
                    //REdirect to Add Food Page with Error Message
                    $_SESSION['upload'] = "<div class='display-message error-message'>Failed to Upload Image.Try again later</div>";
                    header("location:" . INDEXPAGE . 'adminPanel/manage-food.php');
                    //STop the process
                    die();
                }
            }
        } else {
            //Setting Default Value as blank
            $imagename = "";
        }


        //Create a SQL Query to Save or Add food
        $sql2 = "insert into food set 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$imagename',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //CHeck whether data inserted or not
        if ($res2) {
            //Data inserted Successfullly
            $_SESSION['add-food'] = "<div class='display-message success-message'>Food added Successfully</div>";
            header("location:" . INDEXPAGE . 'adminPanel/manage-food.php');
        } else {
            //FAiled to Insert Data
            $_SESSION['add-food'] = "<div class='display-message error-message'>Failed to add food</div>";
            header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
        }
    }

    ?>

</div>
</div>
<?php include 'footer.php' ?>