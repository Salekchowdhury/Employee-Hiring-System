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
    <title>Booking List</title>
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
                    <strong style="font-size: 24px;padding-left: 10px;padding-right: 730px;">Employee Hiring System</strong>
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

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown mr-5">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i style="font-size: 24px;color: brown" class="far fa-bell"></i><span style="position: absolute;border-radius: 50%" class="badge badge-danger">

                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span style="font-weight: bold" class="dropdown-item dropdown-header">Notifications</span>
                    <div class="dropdown-divider"></div>





                </div>
            </li>
        </ul>
    </nav>

    <aside style="background-color: rgba(12,73,38,0.78)" class=" main-sidebar sidebar-dark-primary elevation-4">
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
                            <a href="employee.php" class="nav-link ">
                                <i class=" nav-icon fas fa-users"></i>
                                <p>Employee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="booking_list.php" class="nav-link active">
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

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Booking History</h1>
                    </div>

                    <?php

                    if(isset($_SESSION['updateMsg'])){
                        echo $_SESSION['updateMsg'];
                        unset($_SESSION['updateMsg']);
                    }
                    ?>
                </div>
            </div>
        </section>

        <div class="content wow rotateInDownLeft" data-wow-duration= "1s">
            <div class="row">
                <div class="col-md-12" >
                    <div class="card card-plain">

                        <div class="card-body">
                            <div class="scroll-content">
                                <table class="table">
                                    <thead class=" text-primary" style="background-color: rgba(12,73,38,0.78)">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                        Employee Name
                                    </th>
                                    <th>
                                        Employee Phone
                                    </th>
                                    <th>
                                        Hire Date
                                    </th>
                                    <th>
                                        Work Details
                                    </th>

                                    <th style="text-align: center">
                                        Action
                                    </th>
                                    </thead>
                                    <tbody>
                                     <?php
                                     $bookingData =$datamanipulation->ShowMyBookingHistory($user_id);
                                     $s=1;
                                     if($bookingData){
                                        foreach ($bookingData as $list){

                                            $date=$list->date;
                                            $dateArray = explode("-",$date);

                                            $dateRevers= array_reverse($dateArray);
                                            $dateString = implode("-", $dateRevers);
                                            ?>
                                            <tr>
                                                <td>
                                                 <?php echo $s?>
                                                </td>
                                                <td>
                                                    <?php echo $list->employee_name?>

                                                </td>

                                                <td>
                                                    <?php echo $list->employee_phone?>

                                                </td>

                                                <td>
                                                    <?php echo $dateString?>
                                                </td>
                                                <td>
                                                    <?php echo $list->works_details?>
                                                </td>

                                                <td class="text-center">
                                                    <a href="../process/user_process.php?booking_history_delete_id=<?php echo $list->id?>" class="btn bg-danger btn-outline-success fancy" data-type="iframe" ><i class="fa fa-trash"></i> Delete</a>

                                                </td>
                                            </tr>
                                            <?php
                                            $s++;
                                        }
                                     }
                                     ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
</script>
</body>
</html>



