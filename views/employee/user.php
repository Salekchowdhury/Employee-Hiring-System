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
$_SESSION['checkBack']=0;
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
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-student.css">
    <link rel="stylesheet" href="../../contents/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../contents/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../contents/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="../../contents/css/custom.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper ">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item ">
               <strong style="font-size: 24px;padding-left: 10px;">Employee Hiring System</strong>
            </li>


        </ul>


    </nav>

    <aside style="background-color: rgba(116,12,41,0.6);position: fixed" class="student-bg main-sidebar sidebar-dark-primary elevation-4">
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
        <section class="content-header">
            <div class="chatbox" style="height: 650px; top: 60px;">
                <p style=" display: none" class="text-value-get"></p>

                <div class="d-flex justify-content-end mb-4 close-btn">
                    <i style="cursor: pointer" class="fa fa-times change-hidden" aria-hidden="true"></i></div>
                <div id="chatmessages" class="chatlogs " style="height: 500px">
                    <!--<div class="chat student">
                        <div class="user-photo">
                            <img src="../../contents/img/smart-city.jpg" alt="User Image">
                            </div>
                        <p class='chat-message teacher-msg'></p>
                        </div>
                    <div class="chat self">
                        <div class="user-photo">
                            <img src="../../contents/img/smart-city.jpg" alt="User Image">
                            </div>
                        <p class="chat-message student-msg"></p>
                        </div>-->

                </div>
                <div class="chat-form">
                    <textarea id="message-value" required placeholder="Please type here...."></textarea>
                    <button type="button" id="send"><i class="fa fa-paper-plane"></i></button>
                </div>
            </div>

            <div class="update-table col-12">
                <div class="card">

                    <div class="card-body">
                        <h3>Employee List</h3>




                        <table id="" class="table table-bordered table-hover">
                            <thead>
                            <tr style="color: white;background-color: rgba(116,12,41,0.6);position:;">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <?php
                            $data = $datamanipulation->allUsers($user_id);
                            $count = 1;
                            if($data){
                                foreach ($data as $list){
                                    ?>
                                    <tbody class="attrTable">
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td><img src="<?php echo $list->image ?>" height="100"  width="100" style="border-radius: 50%; border-color: #a71d2a; border: solid 1px"  alt=""></td>

                                        <td class="attrName"><?php echo $list->name; ?>
                                            <span style="color: #c30000;"><b>(<?php echo $list->profession ?>)</b></span>
                                            <span class="message-show-on-alert badge-danger badge"></span>
                                        </td>
                                        <td><?php echo $list->phone ?></td>
                                        <td>

                                            <a href="user_profile.php?view_building_woner_profile_by_email=<?php echo $list->user_id ?>" title="View Profile" <i class=" btn btn-success far fa-eye-slash" aria-hidden="true"></i></a>
                                            <input class="user-id " type="hidden" value="<?php echo $user_id?>">
                                            <?php  $data = $datamanipulation->allUsersForActiveDeactive($user_id);

                                            if ($data->chatStatus == 'yes'){
                                                if ($list->chatStatus == 'yes'){
                                                ?>
                                            <span class="change-button-show attrValue" data-id="<?php echo $list->user_id?>" > <i class="btn btn-primary fa fa-comment-alt" aria-hidden="true"></i></span>
                                            <?php }} ?>
                                        </td>

                                    </tr>
                                    </tbody>

                                    <?php
                                }
                            }

                            ?>
                        </table>
                    </div>
                </div>
            </div>




        </section>



        <footer>

        </footer>
    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>

