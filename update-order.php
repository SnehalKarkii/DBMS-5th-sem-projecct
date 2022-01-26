<?php
include "include/nav.php";

if(!$_SESSION['user-access']){
    header("location:http://localhost/dbms/index2.php");
    
}
?>


<?php

if (isset($_GET['id'])) {
    $food_id = $_GET['id'];
    $sql = "select * from `order` where id=$food_id";
    $res = mysqli_query($conn, $sql);
    if($res){
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['food'];
            $price = $row['price'];
            $name = $row['customer_name'];
            $image_name = $row['image_name'];
            $email = $row['customer_email'];
            $qty = $row['qty'];
            $phone = $row['customer_contact'];
            $address = $row['customer_address'];
        }
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
                    <input type="number" name="qty" value ="<?php echo $qty; ?>"required>

                </div>

                <div class="deleivery-details">
                    <h4 class="title-letter-space text-center">Deleivery Details</h4>

                    <div class="data-input">
                        <label>Full Name</label>
                        <input type="text" name="full-name" placeholder="Enter the name"  value ="<?php echo $name; ?>" required>
                    </div>

                    <div class="data-input">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter the email" value ="<?php echo $email; ?>" required>
                    </div>

                    <div class="data-input">
                        <label>Phone</label>
                        <input type="tel" name="contact" placeholder="Enter the phone" value ="<?php echo $phone; ?>" required>
                    </div>

                    <div class="data-input">
                        <label>Address</label>
                        <textarea name="address" id="" cols="30" rows="10" placeholder="Message" required><?php echo $address; ?></textarea>
                    </div>

                    <div class="submit text-center ">
                        <button name="submit">Update</button>
                    </div>

                </div>

            </form>

            <?php
            if (isset($_POST['submit'])) {
                $id = $_GET['id'];
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
                $sql2 = "update `order` set 
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
                        image_name = '$image_name' where id = $id
                    ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {
                    $_SESSION['update'] = "<script>alert('Update Successfully')</script>";
                    // header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
                    echo "<script>window.location.href='http://localhost/dbms/order-details.php'</script>";
                } else {
        
                    $_SESSION['update'] = "<script>alert('Failed to update')</script>";
                    // header('location:' . INDEXPAGE . 'adminPanel/manage-food.php');
                    echo "<script>window.location.href='http://localhost/dbms/order-details.php'</script>";
                
            }
        }

            ?>
        </div>
    </div>

</div>

</body>

</html>