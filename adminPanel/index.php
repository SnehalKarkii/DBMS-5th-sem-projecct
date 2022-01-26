<?php include 'nav.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Dashboard</strong></h2>

        <?php

        if (isset($_SESSION['login'])) {

            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <script>
            setTimeout(function() {
                document.getElementsByClassName('display-message')[0].style.display = "none";
            }, 3000);
        </script>


        <div class="content-box text-center">
            <div class="col-4">
                <?php
                $sql = "select * from category";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $count = mysqli_num_rows($res);
                } else {
                    $count = 0;
                }
                ?>
                <h1><?php echo $count; ?></h1>
                <br>
                <h3>Categoires<h3>
            </div>

            <div class="col-4">
                <?php
                $sql = "select * from food";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $count = mysqli_num_rows($res);
                } else {
                    $count = 0;
                }
                ?>
                <h1><?php echo $count; ?></h1>
                <br>
                <h3>Food<h3>
            </div>

            <div class="col-4">
                <?php
                $sql = "select * from `order`";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $count = mysqli_num_rows($res);
                } else {
                    $count = 0;
                }
                ?>
                <h1><?php echo $count; ?></h1>
                <br>
                <h3>Total Orders<h3>
            </div>

            <div class="col-4">
            
            <?php
                $sql= "select sum(total) as total from `order` where status='Delivered'";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $row = mysqli_fetch_assoc($res);
                    $total = $row['total'];
                } else {
                    $total = 0;
                }
                ?>
                <h1>$<?php echo $total; ?></h1>
                <br>
                <h3>Total Earning<h3>
            </div>

        </div>

    </div>
</div>

<?php include 'footer.php'  ?>