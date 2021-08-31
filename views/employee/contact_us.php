<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$datamanipulation = new DataManipulation();
use App\Utility\Utility;

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-student.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <?php
            $data = $datamanipulation->CheckVarifyAccount($email);
            if(!$data){
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <strong style="font-size: 24px;padding-left: 10px;padding-right: 430px;">Employee Hire System</strong>
                    <p style="color: red">Account Not Verified</p>
                </li>
                <?php
            }else{
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <strong style="font-size: 24px;padding-left: 10px;">Employee Hiring System</strong>
                </li>
                <?php
            }
            ?>


        </ul>


    </nav>

    <aside style="background-color: rgba(116,12,41,0.6)" class="student-bg main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">

            <span class="brand-text font-weight-light"><b>Employee Hiring System</b></span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <?php
                $userData = $datamanipulation->showUserProfile($user_id);
                $image = $datamanipulation->Image($user_id);

                if($image){
                    ?>
                    <img src="<?php echo $image->image ?>" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }
                else{
                    ?>
                    <img src="../../contents/img/nature.jpg" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }

                ?>
                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $userData->name?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="home.php" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <?php

                    $data = $datamanipulation->CheckVarifyAccount($email);
                    if($data){
                        ?>

                        <li class="nav-item has-treeview">
                            <a href="manage_post.php" class="nav-link ">
                                <i class="nav-icon fas fa-microphone-alt"></i>
                                <p>
                                    Manage Post
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="message.php" class="nav-link ">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    Message
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="confirm_history.php" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>
                                    Confirm History
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="contact_us.php" class="nav-link active">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>Contact Us</p>
                            </a>
                        </li>


                        <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a href="../../views/process/user_process.php?logout=1" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <?php
            if(isset($_SESSION['SendMessage'])){
                echo $_SESSION['SendMessage'];
                unset($_SESSION['SendMessage']);
            }
            ?>
            <div class="row">

                <div class="col-sm-6">

                    <form  role="form "  action="../process/email.php" method="post">
                        <div class="card-body">

                            <fieldset>

                                <div class="form-group ">
                                    <label class="form-control-label">Name:</label>
                                    <input type="text" name="name" required disabled class="form-control"  value="<?php echo $name?>">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label">Gmail:</label>
                                    <input type="email" required  name="email" disabled class="form-control"  value="<?php echo $email?>">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label">Subject:</label>
                                    <input type="text" name="subject" required class="form-control"  value="">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label">Message </label>
                                    <textarea class="form-control" required name="message" rows="7" cols="15" placeholder="Type Your Message...."></textarea>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" required  name="message_send_by_employee" value="Send Message">
                                    </div>
                                </div>
                            </fieldset>
                        </div>




                        <!--<div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>-->
                    </form>
                </div>
                <div class="col-sm-6">

                    <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Chawk%20Bazar,
                    %20Chattogram&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                </div>
            </div>




        </section>



        <footer>

        </footer>
    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
</body>
</html>



