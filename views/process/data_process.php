<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 9/3/2020
 * Time: 2:52 PM
 */
include_once ("../../vendor/autoload.php");
include_once ("../../vendor/phpmailer/phpmailer/src/PHPMailer.php");

use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer( true);

$authenticate =new authentication();
$registration =new registration();
if(!isset($_SESSION)){
    session_start();
}


if(isset($_POST['signIn'])){

    $email=$_POST['email'];
    $password=$_POST['password'];
    $CheckEmail = $authenticate->checkEmail($email);
    $pass =$CheckEmail->password;
    if($pass!=$password){
        $http_reffer= $_SERVER['HTTP_REFERER'];
        $_SESSION['errorMessageForLogin']="<div class='alert alert-danger'> Wrong Password.. Please Try Agin!</div>";
        Utility::redirect("$http_reffer");
    }
   // var_dump($CheckEmail);
    if($CheckEmail){
        $authenticate->setSignInData($_POST);
        //$checkAccount = $authenticate->checkAccount();
        $checkAccount = $authenticate->authenticate();
        //var_dump($checkAccount);
        $user='User';
        $B_owner='Employee';
        $Admin='Admin';

        $_SESSION['user_id']=$checkAccount->user_id;
        $type="$checkAccount->type";

        if($checkAccount){

            if($type==$user){
                $_SESSION['user_id']=$checkAccount->user_id;
                $_SESSION['email']=$checkAccount->email;
                $_SESSION['name']=$checkAccount->name;
                utility::redirect("../../views/Users/home.php");

            }
            elseif ($type==$B_owner){
                $_SESSION['user_id']=$checkAccount->user_id;
                $_SESSION['email']=$checkAccount->email;
                $_SESSION['name']=$checkAccount->name;
                utility::redirect("../../views/employee/home.php");
            }
            elseif ($type==$Admin){
                $_SESSION['user_id']=$checkAccount->user_id;
                $_SESSION['email']=$checkAccount->email;
                $_SESSION['name']=$checkAccount->name;
                utility::redirect("../../views/Admin/profile.php");

            }

        }else{
            /*$http_reffer= $_SERVER['HTTP_REFERER'];
            $_SESSION['errorMessageForLogin']="<div class='alert alert-danger'>Your Emai, Password Or User Type is Wrong.. Please Try Agin!</div>";
            Utility::redirect("$http_reffer");*/
        }
    }else{
        $http_reffer= $_SERVER['HTTP_REFERER'];
             $_SESSION['errorMessageForLogin']="<div class='alert alert-danger'> Threr have no account for this email.. Please Try Agin!</div>";
             Utility::redirect("$http_reffer");
     }





 }
