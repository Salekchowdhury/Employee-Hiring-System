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
    <title>Home</title>
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
                        <a href="home.php" class="nav-link active">
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
    <input id="user_id" class="user_id" name="user_id" type="hidden" value="<?php echo $user_id?>" >
    <input class="user_email" name="user_email" type="hidden" value="<?php echo $email?>" >
    <input id="name" class="name" name="name" type="hidden" value="<?php echo $name?>" >
    <div class="content-wrapper">
        <section class="content-header">
            <?php
            $data = $datamanipulation->CheckVarifyAccount($email);
            if($data){
                ?>
                <div>
                    <form id="FormData" action="" method="post" enctype="multipart/form-data">
                        <input id="user_id" class="user_id" name="user_id" type="hidden" value="<?php echo $user_id?>" >
                        <input class="user_email" name="user_email" type="hidden" value="<?php echo $email?>" >
                        <input id="name" class="name" name="name" type="hidden" value="<?php echo $name?>" >
                        <div class="form-group col-sm-8" style="margin-left: 158px;">
                            <textarea style="resize: none" class="form-control post-message main-search" name="noticeInfo" rows="8" cols="20" placeholder="Write Your Post"></textarea>
                            <div class="form-group " style="margin-top: -32px;">
                                <input type="button" class="form-control col-sm-12 btn btn-outline-success newNotice"  name="post" value="Post" style="margin-top: 37px;">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            }
            ?>
            <div class="dataShow col-md-10 ml-auto mr-auto">
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

    showData();
    var user_name = $("#name").val();
    var user_id = $("#user_id").val();
    function tConvert (time) {
        // Check correct time format and split into components
        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice (1);  // Remove full string match value
            time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join (''); // return adjusted time or original string
    }
    function showData() {
        var getData = " ";
        $.ajax({
            type: "GET",
            url: "../process/user_process.php",
            data: {
                getData: getData
            },
            success: function(data)
            {
                var data = JSON.parse(data);
                var html = " ";
                var htmlString = " ";
                for (var i = 0;  i<data.length;  i++){
                    if (data[i].commentNo == null) {
                        html +="<div class=\"\">\n" +
                            "<div class=\"card card-widget\">\n" +
                            "<div class=\"card-header\">\n" +
                            "<div class=\"user-block\">\n" +
                            "<span class=\"username\"><a href=\"#\">" + data[i].name + "</a></span>\n" +
                            "<span class=\"description\">" +data[i].date + " Time " +  tConvert(data[i].time) +"</span>\n" +
                            "</div>\n" +
                            "<div class=\"card-tools\">\n";
                        html+= "</div>\n" +
                            "</div>\n" +
                            "<div class=\"card-body\">\n" +
                            "<p>" + data[i].post + "</p>" +
                            "<span class=\"float-right text-muted\">Comments</span></div>"

                        for (var j = 0; j < data.length; j++) {
                            if (data[i].no == data[j].commentNo) {
                                html += "<div class=\"card-footer card-comments\">\n" +
                                    "<div class=\"card-comment\">\n" +
                                    "<div class=\"comment-text\">\n" +
                                    "<span class=\"username\">\n" + data[j].name +
                                    "<span class=\"text-muted float-right\">"  + tConvert(data[j].time) + " </span>\n" +
                                    "</span>" + data[j].post +
                                    "</div>\n" +
                                    "</div>\n" +
                                    "</div>\n"
                            }
                        }
                        html += "<div class=\"card-footer\">\n" +
                            "<a href='' data-id ='"+ data[i].no +"' class=\"telegrambtn text-danger img-fluid img-circle img-sm\"><i class=\"fab fa-telegram fa-2x\" ></i></a>\n" +
                            "<div class=\"img-push\">\n" +
                            "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"Press enter to post comment\">\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "</div>"


                    }
                    $(".dataShow").html(html);
                    $(".telegrambtn").click(function (e) {
                        e.preventDefault();
                        var commentValue = $(this).parent().find('input').val();
                        var commentNo = $(this).attr("data-id");
                        var user_name = $("#name").val();
                        var user_id = $("#user_id").val();
                        if (commentValue.length>0){
                            $.ajax({
                                type: "POST",
                                url: "../process/user_process.php",
                                data: {
                                    commentValue: commentValue,
                                    commentNo: commentNo,
                                    user_name: user_name,
                                    user_id: user_id,
                                },
                                success: function(data)
                                {
                                    showData()
                                }
                            });
                            $(this).parent().find('input').val(" ")

                        }
                    })
                    $(".confirm_Btn_eye").click(function () {
                        var confirm = $(this).attr('data-id');
                        $(".parent_id").val(confirm)
                    });
                }
            }
        });

    }
    function submitPostData(form_data) {
        $.ajax({
            type: "POST",
            url: "../process/user_process.php",
            data: form_data,
            processData:false,
            contentType:false,
            cache:false,
            success: function(data)
            {
                showData()
            }
        });
    }
    $(".resetbtn").click(function () {
        document.getElementById("ConfirmForm").reset();
    });
    $(".newNotice").click(function (e) {
        e.preventDefault();
        var textarea = $(".post-message").val().length;
        var textareas = $(".post-message").val();
        /* var imageFilename = $("#customFile").val().length;*/
        var form_data = new FormData($('#FormData')[0]);
        /*form_data.append("file",imageFilename);*/
        form_data.append("user_name",user_name);
        form_data.append("user_id",user_id);
        /* form_data.append("textarea",textareas);*/
        if(textarea>0)
        {
            submitPostData(form_data);
            $(".post-message").val("");
        }
    })

</script>
</body>
</html>



