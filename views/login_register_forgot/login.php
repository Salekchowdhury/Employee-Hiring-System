<?php
/*include_once ("../../includes/head_auth.php");*/
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
use App\Utility\Utility;
?>

<!DOCTYPE html>
<head>
  <title>Hire Wedding Planner System</title>
  <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../../contents/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
  <link rel="stylesheet" href="../../contents/css/login_form_style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

  </div>

      <?php

      if(isset($_SESSION['errorMessageForLogin'])){

          echo $_SESSION['errorMessageForLogin'];
          unset($_SESSION['errorMessageForLogin']);

      }
      ?>

    <form action="../../views/process/data_process.php" method="post">

          <div class="login_form">
              <div class="logo"></div>
              <div class="title">
                  Hire Wedding Planner System

              </div>
              <div class="sub_title">
                  Login Form
              </div>
              <div class="fields">
                  <div class="username"><input name="email" type="text" required class="email_input" placeholder="Email"></div>
                  <div class="password"><input type="password"  name="password" required class="pass_input" placeholder="Password"></div>
                  <button type="submit" name="signIn" class="btn_signUp">Sing In</button>
              </div>
              <div class="link">
                  <a style="color: black" href="forgot-password.php"> Forgot Passwor</a>
              </div>

          </div>
      </form>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/js/adminlte.min.js"></script>

</body>
</html>
