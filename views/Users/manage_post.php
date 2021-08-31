
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
    <link rel="stylesheet" href="../../contents/css/toastr.min.css">
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
                        <a href="profile.php" class="nav-link ">
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
                            <a href="manage_post.php" class="nav-link active">
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
        <br>
        <?php
        if(isset($_SESSION['TostUpdate'])){
            echo $_SESSION['TostUpdate'];
            unset($_SESSION['TostUpdate']);
        }
        ?>
        <section class="content container-fluid">
            <div class="row ml-5">
                <div class="col-md-10 timeline">
                    <?php
                    $Meid =  $user_id; $Mename= $name;
                    $listOfValues = $datamanipulation->viewPostByUserId($Meid);
                    if ($listOfValues){
                        foreach ($listOfValues as $listOfValues){
                            ?>

                            <div class="time-label">
                                <span class="bg-red"><?php echo $listOfValues->date?></span>
                            </div>
                            <div>
                                <i class="fas fa-envelope bg-gradient-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?php echo $listOfValues->time?></span>
                                    <h3 class="timeline-header"><?php echo $listOfValues->name?></h3>

                                    <div class="timeline-body">
                                        <?php echo $listOfValues->post ?>
                                    </div>
                                    <div class="timeline-footer">
                                        <a data-id = "<?php echo $listOfValues->no ?>"class="btn btn-info btn-sm editPost" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <a href="../process/user_process.php?managePostDelete=<?php echo $listOfValues->no; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"> </i> Delete</a>
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
                                            <i class="fas fa-comments bg-gradient-danger"></i>
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
                            <h1>You Have No Post.</h1>
                        </div><?php
                    }
                    ?>
                </div>
                <form action="../process/user_process.php" method="post">
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
                                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                    <button type="submit" name="btn-save-changes" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>


    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>
<script>

    $("#toast-container").fadeOut(3000)

    $(".editPost").click(function () {
        var value = $(this).attr('data-id');
        var postDataCollect = " ";
        $.ajax({
            type: "POST",
            url: "../process/user_process.php",
            data: {
                value: value,
                postDataCollect :postDataCollect
            },
            success: function(data)
            {
                var data = JSON.parse(data);

                $(".updatePostDataSection").val(data.post)
                $(".user_no_from").val(data.no)

            }
        });
    })
</script>
</body>
</html>



