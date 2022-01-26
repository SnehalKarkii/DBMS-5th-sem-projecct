<?php
include "include/nav.php";
if (!$_SESSION['user-access']) {
    header("location:http://localhost/dbms/index2.php");
}
?>

<section class="food-card" id="section">
    <div class="wrapper">
        <h2 class=" title-letter-space text-center">Special Deals</h2>
        <div class="item-container">
            <?php
            //Getting Foods from Database that are active and featured
            $sql2 = "select * from food where active='Yes'";
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

                                <a href="<?php echo INDEXPAGE; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                    </div>
        <?php
                        }
                    }
                } ?>
        </div>