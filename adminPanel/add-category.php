<?php include 'nav.php' ?>
<?php

// Checking whether button is clicked or not
if (isset($_POST['submit'])) {

    //Taking values from form and storing in the variable
    $title = $_POST['title'];


    // checking whether there is fetured is selected or not
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        // if not selected then automatically assigned to no
        $featured = "No";
    }

    // checking whether there is active is selected or not
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        // if not selected then automatically assigned to no
        $active = "No";
    }


    // check whether the image is selected or not

    if (isset($_FILES['image']['name'])) {

        // for uploading image ,image is required
        $imagename = $_FILES['image']['name'];

        if ($imagename != '') {

            // taking the extension from the image
            $ext = end(explode('.', $imagename));
         

            // Renaming the image
            $imagename = "food_Image" . rand(000, 200) .'.'.$ext;
            $srcpath = $_FILES['image']['tmp_name'];
            $des_path = "../images/category/" . $imagename;


            // uploading the Image
            $upload = move_uploaded_file($srcpath, $des_path);

            //checking whether image is uploaded or not
            if (!$upload) {
                $_SESSION['upload'] = "<div class='display-message error-message'>Failed to Upload Image.Try again later</div>";
                header("location:". INDEXPAGE .'add-category.php');
                die();
            }
        }
    }else{
        $imagename = "";
    }


    // Query for adding new category   
    $sql = "insert into category set title = '$title',
    image_name = '$imagename',
   featured = '$featured',
   active = '$active'
   ";

    // Executing Query and save it into data Base
    $res = mysqli_query($conn, $sql) or die("Query error");


    //Checking whether database is successfully added or not  
    if ($res) {

        // sesseion variable to display the message
        $_SESSION['add-category'] = "<div class='display-message success-message'>Successfully added Category</div>";

        // Redirecting page to category 
        header("location:" . INDEXPAGE . 'adminPanel/manage-category.php');
    } else {
        $_SESSION['add-category']= "<div class='display-message error-message'>Failed to Add Category.Try again later</div>";
        header("location:" . INDEXPAGE . 'adminPanel/manage-category.php');
    }
}

?>

<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Add Category </strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="data-input normal-word-space">
                <label for="title">Title</label>
                <input type="text" placeholder="Enter the title" name="title" id="title" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" required>
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


   

    <div class="text-center submit">
        <button class="link-btn btn-add-color" name="submit">Add Category</button>
    </div>

    </form>
</div>
</div>
<?php include 'footer.php' ?>