<?php include('include/nav.php'); ?>

<?php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "select title from category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('location:' . INDEXPAGE);
}
?>



<section class="food-card" id="section">
    <div class="wrapper">
        <h2 class=" title-letter-space text-center">Dishes</h2>
        <div class="item-container">

            <?php

            $sql2 = "select * from food where category_id=$category_id";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);


            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
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
                }else if($count2 == 0){
                    echo "<div class='break'><h1>Food Not Available</h1>
                    
                    <div class='btn-home text-center'>
                        <a href='http://localhost/dbms/index.php'>Go to Home</a>
                        </div></div>";
                }
                
                 ?>
        </div>