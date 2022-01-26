 <?php include('include/nav.php'); ?>

<section class="food-card" id="section">
    <div class="wrapper">
    <h2 class=" title-letter-space text-center">Dishes</h2>
        <?php

        //Get the Search Keyword
        $search = mysqli_real_escape_string($conn, $_POST['search']);

        ?>
        <h2>Foods on Your Search :<?php echo $search; ?></h2>

        <div class="item-container">

            <?php

            $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether food available of not
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
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
                    }}
                else{
                    echo "<div class='break'><h1>Nothing found like `$search`</h1>
                    
                <div class='btn-home text-center'>
                    <a href='http://localhost/dbms/index.php'>Go to Home</a>
                    </div></div>";
                } 
                    ?>


</div>