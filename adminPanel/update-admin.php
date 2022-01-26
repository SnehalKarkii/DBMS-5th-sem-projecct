<?php include 'nav.php' ?>

<?php

// fetching selected row id from admin table 
$id = $_GET['id'];

$sql = "select * from admin where id = $id";
$res = mysqli_query($conn, $sql);

if ($res) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $fullName = $row['fullName'];
        $userName = $row['userName'];
    }
}


?>

<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Update Admin </strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post">

            <div class="data-input normal-word-space">
                <label for="fname">Full Name</label>
                <input type="text" id="fname" name="fullname" value="<?php echo $fullName; ?>" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="uname">Username</label>
                <input type="text" id="uname" name="username" value="<?php echo $userName; ?>" required>
            </div>



            <div class="text-center submit">
                <button class="link-btn btn-add-color" name="submit">Update Admin</button>
            </div>

        </form>
    </div>
</div>


<?php
if (isset($_POST['submit'])) {

    $id = $_GET['id'];
    $fullName = $_POST['fullname'];
    $userName = $_POST['username'];

    $sql = "update admin set fullName = '$fullName' ,userName = '$userName' where id = $id";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['update'] = "<div class='display-message success-message'>Successfully Data updated</div>";
        header("location:" . INDEXPAGE . "adminPanel/manage-admin.php");
    } else {
        $_SESSION['delete'] = "<div class='display-message error-message'>Failed to Update data.Try again later</div>";
        header("location:" . INDEXPAGE . "adminPanel/manage-admin.php");
    }
}
?>
<?php include 'footer.php' ?>