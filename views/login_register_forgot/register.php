<?php
if(!isset($_SESSION)){
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Hiring System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../contents/plugins/icheck-bootstrap/icheck-boots">
    <link rel="stylesheet" href="../../contents/css/bappi.css">


    <style>

        .error{
            color: #e80000;
            display: table;
            border-collapse: collapse;
            width:100%;
            margin: 0px;
        }
        .input-group-text{
            width: 42px;
        }
        .register-box {
            width: 65%;
        }
        @media (max-width: 576px) {
            option{

                font-size: 13px;
            }


            /* body{
               font-size: 20px;
             }*/
            .register-box {
                margin-top: .5rem;
                width: 90%;
                height: 100%;
            }
        }
    </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary" style="border-top: 3px solid #00adc2; border-radius: 25px; box-shadow: 3px 3px 8px black">
        <div class="card-header text-center">
            <marquee> <a href="#" class="h1" style="font-family: Antonio"><b> </b><br>Employee Hiring System</a></marquee>

        </div>
      <div style="margin: 15px">
          <?php
          if(isset($_SESSION['isExistMsg'])){
              echo $_SESSION['isExistMsg'];
              unset($_SESSION['isExistMsg']);
          }
          ?>
      </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>
            <form autocomplete="off" id="registerForm" action="../process/data_process.php" method="post" enctype="multipart/form-data">
                <div class="row ">
                    <div class="col-md-6">
                        <div class=" input-group mb-1 ">
                            <div class="input-group-append">
                                <div class="input-group-text name-outline">
                                    <span class="fas fa-user-alt"></span>
                                </div>
                            </div>
                            <input required type="text" class="form-control" id="name" name="name" placeholder="Full name">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class=" input-group mb-1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <input required type="email" class="form-control" id="email" name="email" placeholder="Email">
                            <?php

                            ?>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-6">
                        <div class=" input-group mb-1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-bone"></span>
                                </div>
                            </div>
                            <select required class="form-control"  name="position">
                                <option value="">Select your position</option>
                                <option value="Employee">Employee</option>
                                <option value="User">User</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class=" input-group mb-1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone-alt"></span>
                                </div>
                            </div>
                            <input required type="text" class="form-control" name="phone" placeholder="Phone Number">
                        </div>

                    </div>

                </div>
                <div class="row  ">
                    <div class="col-md-6">
                        <div class=" input-group mb-1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-lock"></span>
                                </div>
                            </div>
                            <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" input-group mb-1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-image"></span>
                                </div>
                            </div>
                            <input required style="margin-left: 12px" required type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="reg_btn" style="background: #00adc2;border: #00adc2;color: #ffffff;font-weight: bold" class="btn  btn-block "><i class="fa fa-registered mr-2" aria-hidden="true"></i>Register</button>
                    </div>
                </div>
            </form>
            <a href="login.php" class="text-center">I already have a membership</a>
        </div>
    </div>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/dist/js/bappi.min.js"></script>
<script src="../../contents/plugins/moment/moment.min.js"></script>
<script src="../../contents/plugins/inputmask/jquery.inputmask.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

<script>
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy'  });
    $('[data-mask]').inputmask()

    jQuery.validator.addMethod("phonenu", function (value, element) {
        if ( /(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter a valid phone number");
    jQuery.validator.addMethod("date", function (value, element) {
        if ( /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter your date of birth");
    jQuery.validator.addMethod("email", function (value, element) {
        if ( /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter a valid email address");

    $("#registerForm").validate({
        rules:{
            name: "required",
            address: "required",
            date: {
                /* matches: "/(^(\\+88|0088)?(01){1}[3456789]{1}(\\d){8})$/",  // <-- no such method called "matches"!*/
                date: true,
                required: true

            },
            phone: {
                /* matches: "/(^(\\+88|0088)?(01){1}[3456789]{1}(\\d){8})$/",  // <-- no such method called "matches"!*/
                phonenu: true,
                required: true

            },
            profession: {
                required: true
            },
            position: {
                required: true
            },
            email:{
                required: true,
                email:true
            },
            password:{
                required: true,
                minlength:6
            },
            repass:{
                required: true,
                minlength:6,
                equalTo:"#password"
            }

        },

        messages:{
            name: "Please enter your full name ",
            address: "Please enter your present address",
            profession: {
                required: "Please select your Profession"
            },
            position: {
                required: "Please select your position"
            },
            email: {
                required: "Please write a valid email address "
            },

            password:{
                required: "Please provide a strong password",
                minlength:" Password should be above 5 characters "
            },
            phone: {
                /* matches: "/(^(\\+88|0088)?(01){1}[3456789]{1}(\\d){8})$/",  // <-- no such method called "matches"!*/

                required: "Please enter a valid phone number"

            },
            date: {
                /* matches: "/(^(\\+88|0088)?(01){1}[3456789]{1}(\\d){8})$/",  // <-- no such method called "matches"!*/

                required: "Please enter your date of birth"

            },
            repass:{
                required: "Please provide a confirm password",
                minlength:"Password should be above 5 characters ",
                equalTo:"Confirm Password Should be same to Password"
            }
        }
    });


</script>
</body>
</html>
