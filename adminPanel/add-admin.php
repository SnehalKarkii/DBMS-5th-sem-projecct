<?php include 'nav.php' ?>
<?php

// Checking whether button is clicked or not
if (isset($_POST['submit'])) {

    //Taking values from form and storing in the variable
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Query for adding new Admin   
    $sql = "insert into admin set fullName = '$fullname',
   userName = '$username',
   password = '$password'
   ";

    // Executing Query and save it into data Base
    $res = mysqli_query($conn, $sql) or die("Query error");


    //Checking whether database is successfully added or not  
    if ($res) {

        // sesseion variable to display the message
        $_SESSION['add'] = "<div class='display-message success-message'>Successfully added Admin</div>";

        // Redirecting page to admin
        header("location:" . INDEXPAGE . 'adminPanel/manage-admin.php');
    } else {
        $_SESSION['add'] = "<div class='display-message error-message'>Failed to Add Admin.Try again later</div>";
        header("location:" . INDEXPAGE . 'add-admin.php');
    }
}

?>

<div class="main-content">
    <div class="wrapper">
        <h2> <strong class="title-letter-space text-uppercase">Add Admin </strong></h2>
    </div>

    <div class="form">
        <form action="#" method="post">

            <div class="data-input normal-word-space">
                <label for="fname">Full Name</label>
                <input type="text" id="fname" name="fullname" placeholder="Enter your Name" required>
            </div>

            <div class="data-input normal-word-space">
                <label for="uname">Username</label>
                <input type="text" id="uname" name="username" placeholder="Enter your Username" required>
            </div>


            <div class="data-input normal-word-space">
                <label for="pass">Passsword</label>
                <input type="password" id="pass" name="password" placeholder="Enter your password" required>
            </div>

            <div class="text-center submit">
                <button class="link-btn btn-add-color" name="submit">Add Admin</button>
            </div>

        </form>
    </div>
</div>
<?php include 'footer.php' ?>