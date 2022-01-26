<?php
include "include/nav.php";
if(!$_SESSION['user-access']){
    header("location:http://localhost/dbms/index2.php");
    
}

if($_SESSION['update']){
    echo $_SESSION['update'];
    unset($_SESSION['update']);  
}


?>


<section class="food-card" id="food-card" style="margin-top: 80px;">
    <div class="wrapper">

        <h2 class=" title-letter-space text-center">Order Details</h2>
        <div class="item-container">
            <?php
            //Getting Foods from Database that are active and featured
            $sql2 = "select * from `order`";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $Qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $image_name = $row['image_name'];
                    $title = $row['food'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
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
                                    <p>QTY : <?php echo $Qty;?> &nbsp;  Price : <?php echo "$" .$total; ?></p>
                                    
                                    <p>Price : <?php echo $order_date; ?></p>
                                    
                                </p>
                                <br>

                                <a href="<?php echo INDEXPAGE; ?>update-order.php?id=<?php echo $id; ?>" class="btn btn-primary">update</a>
                            </div>
                    </div>
        <?php
                        }
                    }
                } ?>
        </div>
</section>