<script src="../../contents/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../contents/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../contents/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../contents/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../contents/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../contents/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../contents/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../contents/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>
    $(function () {
        $("#sohag1").DataTable({
            "paging": true,
            "lengthMenu":[ 3,4 ],
            "lengthChange": false,
            "searching": false,
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

<script type="text/javascript">
    $(document).ready(function () {

        $('#example2').dataTable( {
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            colReorder: {
                realtime: true,

            }
        } );

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $('.checkedNo').click(function(){
            var user_id = $(".user-id").val();
            console.log(user_id);
            var checkedNo = "";
                $.ajax({
                    type: "POST",
                    data: {checkedNo: checkedNo,user_id:user_id},
                    url: "../process/building_owner_process.php",
                    success: function (data) {
                        location.reload(true)
                    }
                });
        });
        $('.checkedYes').click(function(){
            var user_id = $(".user-id").val();
            console.log(user_id);
                var checkedYes = "";
                $.ajax({
                    type: "POST",
                    data: {checkedYes: checkedYes,user_id:user_id},
                    url: "../process/building_owner_process.php",
                    success: function () {
                        location.reload(true)
                    }
                });
        });

        bsCustomFileInput.init();
        setInterval(function () {
            var ary = [];
            $(function () {
                $('.attrTable tr').each(function (a, b) {
                    /*var name = $('.attrName', b).text();*/
                    var value = $('.attrValue', b).attr('data-id');
                    ary.push(value)

                });
                console.log(JSON.stringify(ary));


                var user_id = $(".user-id").val();
                $.ajax({
                    url: "../process/user_process.php",
                    type:'GET',
                    data:{user_type:ary,user_id:user_id},
                    success:function (result) {
                        console.log(result)
                        var datas = JSON.parse(result),
                            htmlstring = "";
                        var j = 0;
                        for (var f = 0; f<ary.length; f++) {
                            for (var i = 0; i < datas.length; i++) {

                                if ((datas[i].user_id == ary[f]) && (datas[i].message_read == 'unseen')  ) {
                                    $('.attrTable tr').each(function (a, b) {
                                        var name = $('.attrName', b).text();
                                        if($(".attrValue",b).attr('data-id')== datas[i].user_id){
                                            j=j+1;
                                            htmlstring = $(".attrValue",b).attr('data-id');

                                            $('.attrName .message-show-on-alert',b).text(j);
                                        }
                                    });

                                }
                                else if ((datas[i].opponent_id == ary[f]) && (datas[i].message == 'unseen') ) {
                                    $('.attrTable tr').each(function (a, b) {
                                        var name = $('.attrName', b).text();
                                        /!*var value = $('.attrValue', b).attr('data-id');*!/
                                        if($(".attrValue",b).attr('data-id')== datas[i].opponent_id){
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
        },1000);

        $('#chatmessages').scrollTop($('#chatmessages')[0].scrollHeight);

        $(".change-button-show").click(function () {
            var opponent_id = $(this).attr("data-id");
            var user_id = $(".user-id").val();
            setInterval(function () {
                showMessageData(user_id,opponent_id)

                $('.close-btn').click(function () {
                    opponent_id = null;
                });
            },1000)


            /*setInterval(function () {
                $.ajax(
                    {
                        url: "../process/student_data_process.php",
                        type: "POST",
                        data: {id: messageseid,mail:messagesmail},
                        success: function (response) {
                            var data = JSON.parse(response),
                                htmlstring = "";
                            for(var i=0; i<data.length; i++){

                                if((data[i].message_from)!=null){
                                    htmlstring +='<div class="chat student"> ' +
                                        '<div class="user-photo"> ' +
                                        '<img src="../../contents/img/profile_image/tuTorImoji.png" alt="User Image"> ' +
                                        '</div> ' +
                                        "<p class='chat-message teacher-msg'>"+data[i].message_from+"</p> " +
                                        '</div>';
                                }
                                if((data[i].message_to)!=null){
                                    htmlstring += '<div class="chat self">' +
                                        '<div class="user-photo"> ' +
                                        '<img src="../../contents/img/profile_image/stImoji.jpg" alt="User Image"> ' +
                                        '</div> ' +
                                        '<p class="chat-message student-msg">'+data[i].message_to+'</p> ' +
                                        '</div>';
                                }
                                $('.chatlogs').html(htmlstring);
                            }
                        }
                    });
                $('.close-btn').click(function () {
                    messagesmail=null;
                });
            },1000);*/

            $(".text-value-get").text(opponent_id);
            $(".chatbox").show();
//            $(".user-email-from-teacher-details").val(messagesid);

        });

        $('.close-btn').click(function () {
            var self = $(this);
            console.log('close');
            self.next().html('');
            location.reload(true)
        });

        $(".change-hidden").click(function () {
            $(".chatbox").css("display","none");
            $(".change-button-show").prop('disabled',false);
        });
        $("#send").click(function (event) {
            event.preventDefault();
            var messages = $("#message-value").val().trim();
            if(messages.length){
                var user_id = $(".user-id").val()
                var opponent_id = $(".text-value-get").text();

                $.ajax({
                    type: "POST",
                    data: {messages: messages,user_id:user_id,opponent_id:opponent_id},
                    url: "../process/user_process.php",
                    success: function () {
                        messages="";
                        $("#message-value").val(messages)

                        showMessageData(user_id,opponent_id);

                    }
                });
            }


        });


        function showMessageData(user_id,opponent_id) {
            $.ajax(
                {

                    url: "../process/user_process.php",
                    type: "POST",
                    data: {user_id: user_id,opponent_id:opponent_id},
                    success: function (response) {

                        var data = JSON.parse(response),
                            htmlstring = "";
                        for(var i=0; i<data.length; i++){

                            if((data[i].message_from)!=null){
                                htmlstring +='<div class="chat student"> ' +
                                    '<div class="user-photo"> ' +
                                    '<img src="../../contents/img/smart-city.jpg" alt="User Image"> ' +
                                    '</div> ' +
                                    "<p class='chat-message teacher-msg'>"+data[i].message_from+"</p> " +
                                    '</div>';
                            }
                            if((data[i].message_to)!=null){
                                htmlstring += '<div class="chat self">' +
                                    '<div class="user-photo"> ' +
                                    '<img src="../../contents/img/smart-city.jpg" alt="User Image"> ' +
                                    '</div> ' +
                                    '<p class="chat-message student-msg">'+data[i].message_to+'</p> ' +
                                    '</div>';
                            }

                            $('.chatlogs').html(htmlstring);
                        }
                    }
                });
        }





    });


</script>
</body>
</html>



