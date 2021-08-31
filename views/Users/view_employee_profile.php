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
  <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
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

    <aside style="background-color: rgba(12,73,38,0.78);position: fixed" class=" main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">

            <span class="brand-text font-weight-light"><b>Employee Hiring System</b></span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
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

                </div>
                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $name?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="home.php" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
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
                            <a href="manage_post.php" class="nav-link">
                                <i class="nav-icon fas fa-microphone"></i>
                                <p>
                                    Manage Post
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="message.php" class="nav-link">
                                <i class="nav-icon far fa-comments"></i>
                                <p>Message</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="employee.php" class="nav-link active">
                                <i class=" nav-icon fas fa-users"></i>
                                <p>Employee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="booking_list.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>My Booking List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact_us.php" class="nav-link">
                                <i class="nav-icon fas fa-phone"></i>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php
        if(isset($_GET['employee_id'])){
            $data =$datamanipulation->view_building_woner_profile_by_email($_GET['employee_id']);
            $checkEmail=$datamanipulation->checkValid($_GET['employee_id']);
        }
        ?>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $data->name?> Profile Information</h1>
          </div>

        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="">

            <div style="height: 96%" class="card card-primary card-outline ">

            </div>

          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div style="height: 96%" class="card ">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <div class="card-body box-profile">
                    <div class="text-center">

                      <img class="profile-user-img img-fluid img-circle"
                           src="<?php echo $data->image?>"
                           alt="User profile picture">
                    </div>

                    <p class="text-muted text-center"><?php echo $data->profession?></p>
                    <h3 class="text-muted text-center">Bio</h3>
                    <p class="text-muted text-center"><?php echo $data->bio?></p>

                  </div>

                </ul>
                  <?php

                  if(isset($_SESSION['updateMsg'])){
                      echo $_SESSION['updateMsg'];
                      unset($_SESSION['updateMsg']);
                  }
                  ?>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Name:</label><span> <b style="font-size: 28px;"><?php echo $data->name?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Email:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->email?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Phone:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->phone?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">User Type:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->type?></b></span>

                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Address:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->road_no?></b></span>

                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Holding No:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->holding_no?></b></span>

                      </div>
                        <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">House owner Name:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->owner_name?></b></span>

                      </div>
                        <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Building Name:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->building_name?></b></span>

                      </div>
                        <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Addrss:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->address?></b></span>

                      </div>


                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">work:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->work?></b></span>

                        </div>

                           <div class="row">
                               <div class="col-sm-12 btn-group mb-4">
                                   <?php
                                   if($data->email!=null){
                                       ?>
                                       <a  style="color: white" class="btn btn-success  btn-outline-dark  btn-group" href="employee.php" >BACK</a>

                                       <a style="color: white" class="btn btn-primary  btn-outline-secondary btn-group" href="../process/user_process.php?hire_employee_id=<?php echo $data->user_id?>" >SEND HIRE REQUEST</a>

                                       <?php
                                   }else{
                                       ?>
                                       <a  style="color: white" class="btn btn-success  btn-outline-dark  btn-group" href="employee.php" >BACK</a>
                                       <?php
                                   }
                                   ?>


                               </div>

                           </div>


                    </form>
                  </div>

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">Sohag</a>.</strong>
    All rights reserved.

  </footer>
  <aside class="control-sidebar control-sidebar-dark">
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/js/adminlte.min.js"></script>
<script src="../../contents/js/demo.js"></script>
</body>
</html>
