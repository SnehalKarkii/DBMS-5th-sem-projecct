<?php include 'nav.php' ?>

<div class="main-content">

    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Change Password </strong></h2>

    </div>

    <div class="form">
        <form action="#" method="post">

            <div class="data-input normal-word-space">
                <label for="current">Current Password</label>
                <input type="password" id="current" name="currentPassword" placeholder="Enter current Password" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="new">New Password</label>
                <input type="password" id="new" name="newPassword" placeholder="Enter new password" required>
            </div>


            <div class="data-input normal-word-space">
                <label for="confirm">Confirm Password</label>
                <input type="password" id="confirm" name="confirmPassword" placeholder="Confirm your password" required>
            </div>

            <div class="text-center submit">
                <button class="link-btn btn-add-color" name="submit">Change Password</button>
            </div>

        </form>
    </div>
</div>


<?php include 'footer.php' ?>

<?php

if (isset($_POST['submit'])) {

    $id = $_GET['id'];
    $currentPassword = md5($_POST['currentPassword']);
    $newPassword = md5($_POST['newPassword']);
    $confirmPassword = md5($_POST['confirmPassword']);


    $sql = "select * from admin where id = $id and password = '$currentPassword'";

    $res = mysqli_query($conn, $sql);

    if ($res) {

        $count = mysqli_num_rows($res);
        if ($count == 1) {

            if ($newPassword == $confirmPassword) {

                $sql2 = "update admin set password = '$newPassword' where id = $id";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {

                    $_SESSION['password-changed'] = "<div class='display-message success-message'>Password Changed</div>";
                    header("location:" . INDEXPAGE . "adminPanel/manage-admin.php");
                } else {
                    $_SESSION['password-changed'] = "<div class='display-message error-message'>Failed to change the password</div>";
                    header("location:" . INDEXPAGE . "adminPanel/manage-admin.php");
                }
            } else {

                $_SESSION['pass-not-match'] = "<div class='display-message error-message'>Password didn't Match</div>";
                header("location:" . INDEXPAGE . "adminPanel/manage-admin.php");
            }
        } else {

            $_SESSION['user-not-found'] = "<div class='display-message error-message'>User Not Found. </div>";
            header("location:" . INDEXPAGE . "adminPanel/manage-admin.php");
        }
    }
}

?>