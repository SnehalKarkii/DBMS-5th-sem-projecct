<?php include 'nav.php' ?>

<div class="main-content">
    <div class="wrapper">

        <div class="admin-header">
            <h2> <strong class="title-letter-space text-uppercase">Food</strong></h2>
            <a href="add-food.php" class="normal-word-space btn-add-color">ADD</a>
        </div>

        <?php
        if (isset($_SESSION['update'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['update'];
            // removing the message after reload
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['remove-failed'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['remove-failed'];
            // removing the message after reload
            unset($_SESSION['remove-failed']);
        }
        
        if (isset($_SESSION['add-food'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['add-food'];
            // removing the message after reload
            unset($_SESSION['add-food']);
        }


        if (isset($_SESSION['upload'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['upload'];
            // removing the message after reload
            unset($_SESSION['upload']);
        }

        
        if (isset($_SESSION['not-food'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['not-food'];
            // removing the message after reload
            unset($_SESSION['not-food']);
        }

        
        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
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
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>
                <?php

                $sql = "select * from food";
                $res = mysqli_query($conn, $sql);

                //Count Rows to check whether we have foods or not
                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    //Get the Foods from Database and Display
                    while ($row = mysqli_fetch_assoc($res)) {

                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $imagename = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>
                            <td>$<?php echo $price; ?></td>
                            <td>
                                <?php
                                //CHeck whether we have image or not
                                if ($imagename == "") {
                                    //WE do not have image, DIslpay Error Message
                                    echo "Image not Added";
                                } else {
                                    //WE Have Image, Display Image
                                ?>
                                    <img src="<?php echo INDEXPAGE; ?>images/food/<?php echo $imagename; ?>" width="100px">
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo INDEXPAGE ?>adminPanel/update-food.php?id=<?php echo $id; ?>" class="link-btn btn-primary-color">Update</a>
                                <a href="<?php echo INDEXPAGE ?>adminPanel/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $imagename; ?>" class="link-btn btn-danger-color">Delete</a>
                            </td>
                        </tr>

                <?php
                    }
                }

                ?>
            </tbody>
        </table>


    </div>
</div>

<?php include 'footer.php'  ?>