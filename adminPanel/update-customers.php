<?php include 'nav.php' ?>

<?php

// fetching selected row id from admin table 
$id = $_GET['id'];

$sql = "select * from customer_signup where id = $id";
$res = mysqli_query($conn, $sql);

if ($res) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $email = $row['email'];
        $userName = $row['username'];
    }
}


?>

<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Update Customer </strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post">

            <div class="data-input normal-word-space">
                <label for="fname">Email</label>
                <input type="email" id="fname" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="uname">Username</label>
                <input type="text" id="uname" name="username" value="<?php echo $userName; ?>" required>
            </div>



            <div class="text-center submit">
                <button class="link-btn btn-add-color" name="submit">Update Customers</button>
            </div>

        </form>
    </div>
</div>


<?php
if (isset($_POST['submit'])) {

    $id = $_GET['id'];
    $email = $_POST['email'];
    $userName = $_POST['username'];

    $sql = "update customer_signup set email = '$email' ,userName = '$userName' where id = $id";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['update'] = "<div class='display-message success-message'>Successfully Data updated</div>";
        header("location:" . INDEXPAGE . "adminPanel/manage-customers.php");
    } else {
        $_SESSION['delete'] = "<div class='display-message error-message'>Failed to Update data.Try again later</div>";
        header("location:" . INDEXPAGE . "adminPanel/manage-customers.php");
    }
}
?>
<?php include 'footer.php' ?>