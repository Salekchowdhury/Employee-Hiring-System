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
    <title>Chat</title>
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
                            <a href="message.php" class="nav-link active">
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
                            <a href="booking_list.php" class="nav-link ">
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
        <input type="hidden" class="user_id" value="<?php echo $user_id?>">
        <input type="hidden" class="user_name" value="<?php echo $name?>">
        <input type="hidden" class="sellers_name">
        <input type="hidden"  class="seller_id">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chat</h1>
                    </div>
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
                                        Employee Email
                                    </th>
                                    <th>
                                        Employee Phone
                                    </th>
                                    <th>
                                        Work Details
                                    </th>

                                    <th style="text-align: center">
                                        Action
                                    </th>
                                    </thead>
                                    <tbody class="attrTable">
                                    <?php
                                    $bookingData =$datamanipulation->ShowEmployeeList();
                                    $s=1;
                                    if($bookingData){
                                        foreach ($bookingData as $list){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $s?>
                                                </td>
                                                <td  class="attrName">
                                                    <?php echo $list->name?>
                                                    <span class="message-show-on-alert badge-danger badge"></span>
                                                </td>
                                                <td>
                                                    <?php echo $list->email?>

                                                </td>

                                                <td>
                                                    <?php echo $list->phone?>

                                                </td>
                                                <td>
                                                    <?php echo $list->profession?>
                                                </td>

                                                <td class="text-center">
                                                    <a data-id="<?php echo $list->user_id?>" class="btn bg-danger btn-outline-success attrValue show-chat-box-click" ><i class="fa fa-trash"></i> Chat</a>

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

        <div style="display: none; position: absolute; width: 30%; bottom: 0;right: 5%; z-index: 9999999" class="show-chat-box card card-warning direct-chat direct-chat-warning shadow">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-close-tool">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body ">
                <div style="height: 400px" class="direct-chat-messages chatlogs">


                </div>
            </div>
            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control chatMessageSend">
                        <span class="input-group-append">
                      <button type="button" class="btn btn-warning chatSendBtn">Send</button>
                    </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
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
<script>
    setInterval(function () {
        var ary = [];
        var buyers_id = $(".user_id").val();
        $(function () {
            $('.attrTable tr').each(function (a, b) {
                /*var name = $('.attrName', b).text();*/
                var value = $('.attrValue', b).attr('data-id');
                ary.push(value)
            });
            /*console.log(JSON.stringify(ary));*/
            $.ajax({
                url: "../process/chat_process.php",
                type:'GET',
                data:{user_type_for_buyers:ary,user_id:buyers_id},
                success:function (result) {
                    var datas = JSON.parse(result);
                    htmlstring = "";
                    var j = 0;
                    for (var f = 0; f<ary.length; f++) {
                        for (var i = 0; i < datas.length; i++) {
                            if ((datas[i].messageRead == "unseen") && (datas[i].employee_id == ary[f]) ) {
                                console.log(datas)
                                $('.attrTable tr').each(function (a, b) {
                                    var name = $('.attrName', b).text();
                                    /*var value = $('.attrValue', b).attr('data-id');*/
                                    if($(".attrValue",b).attr('data-id') == datas[i].employee_id){
                                        j=j+1;
                                        htmlstring = $(".attrValue",b).attr('data-id');
                                        $('.attrName .message-show-on-alert',b).text(j);
                                    }
                                });
                            }
                        }
                        j=0;
                    }
                }
            });
        });
    },800);
    $(".show-chat-box-click").click(function () {
        var buyers_name = $(".user_name").val();
        var buyers_id = $(".user_id").val();
        var sellers_id = $(this).attr("data-id");
        var sellerDataCollectViaId = "";
        var sellers_name = $(this).parent().parent().find('td').eq('1').text().trim();
        $(".seller_id").val(sellers_id);
        $(".sellers_name").val(sellers_name);

        setInterval(function () {
            $.ajax({
                type: "POST",
                url: "../process/chat_process.php",
                data: {
                    sellerDataCollectViaId :sellerDataCollectViaId,
                    buyers_id :buyers_id,
                    sellers_id :sellers_id,
                },
                success: function(data)
                {
                    var data = JSON.parse(data);
                    var htmlstring = "";
                    for(var i =0; i<data.length;i++){
                        if((data[i].message_from) !=null){
                            htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                "                            <span class=\"direct-chat-name float-left\">" + data[i].user_name + "</span>\n" +
                                "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                "                        </div>\n" +
                                "                        <img class=\"direct-chat-img\"  src=\"https://cdn3.iconfinder.com/data/icons/chat-bot-blue-filled-color/300/215226424Untitled-3-512.png\"  alt=\"Message User Image\">\n" +
                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                "                        </div>\n" +
                                "                    </div>"
                        }
                        if((data[i].message_to) !=null){
                            htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                "                            <span class=\"direct-chat-name float-right\">"+ data[i].employee_name + "</span>\n" +
                                "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                "                        </div>\n" +
                                "                        <img class=\"direct-chat-img\"  src=\"https://cdn2.iconfinder.com/data/icons/bots-monochrome/280/5-512.png\"  alt=\"Message User Image\">\n" +
                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                "                        </div>\n" +
                                "                    </div>"
                        }
                    }
                    $('.chatlogs').html(htmlstring);
                }
            });
        },1000);

        $(".btn-tool").click(function () {
            sellers_id = null;
            $(".seller_id").val("")
        });
        $(".show-chat-box").css("display","block")

    });
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

    $(".btn-close-tool").click(function () {
        $(".show-chat-box").css("display","none");
        location.reload();
    });

    $(".chatSendBtn").click(function () {
        var buyers_name = $(".user_name").val();
        var buyers_id = $(".user_id").val();
        var sellers_id = $(".seller_id").val();
        var sellers_name = $(".sellers_name").val();
        var chat_message = $(".chatMessageSend").val();
        var htmlstring = " ";
        var sellerDataCollectViaId = " ";
        if(chat_message.length>0){
            $.ajax({
                type: "POST",
                url: "../process/chat_process.php",
                data: {
                    buyers_name :buyers_name,
                    buyers_id :buyers_id,
                    sellers_id :sellers_id,
                    sellers_name :sellers_name,
                    chat_message :chat_message,
                },
                success: function(data)
                {
                    $(".chatMessageSend").val("")
                    $.ajax({
                        type: "POST",
                        url: "../process/chat_process.php",
                        data: {
                            sellerDataCollectViaId :sellerDataCollectViaId,
                            buyers_id :buyers_id,
                            sellers_id :sellers_id,
                        },
                        success: function(data)
                        {
                            var data = JSON.parse(data);
                            for(var i =0; i<data.length;i++){
                                if(data[i].message_from !=null){
                                    htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                        "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                        "                            <span class=\"direct-chat-name float-left\">" + data[i].user_name + "</span>\n" +
                                        "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                        "                        </div>\n" +
                                        "                        <img class=\"direct-chat-img\"  src=\"https://cdn3.iconfinder.com/data/icons/chat-bot-blue-filled-color/300/215226424Untitled-3-512.png\"  alt=\"Message User Image\">\n" +
                                        "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                        "                        </div>\n" +
                                        "                    </div>"
                                }
                                if(data[i].message_to !=null){
                                    htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                        "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                        "                            <span class=\"direct-chat-name float-right\">"+ data[i].employee_name + "</span>\n" +
                                        "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                        "                        </div>\n" +
                                        "                        <img class=\"direct-chat-img\"  src=\"https://cdn2.iconfinder.com/data/icons/bots-monochrome/280/5-512.png\"  alt=\"Message User Image\">\n" +
                                        "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                        "                        </div>\n" +
                                        "                    </div>"
                                }
                            }
                            $('.chatlogs').html(htmlstring);
                        }
                    });
                }
            });
        }
    });


</script>
</body>
</html>



