<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Customer Signup</title>
  <link rel="stylesheet" href="css/form.css">
</head>

<body>
  <div class="center">
    <div class="container">
      <div class="text">
        Signup Form
      </div>
      <form action="#" method="post">
        <div class="data">
          <label>Email</label>
          <input type="text" name="email" required>
        </div>
        <div class="data">
          <label>Username</label>
          <input type="text" name="username" required>
        </div>
        <div class="data">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>
        <div class="btn">
          <div class="inner"></div>
          <button type="submit" name="submit">Sign up</button>
        </div>
        <div class="signup-link">
        Already member? 
        <a href="http://localhost/dbms/customer-login.php">Login</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>

<?php
include "adminPanel/config/connect.php";

if (isset($_POST['submit'])){
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "insert into customer_signup set email = '$email',username = '$username',password = '$password'";
  $res = mysqli_query($conn, $sql);

  if ($res) {
    $_SESSION['user-alert'] =  "<script>alert('User Created Successfully');</script>";
    echo "<script>window.location.href = 'http://localhost/dbms/customer-login.php';</script>";
  } else {
    echo "<script>alert('User Not Created');</script>";
  }
}

?>