<?php include 'nav.php' ?>

<div class="main-content">
    <div class="wrapper">

        <div class="admin-header">
            <h2> <strong class="title-letter-space text-uppercase">Category</strong></h2>
            <a href="add-category.php" class="normal-word-space btn-add-color">ADD</a>
        </div>

        <?php
        if (isset($_SESSION['add-category'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['add-category'];
            // removing the message after reload
            unset($_SESSION['add-category']);
        }

        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <script>
            setTimeout(function() {
                document.getElementsByClassName('display-message')[0].style.display = "none";
            }, 3000);
        </script>


        <table class="full-width text-center normal-word-space">

            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php

                // Query for getting all the table value
                $sql = "select * from category";
                $res = mysqli_query($conn, $sql);

                if ($res) {

                    //Checking whether there is any rows or not 
                    $num = mysqli_num_rows($res);

                    //If the user delete previous row then the count will be in order 
                    $id_new = 1;

                    // if there is any rows then num will more then 0
                    if ($num > 0) {

                        // Fetching all the data from database and add it to admin table
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $image = $rows['image_name'];
                            $title = $rows['title'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                ?>



                            <tr>
                                <td><?php echo $id_new++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                    //Chcek whether image name is available or not
                                    if ($image != "") {
                                        //Display the Image
                                    ?>
                                        <img src="<?php echo INDEXPAGE; ?>images/category/<?php echo $image; ?>" width="100px">


                                    <?php
                                    } else {
                                        //DIsplay the MEssage
                                        echo "image not added";
                                    }
                                    ?>

                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo INDEXPAGE ?>adminPanel/update-category.php?id=<?php echo $id; ?>" class="link-btn btn-primary-color">Update</a>
                                    <a href="<?php echo INDEXPAGE ?>adminPanel/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="link-btn btn-danger-color">Delete</a>
                                </td>
                             

                            </tr>

                <?php
                        }
                    }
                }


                ?>




            </tbody>
        </table>


    </div>
</div>

<?php include 'footer.php'  ?>