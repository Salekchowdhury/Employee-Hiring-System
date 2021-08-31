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
    <?php
    $data = $datamanipulation->showUserProfile($user_id);

    if($data){
        $name=$data->name;
        $images=$data->image;
        $profession=$data->profession;
        $phone=$data->phone;
        $holding_no=$data->holding_no;
        $bio=$data->bio;
        $address=$data->address;
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
                    <strong style="font-size: 24px;padding-left: 10px;padding-right: 730px;">Employee Hire System</strong>
                    <p style="color: red">Account Not Verified</p>
                </li>
                <?php
            }else{
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <strong style="font-size: 24px;padding-left: 10px;padding-right: 730px;">Employee Hiring System</strong>
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
                    <a href="profile.php" class="d-block"><?php echo $name?></a>
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
                        <h1>Profile</h1>

                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php

                if(isset($_SESSION['EmptyFile'])){
                    echo $_SESSION['EmptyFile'];
                    unset($_SESSION['EmptyFile']);
                }

                    if (isset($_SESSION["UdateMsg"])){
                        echo $_SESSION["UdateMsg"];
                        unset($_SESSION["UdateMsg"]);
                    }

                ?>

                <div class="row">

                    <div class="col-md-3">
                        <form role="form" action="../../views/process/user_process.php" method="post" enctype="multipart/form-data">
                            <!-- Profile Image -->
                            <div style="height: 96%" class="card card-primary card-outline ">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                      <!--  --><?php
/*
                                        $data = $datamanipulation->totalPost($email);
                                        $data=$data->total;
                                        if($data){
                                            $value=$data;
                                        }else{
                                            $value=0;
                                        }
                                        */?>
                                        <img class="profile-user-img img-fluid img-circle" src="<?php echo $images ?>" alt="User profile picture" style=" height: 100px; width: 100px  ;border: 1px solid rgba(15,80,36,0.41) ">

                                        <input type="file" name="profileImage" accept="image/x-png,image/gif,image/jpeg">
                                        <br>


                                        <input type="hidden" name="email"  value="<?php echo $email?>">
                                        <input type="submit" style="width:60%; background: coral;font-size: 12px" class="btn btn-primary mt-1" name="uploadImage"  value="Upload">

                                    </div>

                                    <h3 class="profile-username text-center"><?php echo  $name?></h3>

                                    <p  class="text-muted text-center"><?php echo  $profession?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email:</b> <a class="float-right"><?php echo  $email?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Phone:</b> <a class="float-right"><?php echo  $phone?></a>
                                        </li>
                                       <!-- <li class="list-group-item">
                                            <b>Total Post:</b> <a class="float-right"><?php /*echo $value*/?></a>
                                        </li>-->

                                    </ul>

                                </div>
                            </div>

                    </div>
                    </form>

                    <div class="col-md-9">
                        <div style="height: 96%" class="card ">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Update profile</a></li>
                                    <li class="nav-item"><a class="nav-link " href="#pass" data-toggle="tab">Change Password</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="settings">
                                        <form class="form-horizontal" action="../process/employee_process.php" method="post">
                                            <input class="user_id" name="user_id" type="hidden" value="<?php echo $user_id?>" >

                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Name:</label>
                                                <div class="col-sm-10">
                                                    <input  class="form-control" name="name" value="<?php echo  $name?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Profession:</label>
                                                <div class="col-sm-10">
                                                    <input  class="form-control" name="profession" value="<?php echo  $profession?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Phone:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control " name="phone" value="<?php echo  $phone?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Road No:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="road_no" value="<?php echo  $road_no?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Holding No:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="holding_no" value="<?php echo  $holding_no?>">
                                                </div>
                                            </div>

                                              <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Building Name:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"  name="building_name" value="<?php echo  $building_name?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Address:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"  name="address" value="<?php echo  $address?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Bio:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="bio" value="<?php echo  $bio?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-outline-secondary" name="update" >Update</button>
                                                </div>
                                    </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane " id="pass">
                                        <div class='alert alert-success pass-match-success' style="display: none">Change password successfully</div>
                                        <div class='alert alert-danger error-not-match' style="display: none">Your old password is not correct..please try again..</div>
                                        <form class="form-horizontal" action="#" method="post">
                                            <input class="user_id" name="user_id" type="hidden" value="<?php echo $user_id?>" >
                                            <div class="form-group row">
                                                <label for="inputOldPass" class="col-sm-2 col-form-label">Old Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="old_password" id="inputOldPass" placeholder="Old Password" value="">
                                                    <div class="error-old-pass text-danger"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputNewPass" class="col-sm-2 col-form-label">New Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="new_password" id="inputNewPass" placeholder="New Password" value="">
                                                    <div class="error-new-pass text-danger"></div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="inputConfirmPass" class="col-sm-2  col-form-label">Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="confirm_password" id="inputConfirmPass" placeholder="Confirm Password" value="">
                                                    <div  class="error-re-pass text-danger"></div>
                                                </div>

                                            </div>



                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="button" name="update_password" class="btn btn-outline-secondary update_password" >Update Password</button>
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

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#inputOldPass").keyup(function () {
            alertVanish()
        })
        $("#inputNewPass").keyup(function () {
            alertVanish2()
        })
        $("#inputConfirmPass").keyup(function () {
            alertVanish3()
        })
        function alertVanish() {
            var old_pass = $("#inputOldPass").val().trim();
            if(old_pass.length>0){
                $("#inputOldPass").css('outline','none')
                $(".error-old-pass").text("")
            }
            else {
                $("#inputOldPass").css('outline','1px solid red')
                $(".error-old-pass").text("Please write your old password")
            }
        }
        function alertVanish2() {
            var re_pass = $("#inputConfirmPass").val().trim();
            var new_pass = $("#inputNewPass").val().trim();
            if(new_pass.length>0 && new_pass.length>4 ){
                $("#inputNewPass").css('outline','none')
                $(".error-new-pass").text("")
            }
            else {
                $("#inputNewPass").css('outline','1px solid red')
                $(".error-new-pass").text("New password should be above 4 character")
            }
            if(re_pass==new_pass){
                $("#inputConfirmPass").css('outline','none')
                $(".error-re-pass").text("Pasword Match")
                $(".error-re-pass").removeClass('text-danger')
                $(".error-re-pass").css('color','green')
            }
            else {
                $("#inputConfirmPass").css('outline','1px solid red')
                $(".error-re-pass").addClass('text-danger')
                $(".error-re-pass").text("Confirm password not equal to new password")
            }
        }
        function alertVanish3() {
            var re_pass = $("#inputConfirmPass").val().trim();
            var new_pass = $("#inputNewPass").val().trim();
            if(re_pass.length>0 && re_pass.length>4){
                $("#inputConfirmPass").css('outline','none')
                $(".error-re-pass").text("")
            }
            else {
                $("#inputConfirmPass").css('outline','1px solid red')
                $(".error-re-pass").text("Confirm password should be above 4 character")
            }
            if(re_pass==new_pass){
                $("#inputConfirmPass").css('outline','none')
                $(".error-re-pass").text("Pasword Match")
                $(".error-re-pass").removeClass('text-danger')
                $(".error-re-pass").css('color','green')
            }
            else {
                $("#inputConfirmPass").css('outline','1px solid red')
                $(".error-re-pass").addClass('text-danger')
                $(".error-re-pass").text("Confirm password not equal to new password")
            }
        }

        $(".update_password").click(function () {
            var old_pass = $("#inputOldPass").val().trim();
            var new_pass = $("#inputNewPass").val().trim();
            var re_pass = $("#inputConfirmPass").val().trim();
            var user_id = $(".user_id").val();
            var btn_chnge = "";
            if(old_pass.length>4 && new_pass.length>4 && re_pass.length>4 && new_pass==re_pass){
                $.ajax({
                    url:"../process/employee_process.php",
                    type:'POST',
                    data:{
                        old_pass:old_pass,
                        new_pass:new_pass,
                        re_pass:re_pass,
                        user_id:user_id
                    },
                    success:function (result) {
                        console.log(result)
                        var data = JSON.parse(result);
                        console.log(data)
                        if(data.password == old_pass){
                            var new_pass = $("#inputNewPass").val().trim();

                            console.log(data.pass)
                            $.ajax({
                                url:"../process/user_process.php",
                                type:'POST',
                                data:{
                                    new_pass:new_pass,
                                    re_pass:re_pass,
                                    user_id:user_id,
                                    btn_change:btn_chnge,
                                },
                                success:function (response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Password changed successfully',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    $("#inputOldPass").val(null)
                                    $("#inputNewPass").val(null)
                                    $("#inputConfirmPass").val(null)
                                    $(".error-re-pass").text("")
                                }

                            })
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Old password not matched',

                            })

                            $("#inputOldPass").val(null)
                            $("#inputNewPass").val(null)
                            $("#inputConfirmPass").val(null)
                            $(".error-re-pass").text("")
                        }
                    }

                })
            }
            else {
                if(old_pass.length<1){
                    $("#inputOldPass").css('outline','1px solid red')
                    $(".error-old-pass").text("Please write your old password")
                }
                if(new_pass.length<1){
                    $("#inputNewPass").css('outline','1px solid red')
                    $(".error-new-pass").text("Please write your new password")
                }
                if(new_pass.length<1){
                    $("#inputConfirmPass").css('outline','1px solid red')
                    $(".error-re-pass").text("Please write your confirm password")
                }
            }



        })


    });
</script>
</body>
</html>



