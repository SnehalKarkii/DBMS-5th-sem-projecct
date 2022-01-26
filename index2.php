<?php
include "include/nav2.php";
?>

<!-- Categories -->
<div class="search-container">

    <div class="search">
        <form action="http://localhost/dbms/customer-login.php" method="post">
            <h2 class="title-letter-space text-center">Order food from the widest range of restaurants.</h2>
            <input type="text" name="search" placeholder="Search for Food.." required>
            <button>SEARCH</button>
        </form>
    </div>
</div>
</div>

<section class="categories" id="categories">
    <div class="wrapper">
        <h2 class="text-center title-letter-space">Categories</h2>

        <div class="box-container text-center">

            <?php
            $sql = "select * from category where active='Yes' AND featured='Yes' LIMIT 4";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $imagename = $row['image_name'];
            ?>

                    <a href="http://localhost/dbms/customer-login.php">

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
            }

            ?>

            <!-- <div class="box-container text-center">
            <div class="box">
                <div class="img">
                    <img src="images/item1.jpg" alt="">
                </div>
                <p>Biryani</p>
            </div> -->

            <!-- <div class="box">
                <div class="img">
                    <img src="images/item1.jpg" alt="">
                </div>
                <p>Pizza</p>
            </div>

            <div class="box">
                <div class="img">
                    <img src="images/item1.jpg" alt="">
                </div>
                <p>Cupcake</p>
            </div>

            <div class="box">
                <div class="img">
                    <img src="images/item1.jpg" alt="">
                </div>
                <p>Panner</p>
            </div>
        </div>
    </div> -->

</section>

<!-- Food-card -->

<section class="food-card" id="food-card">
    <div class="wrapper">
        <h2 class=" title-letter-space text-center">Food section</h2>



        <div class="item-container">
            <?php
            //Getting Foods from Database that are active and featured
            $sql2 = "select * from food where active='Yes' and featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>
                    <div class="item">
                        <?php
                        if ($image_name == "") {
                            echo "Image not available";
                        } else {
                        ?>
                            <img src="<?php echo INDEXPAGE; ?>images/food/<?php echo $image_name; ?>">


                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="http://localhost/dbms/customer-login.php" class="btn btn-primary">Order Now</a>
                            </div>
                    </div>
        <?php
                        }
                    }
                } ?>
        </div>

        <!-- 
        <div class="item-container">
            <div class="item">
                <img src="images/item2.jpg" alt="">
                <div class="food-menu-desc">
                    <h4>Momo</h4>
                    <p class="food-price">$55</p>
                    <p class="food-detail"> Ramro food</p>
                    <br>
                    <a href="" class="">Order Now</a>
                </div>
            </div> -->


        <!--   <div class="item">
                <img src="images/item2.jpg" alt="">
                <div class="food-menu-desc">
                    <h4>Momo</h4>
                    <p class="food-price">$55</p>
                    <p class="food-detail"> Ramro food</p>
                    <br>
                    <a href="" class="">Order Now</a>
                </div>
            </div>


            <div class="item">
                <img src="images/item2.jpg" alt="">
                <div class="food-menu-desc">
                    <h4>Momo</h4>
                    <p class="food-price">$55</p>
                    <p class="food-detail"> Ramro food</p>
                    <br>
                    <a href="" class="">Order Now</a>
                </div>
            </div>


            <div class="item">
                <img src="images/item2.jpg" alt="">
                <div class="food-menu-desc">
                    <h4>Momo</h4>
                    <p class="food-price">$55</p>
                    <p class="food-detail"> Ramro food</p>
                    <br>
                    <a href="" class="">Order Now</a>
                </div>
            </div>


            <div class="item">
                <img src="images/item2.jpg" alt="">
                <div class="food-menu-desc">
                    <h4>Momo</h4>
                    <p class="food-price">$55</p>
                    <p class="food-detail"> Ramro food</p>
                    <br>
                    <a href="" class="">Order Now</a>
                </div>
            </div>


            <div class="item">
                <img src="images/item2.jpg" alt="">
                <div class="food-menu-desc">
                    <h4>Momo</h4>
                    <p class="food-price">$55</p>
                    <p class="food-detail"> Ramro food</p>
                    <br>
                    <a href="" class="">Order Now</a>
                </div>
            </div>

        </div>
 -->


</section>

<?php
include "include/footer.php";
?>