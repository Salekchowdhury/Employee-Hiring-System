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
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Hire Wedding Planner System
  </title>
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-student.css">
    <link rel="stylesheet" href="../../contents/css/custom-style.css">
    <link rel="stylesheet" href="../../contents/css/slick.css">
    <link rel="stylesheet" href="../../contents/css/slick-theme.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../contents/plugins/bootstrap/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">


<div class="login-box" style="padding-top: 70px">
    <?php
    if(isset($_SESSION['SendMessage'])) {
        echo($_SESSION['SendMessage']);
        unset($_SESSION['SendMessage']);
    }
    ?>
  <div class="login-logo">

  </div>

  <div class="card" style="border-radius: 30px;margin-bottom: 240px;">

    <div class="card-body login-card-body" style="border-radius: 30px;border: 2px solid;">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="../../views/process/email.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" required class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="forgotPassword" class="btn btn-primary btn-block">Request new password</button>
          </div>

        </div>
          <br/>
          <div class="row">
              <div class="col-sm-6 btn-group">
                  <a class="btn btn-secondary  btn-group" href="login.php" >Login</a>
              </div>

          </div>
      </form>

    </div>

  </div>
</div>


<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="../../contents/plugins/slick-1.8.1/slick-1.8.1/slick/slick.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

</body>
</html>
