<?php
 require "dbBroker.php";
 require "user.php";

 session_start();

 if(isset($_GET['username']) && isset($_GET['password'])) {
     $username=$_GET['username'];
     $password=$_GET['password'];

    $rs = User::logInUser($username, $password, $connection);


      if($rs->num_rows==1) {
          echo "You have successfully logged in!";
          $_SESSION['user_id'] = $rs->fetch_assoc()['id'];
          header('Location: home.php');
          exit();
      }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>Pretplata</title>

  </head>
  <body>
  <div class="container">
  <form method="GET" action="#"> 
    <div class="left">
      <div class="header">
        <h2 class="animation a1">Welcome Back</h2>
        <h4 class="animation a2">Log in to your account using username and password</h4>
      </div>
      <div class="form">
      <input type="text" placeholder="username" name="username" class="form-field animation a3"  required>
        <input type="password" placeholder="password" name="password" class="form-field animation a4" required>
        <button type="submit" class="login-button" name="submit">Log in</button> 
      </div>
    <div class="right"></div>
    </form>
  </div>
  <body>
  </html>
