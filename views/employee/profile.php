
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
    <title>Profile</title>
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
                    <strong style="font-size: 24px;padding-left: 10px;padding-right: 430px;">Smart Society</strong>
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
                        <a href="profile.php" class="nav-link active">
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
                            <a href="contact_us.php" class="nav-link">
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: #3c763d"><?php echo $name?> Your Profile</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="">

                        <!-- Profile Image -->
                        <div style="height: 96%" class="card card-primary card-outline ">
                            <!--<div class="card-body box-profile">
                              <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="../../contents/img/images.png"
                                     alt="User profile picture">
                              </div>

                              <h3 class="profile-username text-center">Imteaz uddin</h3>

                              <p class="text-muted text-center">Software Engineer</p>

                              <ul class="list-group list-group-unbordered mb-3">

                                <li class="list-group-item">
                                  <b>Road No:</b> <a class="float-right">14</a>
                                </li>
                                <li class="list-group-item">
                                  <b>Building  Name: </b> <a class="float-right">Rakib villa</a>
                                </li>
                                <li class="list-group-item">
                                  <b>Holding No:</b> <a class="float-right">11</a>
                                </li>
                                <li class="list-group-item">
                                  <b>Owner  Name: </b> <a class="float-right">Rakib Uddin</a>
                                </li>
                              </ul>


                            </div>-->
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div style="height: 96%" class="card ">
                            <?php
                            $data = $datamanipulation->showUserProfile($user_id);

                            if($data){
                                $bio="";
                                $name=$data->name;
                                $image=$data->image;
                                $profession=$data->profession;
                                $phone=$data->phone;
                                $holding_no=$data->holding_no;
                                $bio=$data->bio;
                               if($bio){

                                }else{
                                    $bio="";
                                }
                                $ownerData = $datamanipulation->showOwnerData($holding_no);

                                if($ownerData){
                                    $owner_name= $ownerData->owner_name;
                                    $building_name= $ownerData->building_name;
                                    $road_no= $ownerData->road_no;

                                }
                                else{
                                    $owner_name= "";
                                    $building_name="";
                                    $road_no= "";

                                }

                            }
                            ?>

                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                 src="<?php echo $image?>"
                                                 alt="User profile picture">
                                        </div>



                                        <p class="text-muted text-center"><?php echo $profession?></p>
                                        <h3 class="text-muted text-center">Bio</h3>
                                        <p class="text-muted text-center"><?php echo $bio?></p>

                                        <!--<ul class="list-group list-group-unbordered mb-3">

                                          <li class="list-group-item">
                                            <b>Road No:</b> <a class="float-right">14</a>
                                          </li>
                                          <li class="list-group-item">
                                            <b>Building  Name: </b> <a class="float-right">Rakib villa</a>
                                          </li>
                                          <li class="list-group-item">
                                            <b>Holding No:</b> <a class="float-right">11</a>
                                          </li>
                                          <li class="list-group-item">
                                            <b>Owner  Name: </b> <a class="float-right">Rakib Uddin</a>
                                          </li>
                                        </ul>-->


                                    </div>

                                    <!-- <li class="nav-item"><a class="nav-link "  data-toggle="tab">Imteaz profile</a></li>
                   -->
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="settings">
                                        <form class="form-horizontal">
                                            <div class="row">
                                                <div class="col-3"></div>
                                                <div class="col-9">

                                                    <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Name:</label><span> <b style="font-size: 28px;"><?php echo $name?></b></span>
                                                        <!-- <div class="col-sm-10">
                                                           <input type="email" class="form-control" value="">
                                                         </div>-->
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Email:</label><span class=""> <b style="font-size: 28px;"><?php echo  $email?></b></span>
                                                        <!--<div class="col-sm-10">
                                                          <input type="email" class="form-control" value="">
                                                        </div>-->
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Phone:</label><span class=""> <b style="font-size: 28px;"><?php echo $phone?></b></span>
                                                        <!--<div class="col-sm-10">
                                                          <input type="Phone" class="form-control" value="" >
                                                        </div>-->
                                                    </div>


                                                    <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Road No:</label><span class=""> <b style="font-size: 28px;"><?php echo $road_no?></b></span>
                                                        <!-- <div class="col-sm-10">
                                                           <input type="email" class="form-control" value="">
                                                         </div>-->
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Holding No:</label><span class=""> <b style="font-size: 28px;"><?php echo $holding_no?></b></span>
                                                        <!-- <div class="col-sm-10">
                                                           <input type="email" class="form-control" value="">
                                                         </div>-->
                                                    </div>
                                                  <!--  <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Building Name:</label><span class=""> <b style="font-size: 28px;"><?php /*echo $building_name*/?></b></span>

                                                    </div>
-->
                                                    <div class="form-group row">
                                                        <label  class="col-sm-2 col-form-label">Owner Name:</label><span class=""> <b style="font-size: 28px;"><?php echo $owner_name?></b></span>
                                                        <!--   <div class="col-sm-10">
                                                             <input type="text" class="form-control" value="">
                                                           </div>-->
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <div class="form-group" style="font-size: 21px; background: rebeccapurple; text-align: center;border: 1px solid;border-radius: 25px;">
                                                   <!-- <a href="change_profile.php?change_profile=<?php /*echo $email*/?>">Change Profile</a>-->
                                                    <a href="change_profile.php">Change Profile</a>

                                                   <!-- <input type="submit" class="form-control btn btn-outline-secondary" value="Change Profile">-->
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                               <div class="btn  btn-group offset-sm-2 col-sm-10">
                                                 <button type="submit" class="btn btn-outline-secondary">Confirm</button>
                                               </div>
                                             </div>-->
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