if(isset($_POST['change_user_pass'])){
    $email = $_SESSION['email'];
    $password=$_POST['password'];
    $repass=$_POST['repass'];
    if($password==$repass){

        $status = $registration->updatePassword($password,$email);
        if($status){
            Utility::redirect("../../views/login_register_forgot/login.php");
            //include_once ("../../views/login_register_forgot/login.php");
        }

    }else{
        $http_reffer= $_SERVER['HTTP_REFERER'];
        $_SESSION['errorMessageForForgotPass']="<div class='alert alert-danger'>Not match password and Re-type password!</div>";
        Utility::redirect("$http_reffer");
    }

}

 if(isset($_POST['Register'])){

     $name = $_POST["name"];
     $email= $_POST["email"];
     $type = $_POST["type"];
     $holding_no = $_POST["holding_no"];
     $profession = $_POST["profession"];
     $phone = $_POST["phone"];
     $password = $_POST["password"];
     $repass = $_POST["repass"];




                         $files = $_FILES['image'];
                         $fileName = $files['name'];
                         $fileTmpName = $files['tmp_name'];
                        // $destinationFile = '../../contents/img/profile_image/' . date('d_m_Y_h_i_s_') . $fileName;
                         $destinationFile =  '../../contents/img/profile_image/'.date('d_m_Y_h_i_s_') . $fileName;
                         move_uploaded_file($fileTmpName, $destinationFile);
                         $_POST['destinationFile'] = $destinationFile;
                 if($password==$repass){
                     $data = $registration->setData($_POST);
                     var_dump($data);
                     if($data){
                         $registration->insertRegisterData();
                         var_dump($data);
                         Utility::redirect("../../views/login_register_forgot/login.php");
                     }/*else{
                         $http_reffer = $_SERVER['HTTP_REFERER'];
                         $_SESSION['errorPassword'] = "<div class='alert alert-danger'>Something Wrong! Please Try Agin!</div>";
                         Utility::redirect("$http_reffer");
                     }*/
                }else{
                    $http_reffer = $_SERVER['HTTP_REFERER'];
                    $_SESSION['errorPassword'] = "<div class='alert alert-danger'>Not match password and Retype password... Please Try Agin!</div>";
                    Utility::redirect("$http_reffer");
                }

                      /*  $registerEmail = $registration->emailIsExits();
                        if ($registerEmail) {
                            $http_reffer = $_SERVER['HTTP_REFERER'];
                            $_SESSION['errorMessageRegister'] = "<div class='alert alert-danger'>Already Exits it,s Email.. Please Try Agin!</div>";
                            Utility::redirect("$http_reffer");

                        }*/


}

if(isset($_POST['reg_btn'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    var_dump($_POST);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['name'] = $_POST['name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];



    $emailToken = rand(100000, 999999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/profile_image/' . $emailToken . $fileName;
    move_uploaded_file($fileTmpName, $image);

    $_POST['emailToken'] = $emailToken;

    $checkEmail=$datamanipulation->checkEmail($email);
    if($checkEmail){
        $_SESSION["isExistMsg"] = "<div style='background-color: #218838' class=\"alert alert-success alert-dismissible fade show\">
                 <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                   <i class=\"fa fa-times\"></i>
                 </button>
                 <span style='color: white'>
                   <b>  Hi $name - </b> This Email Already Exists.. </span>
               </div>";
        Utility::redirect("$http_reffer");
    }else{
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'employeehiringsystem@gmail.com';                     // SMTP username
            $mail->Password   = 'employeesohag';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('employeehiringsystem@gmail.com', 'Employee Hiring System');
            $mail->addAddress("$email", 'User');     // Add a recipient
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('employeehiringsystem@gmail.com', 'confirmation code');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Confirmation Code';
            $mail->Body    = "$emailToken";
            $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

            if($mail->send()){
                $insert = $registration->insert_register_data($name,$email,$position,$phone,$password,$emailToken,$image);
                if ($insert){
                    /* $_SESSION["isExistMsg"] = "<div style='background-color: #218838' class=\"alert alert-success alert-dismissible fade show\">
                       <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                         <i class=\"fa fa-times\"></i>
                       </button>
                       <span style='color: white'>
                         <b>  Hi $name - </b> Your Registration Successfully. </span>
                     </div>";*/
                    Utility::redirect("../login_register_forgot/verification.php");

                }


            }

        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            //echo 'Message has been sent';
        }
    }




}

if (isset($_POST['confirm'])){
    $http = $_SERVER["HTTP_REFERER"];
    $email=$_POST['email'];
    $code=$_POST['code'];
    $userData = $registration->checkUserEmail($email,$code);



    if($userData){
        $data = $registration->updateTokenUsers($email);

        if ($data)
        {
            Utility::redirect("../login_register_forgot/login.php");

        }
    }else{
        $_SESSION["notMatchMemberID"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Warning - </b> Token Id not Matched. Please try again. </span>
                        </div>";
        Utility::redirect("$http");
    }

}
function validate($data){
    $data  = trim($data);
    $data  = stripcslashes($data);
    $data  = htmlspecialchars($data);
    return $data;
}