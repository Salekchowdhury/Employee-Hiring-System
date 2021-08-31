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
  <link rel="stylesheet" href="../../contents/css/libs/animate.css">
  <link rel="stylesheet" href="../../contents/css/toastr.min.css">
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
            <span class="brand-text font-weight-light"><b>Employee Hire System</b></span>
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
                        <a href="manage_post.php" class="nav-link active">
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
                        <a href="add_employee.php" class="nav-link">
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

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Post</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['TostUpdate'])){
            echo $_SESSION['TostUpdate'];
            unset($_SESSION['TostUpdate']);
        }
        ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-widget widget-user shadow">
                            <div class="widget-user-header text-dark" style="background: url('../../assets/img/photo1.png')">
                                <h3 class="widget-user-username text-right"><?php echo $name ?></h3>
                                <h5 class="widget-user-desc text-right">Admin</h5>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php
                                                $value = $datamanipulation->viewAllPostForAdmin();
                                                $count = 0;
                                                if($value){
                                                    foreach ($value as $values){
                                                        $count++;
                                                    }
                                                    echo $count;
                                                }
                                                else{
                                                    echo $count;
                                                }
                                                ?></h5>
                                            <span class="description-text">Total Post</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 timeline">
                        <?php
                        $listOfValues = $datamanipulation->viewAllPostForAdmin();
                        if ($listOfValues){
                            foreach ($listOfValues as $listOfValues){
                                ?>

                                <div class="time-label">
                                    <span class="bg-red"><?php echo $listOfValues->date?></span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?php echo $listOfValues->time?></span>
                                        <h3 class="timeline-header"><?php echo $listOfValues->name?></h3>

                                        <div class="timeline-body">
                                            <?php echo $listOfValues->post ?>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="../process/user_process.php?managePostDelete=<?php echo $listOfValues->no; ?>" class="btn btn-info btn-sm"><i class="fas fa-trash"></i> Delete</a>
                                        </div>

                                    </div>
                                </div>

                                <?php

                                if ($listOfValues->commentNo == NULL ){
                                    $comment = $datamanipulation->viewPostComment($listOfValues->no);
                                    foreach ($comment as $comments){
                                        if($listOfValues->no == $comments->commentNo ) {
                                            ?>
                                            <div>
                                                <i class="fas fa-comments bg-yellow"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> <?php echo $comments->date," ",$comments->time ; ?></span>
                                                    <h3 class="timeline-header"><?php echo "<b>", $comments->name,"</b>"; ?></h3>
                                                    <div class="timeline-body">
                                                        <?php echo $comments->post; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <div class="typewriter d-flex justify-content-center mt-5">
                                <h1>There is no post.</h1>
                            </div><?php
                        }
                        ?>
                    </div>
                    <form action="../process/data-process.php" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="min-height: 250px" class="modal-body">
                                        <textarea name="updatePostDataSection" class="updatePostDataSection" style="resize: none; width: 100%;height: 240px"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="user_no_from" class="user_no_from">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="btn-save-changes" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
        </section>

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
<script>

    $("#toast-container").fadeOut(3000)


</script>
<script src="../../contents/js/dist/wow.min.js"></script>
<script>
    new WOW().init();
</script>
</body>
</html>
