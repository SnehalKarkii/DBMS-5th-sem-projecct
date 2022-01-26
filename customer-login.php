<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="utf-8">
  <title>Customer Login</title>
  <link rel="stylesheet" href="css/form.css">
</head>
<body>
  <?php 
include "adminPanel/config/connect.php";
if(isset($_SESSION['user-alert'])){
  echo $_SESSION['user-alert'];
  unset($_SESSION['user-alert']);
}
?>
  <div class="center">
    <div class="container">
      <div class="text">
        Login Form
      </div>
      <form action="#" method="post">
        <div class="data">
          <label>Username</label>
          <input type="text" name="username" required>
        </div>
        <div class="data">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>
        <div class="forgot-pass">
          <a href="#">Forgot Password?</a>
        </div>
        <div class="btn">
          <div class="inner"></div>
          <button type="submit" name="submit">login</button>
        </div>
        <div class="signup-link">
        Not a member? 
        <a href="http://localhost/dbms/customer-signup.php">Signup now</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>


<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from customer_signup where username = '$username' and password = '$password'";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $_SESSION['login'] = "<script>alert('Login Successfull');</script>";
            //Authentication or control access 
            $_SESSION['user-access'] = $username;
            echo "<script>window.location.href = 'http://localhost/dbms/index.php';</script>";
        } else {
          echo "<script>alert('Invalid Username/Password');</script>";
            
        }
    }
}






?>