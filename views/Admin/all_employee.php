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
 $_SESSION['checkBack']=1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../contents/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../contents/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../contents/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../contents/plugins/summernote/summernote-bs4.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
                        <a href="all_employee.php" class="nav-link active">
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
        <section class="content-header">
            <div>

            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h3>Employee</h3>
                        <?php

                        if(isset($_SESSION['updatetMsg'])){
                            echo $_SESSION['updatetMsg'];
                            unset($_SESSION['updatetMsg']);
                        }
                        ?>

                        <table id="sohag1" class="table table-bordered table-hover">
                            <thead>
                            <tr style="color: cornflowerblue;background-color: bisque;">
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                          <?php
                          $datas = $datamanipulation->viewAllBuildingWoner();
                          if($datas){
                              $s=1;
                              foreach ($datas as $data){
                                  ?>
                                  <tr>
                                      <td><?php echo $s?></td>
                                      <td><?php echo $data->name?></td>
                                      <td><?php echo $data->phone?></td>
                                      <td><?php echo $data->email?></td>
                                      <td><img src="<?php echo $data->image?>" height="70px" width="70px"></td>
                                      <td>

                                          <a href="../../views/Admin/user_profile.php?view_building_woner_profile_by_email=<?php echo $data->user_id ?>"title="View Profile" <i class=" btn btn-success far fa-eye-slash" aria-hidden="true"></i></a>
                                          <a href="../../views/process/admin_process.php?delete_building_owner=<?php echo $data->user_id ?>"title="Delete" class="btn btn-danger"><i class="fas fa-window-close" aria-hidden="true"></i></a>

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




        </section>



        <footer>

        </footer>
    </div>





    <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="#">sohag</a>.</strong>
        All rights reserved.

    </footer>
    <aside class="control-sidebar control-sidebar-dark">

    </aside>
</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/plugins/chart.js/Chart.min.js"></script>
<script src="../../contents/plugins/sparklines/sparkline.js"></script>
<script src="../../contents/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../contents/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../../contents/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="../../contents/plugins/moment/moment.min.js"></script>
<script src="../../contents/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../contents/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../contents/plugins/summernote/summernote-bs4.min.js"></script>
<script src="../../contents/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../contents/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../contents/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../contents/js/adminlte.js"></script>
<script src="../../contents/js/pages/dashboard.js"></script>
<script src="../../contents/js/demo.js"></script>

<script>
    $(function () {
        $("#sohag1").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#sohag2").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#sohag3").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        $('#sohag').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
</body>
</html>


