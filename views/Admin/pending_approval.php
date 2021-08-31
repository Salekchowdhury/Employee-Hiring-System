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
unset($_SESSION['checkBack']);
$_SESSION['checkBack']=0;
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
                        <a href="pending_approval.php" class="nav-link active">
                            <i class="nav-item nav-icon far fa-address-card"></i>
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

  <div class="content-wrapper wow slideInLeft" data-wow-duration= "1s">
    <section class="content-header">
      <div>

      </div>
      <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <h3>Members</h3>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr style="color: cornflowerblue;background-color: bisque;">
                            <th>Serial</th>
                            <th>Name</th>
                            <th>User Type</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $datas = $datamanipulation->viewPendingBuildinWoner();
                        $s=1;
                        if($datas){
                            foreach ($datas as $data){
                                ?>
                                <tr>
                                    <td><?php echo $s?></td>
                                    <td><?php echo $data->name?></td>
                                    <td><?php echo $data->type?></td>
                                    <td><?php echo $data->phone?></td>
                                    <td><?php echo $data->email?></td>
                                    <td><img src="<?php echo $data->image?>" height="70px" width="70px"></td>
                                    <td>
                                        <a href="../../views/Admin/user_profile.php?view_building_woner_profile_by_email=<?php echo $data->user_id ?>"title="View Profile" <i class=" btn btn-success  far fa-eye-slash" aria-hidden="true"></i></a>
                                        <a href="../../views/process/admin_process.php?confirm_building_woner=<?php echo $data->user_id ?>"title="Confim" class="btn btn-primary "><i class="fas fa-check-circle"></i></a>
                                        <!--<a href="../../views/process/admin_process.php?status_delete_Email_form_all_student=<?php /*echo $data->email */?>"title="Delete" class="btn btn-danger "><i class="fas fa-window-close" aria-hidden="true"></i></a>-->

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
    <strong>Copyright &copy; 2021 <a href="#">Sohag</a>.</strong>
    All rights reserved.

  </footer>
  <aside class="control-sidebar control-sidebar-dark">

  </aside>

</div>
<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/js/adminlte.min.js"></script>
<script src="../../contents/js/demo.js"></script>
<script src="../../contents/js/dist/wow.min.js"></script>
<script>
    new WOW().init();
</script>
</body>
</html>
