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
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Hiring System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link href="../../contents/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link href="../../contents/plugins/jquery.fancybox.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../contents/css/libs/animate.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <strong style="font-size: 24px;padding-left: 10px;padding-right: 730px;">Employee Hiring System</strong>
      </li>
    </ul>
  </nav>

    <aside class="main-sidebar sidebar-dark-blue elevation-4" style="background-color: rgba(14,79,18,0.86); position: fixed">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light"><b>Employee Hiring System</b></span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <?php
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
                    <a href="profile.php" class="d-block"><?php echo $name?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manage_post.php" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Manage Post</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="all_employee.php" class="nav-link ">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Employee
                                <!--<span class="right badge badge-success">New</span>-->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="user.php" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pending_approval.php" class="nav-link">
                            <i class="nav-icon far fa-address-card"></i>
                            <p>
                                Pending Approval
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="booking_history.php" class="nav-link">
                            <i class="nav-icon fas fa-file-medical"></i>
                            <p>
                                Booking History
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="add_employee.php" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Add Employee
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="add_admin.php" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Add Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="trash.php" class="nav-link">
                            <i class="nav-icon fas fa-trash"></i>
                            <p>
                                Trash History
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../views/process/admin_process.php?logout=1" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Logout</p>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </aside>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Employee</h1>
                    </div>

                </div>
            </div>
        </section>
        <?php

        if(isset($_SESSION['updatetMsg'])){
            echo $_SESSION['updatetMsg'];
            unset($_SESSION['updatetMsg']);
        }
        ?>
        <div class="content" >
            <div style="padding-left: 40px" class="row">
                <div  class="col-md-11  wow slideInLeft" data-wow-duration= "1s">
                    <div class="card card-plain">


                        <div style="border-radius: 8px; border: 2px solid;     border-color: #a71d2a; box-shadow: 5px 10px 10px 2px black" class="tab-pane ">
                            <form class="form-horizontal" action="../process/admin_process.php" method="post" enctype="multipart/form-data">
                                <input class="user_id" name="user_id" type="hidden" value="<?php echo $user_id?>" >

                                <div style="padding: 10px" class="form-group row">
                                    <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong >Name:</strong></label>
                                        <div class="col-sm-10">
                                            <input  required class="form-control" name="name" value="">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Profession:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="profession" value="">
                                        </div>
                                    </div>
                                     <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Building Name:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="building_name" value="">
                                        </div>
                                    </div>
                                     <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Owner Name:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="owner_name" value="">
                                        </div>
                                    </div>
                                      <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Holding No:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="holding_no" value="">
                                        </div>
                                    </div>

                                     <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Road No:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="road_no" value="">
                                        </div>
                                    </div>
                                      <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Bio:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="bio" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Address:</strong></label>
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="address" value="">
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <label  class="col-sm-4 col-form-label"><strong  >Phone:</strong></label>
                                        <div class="col-sm-10">
                                            <input required class="form-control" name="phone" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label  class="col-sm-4 col-form-label pading_right"><strong>Work Details:</strong></label>
                                        <div class="col-sm-10">
                                            <input  required class="form-control" name="work" value="">
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <br>
                                        <label  class="col-sm-2 col-form-label"><strong>Image:</strong></label>
                                        <input required type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">

                                    </div>


                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group wow slideInDown" data-wow-duration= "1.5s" style="font-size: 21px; background-color: #28a745 ; text-align: center;border: 3px solid;border-radius: 25px; border-color: #3e19a7">
                                        <!-- <a href="change_profile.php?change_profile=<?php /*echo $email*/?>">Change Profile</a>-->
                                       <!-- <a href="#">Add Member</a>-->
                                        <button style="border: none; outline: none; color: white ;background-color: #28a745" type="submit"  name="add_employee" >Add Member</button>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
               <!-- <div style="height: 400px; border: 3px solid; padding-top: 15px;  border-radius: 20px; border-color: #28a745; box-shadow: 5px 10px 5px 1px #0c2646;color: rgba(83,220,255,0)" class="col-3 wow slideInLeft" >
                    <h5 style="color: black; padding-top: 5px; font-weight: 600">Total Member:-  <b style="color: #1e7e34; font-size: 20px"> 136</b></h5>
                    <hr>
                    <h5 style="color: black;font-weight: 600">Normal Condition:-  <b style="color: #1e7e34; font-size: 20px"> 86</b></h5>
                    <hr>
                    <h5 style="color: black;font-weight: 600">Critical Condition:- <b style="color: #1e7e34; font-size: 20px"> 33</b> </h5>
                    <hr>
                </div>-->
            </div>
        </div>

    </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">Sohag</a>.</strong>
    All rights reserved.

  </footer>
  <aside class="control-sidebar control-sidebar-dark">
</div>
<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/js/adminlte.min.js"></script>
<script src="../../contents/js/demo.js"></script>
<script src="../../contents/plugins/custom-scrollbar/jquery.mCustomScrollbar.js"></script>
<script src="../../contents/plugins/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
<script src="../../contents/js/dist/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script>
    $(document).ready(function() {
        $(".scroll-content").mCustomScrollbar({
            axis:"yx",
            theme:"my-theme"
        });

        $(".datepicker").datepicker({
            dateFormat:"yy-mm-dd"
        });
        // $(".fancy").fancybox();
        demo.initChartsPages();

        $(".fancy").click(function () {

        });
    });
</script>
</body>
</html>
