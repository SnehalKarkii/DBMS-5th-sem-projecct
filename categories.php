<?php include "include/nav.php"; ?>
<section class="categories" id="section">
    <div class="wrapper">
        <h2 class=" title-letter-space text-center">Food Categories</h2>
        <div class="box-container text-center">

            <?php
            $sql = "select * from category where active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $imagename = $row['image_name'];
            ?>

                    <a href="<?php echo INDEXPAGE; ?>category-foods.php?category_id=<?php echo $id; ?>">

                        <div class="box">

                            <?php
                            if ($imagename == " ") {

                                echo "Image not available";
                            } else

                            ?>
                            <div class="img">
                                <img src="<?php echo INDEXPAGE; ?>images/category/<?php echo $imagename; ?>" alt="">
                            </div>

                            <p><?php echo $title; ?></p>


                        </div>
                    </a>
                <?php   } ?>
            <?php
            }else if($count == 0){
                echo "<div class='break'><h1>Coming Soon</h1>
                    
                <div class='btn-home text-center'>
                    <a href='http://localhost/dbms/index.php'>Go to Home</a>
                    </div></div>";
            }

            ?>