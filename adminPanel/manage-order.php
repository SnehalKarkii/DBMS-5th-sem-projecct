<?php include 'nav.php' ?>

<style>
    table th {
        padding: 10px 2px;
    }

    table td {
        padding: 10px 2px;
    }

    table tbody {
        background-color: var(--secondary-color);
    }

    table thead tr {
        background-color: var(--primary-color);
        color: white;
    }

    table tr a {
        text-decoration: none;
        color: black;
        padding: 5px 15px;
        border: 1px solid #333;
    }
</style>

<div class="main-content">
    <div class="wrapper order">

        <div class="admin-header">
            <h2> <strong class="title-letter-space text-uppercase">Order</strong></h2>
        </div>

        <?php
        if (isset($_SESSION['update'])) {
            // Display the message whether admin is added or not
            echo $_SESSION['update'];
            // removing the message after reload
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
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order_Date</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>
                <?php

                $sql = "select * from `order` order by id desc";
                $res = mysqli_query($conn, $sql);

                if ($res) {


                    //Count Rows to check whether we have foods or not
                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if ($count > 0) {
                        //Get the Foods from Database and Display
                        while ($row = mysqli_fetch_assoc($res)) {

                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $Qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_address = $row['customer_address'];
                ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $Qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td>
                                    <?php
                                    // Ordered, On Delivery, Delivered, Cancelled
                                    if ($status == "Ordered") {
                                        echo "<label>$status</label>";
                                    } elseif ($status == "On Delivery") {
                                        echo "<label style='color: orange;'>$status</label>";
                                    } elseif ($status == "Delivered") {
                                        echo "<label style='color: green;'>$status</label>";
                                    } elseif ($status == "Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>

                                    <a href="<?php echo INDEXPAGE ?>adminPanel/update-orders.php?id=<?php echo $id; ?>" class="link-btn btn-primary-color">Update</a>
                                    <a href="<?php echo INDEXPAGE ?>adminPanel/delete-order.php?id=<?php echo $id; ?>" class="link-btn btn-danger-color">Delete</a>
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