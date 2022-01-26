<?php include "include/nav.php" ?>


<?php
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    $sql = "select * from food where id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //Food not Availabe
        header('location:' . INDEXPAGE);
    }
} else {
    //Redirect to homepage
    header('location:' . INDEXPAGE);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<div class="details-container">
    <div class="item">
        <div class="info">
            <form action="" method="POST">
                <h2 class="title-letter-space text-center">Selected Food</h2>

                <div class="img">
                    <?php
                    if ($image_name == "") {
                        //Image not Availabe
                        echo "<p>Image not Available.</p>";
                    } else {
                        //Image is Available
                    ?>
                        <img src="<?php echo INDEXPAGE; ?>images/food/<?php echo $image_name; ?>" alt="" required>

                    <?php
                    }

                    ?>

                </div>


                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <input type="hidden" name="food" value="<?php echo $title; ?>" required>

                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>" required>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" required>

                </div>

                <div class="deleivery-details">
                    <h4 class="title-letter-space text-center">Deleivery Details</h4>

                    <div class="data-input">
                        <label>Full Name</label>
                        <input type="text" name="full-name" placeholder="Enter the name" required>
                    </div>

                    <div class="data-input">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter the email" required>
                    </div>

                    <div class="data-input">
                        <label>Phone</label>
                        <input type="tel" name="contact" placeholder="Enter the phone" required>
                    </div>

                    <div class="data-input">
                        <label>Address</label>
                        <textarea name="address" id="" cols="30" rows="10" placeholder="Message" required></textarea>
                    </div>

                    <div class="submit text-center ">
                        <button name="submit">Submit</button>
                    </div>

                </div>

            </form>

            <?php
            if (isset($_POST['submit'])) {
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // total = price x qty 

                $order_date = date("Y-m-d h:i:sa"); //Order DAte

                $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];



                //Save the Order in Databaase
                //Create SQL to save the data
                $sql2 = "insert into `order` set 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address', 
                        image_name = '$image_name'
                    ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {
                    //Query Executed and Order Saved
                    header('location:' . INDEXPAGE);
                } else {
                    //Failed to Save Order
                    header('location:' . INDEXPAGE);
                }
            }

            ?>
        </div>
    </div>

</div>

</body>

</html>