<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
include_once ("../../vendor/phpmailer/phpmailer/src/PHPMailer.php");
use App\DataManipulation\DataManipulation;
use App\user_registration\registration;

$datamanipulation =new DataManipulation();
$registration =new registration();

use PHPMailer\PHPMailer\PHPMailer;
use App\Utility\Utilit;
$mail = new PHPMailer( true);
$datamanipulation =new DataManipulation();


if(isset($_POST['message_send_by_employee'])){
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    $userEmail=$_SESSION['email'];

    $viewBuldingWonerDataforSendEmail=$datamanipulation->viewBuldingWonerDataforSendEmail($userEmail);
    if($viewBuldingWonerDataforSendEmail){
        $name="$viewBuldingWonerDataforSendEmail->name";
        $phone="$viewBuldingWonerDataforSendEmail->phone";
        $userType="$viewBuldingWonerDataforSendEmail->type";
        $phone= $viewBuldingWonerDataforSendEmail->phone;
    }



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
        $mail->addAddress('employeehiringsystem@gmail.com', 'User');     // Add a recipient
        $mail->addReplyTo($userEmail, 'Information');

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "<p>Me $name , I am a <b>$userType</b>. my contact number is <b>$phone</b> and email <b>$BuldingWonerEmail</b>  </p>
                            
                               <table>
                              <tr><th>Message</th></tr>
                              <tr><td>$message</td></tr>
                              </table>";
        $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

        if($mail->send()){
           $http_reffer= $_SERVER['HTTP_REFERER'];
            $_SESSION['SendMessage']="<div class='alert alert-success' style='font-size: 26px;padding-left: 427px;'>Your message sent successfully </div>";
            $_SESSION["SendMessage"] = "<div style='background-color: #218838' class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span style='color: white'>
                            <b> Success - </b> Your message sent to admin. </span>
                        </div>";

            \App\Utility\Utility::redirect("$http_reffer");


        }

    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }



}
if(isset($_POST['message_send_to_user'])){
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    $name=$_POST['confirmerName'];
    $userEmail=$_POST['confirmerEmail'];
    //var_dump($_POST);




   /* $viewBuldingWonerDataforSendEmail=$datamanipulation->viewBuldingWonerDataforSendEmail($userEmail);
    //var_dump($studentDataforSendEmail);
    if($viewBuldingWonerDataforSendEmail){
        $name="$viewBuldingWonerDataforSendEmail->name";
        $phone="$viewBuldingWonerDataforSendEmail->phone";
        $userType="$viewBuldingWonerDataforSendEmail->type";
        $phone= $viewBuldingWonerDataforSendEmail->phone;
    }*/



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
        $mail->addAddress($userEmail, 'User');     // Add a recipient
        $mail->addReplyTo('employeehiringsystem@gmail.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
                           
                               <table>
                              <tr><th>Message</th></tr>
                              <tr><td>$message</td></tr>
                              </table>";
        $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

        if($mail->send()){
           $http_reffer= $_SERVER['HTTP_REFERER'];
            $_SESSION['SendMessage']="<div class='alert alert-success' style='font-size: 26px;padding-left: 427px;'>Your message sent successfully </div>";
            $_SESSION["SendMessage"] = "<div style='background-color: #218838' class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span style='color: white'>
                            <b> Success - </b> Your message sent to $name. </span>
                        </div>";

            \App\Utility\Utility::redirect("$http_reffer");
           // Utility::redirect("$http_reffer");

            /* utility::redirect("view_List.php");
             include_once ("../../views/teacher/post-board.php");*/

        }

    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //echo 'Message has been sent';
    }



}


if(isset($_POST['forgotPassword'])){
    $_SESSION['email']=$_POST['email'];
    $receiver=$_POST['email'];
    $emailToken = rand(100000, 999999);
    $_POST['emailToken'] = $emailToken;

    $checkEmail=$datamanipulation->checkEmail($receiver);
    //$tutorDataforSendEmail=$datamanipulation->viewtutorDataforSendEmail($tutorEmail);
    if($checkEmail){
        /*$name="$tutorDataforSendEmail->name";
        $phone="$tutorDataforSendEmail->phone";
        $phone= "0".$phone;*/



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
            $mail->addAddress("$receiver", 'User');     // Add a recipient
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('employeehiringsystem@gmail.com', 'confirmation code');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Change password';
            $mail->Body    = "$emailToken";
            $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

            if($mail->send()){
                //$registration->setUserData($_POST);
                $status=$datamanipulation->updateRegisterToken($emailToken, $receiver);
                var_dump($status);
                if($status){
                    \App\Utility\Utility::redirect('../../views/login_register_forgot/verification_forgot_password.php');
                   // Utility::redirect('../../views/login_register_forgot/verification_forgot_password.php');
                    //include_once ("../../views/login_register_forgot/verification_forgot_password.php");
                }


                /* utility::redirect("view_List.php");
                 include_once ("../../views/teacher/post-board.php");*/

            }

        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            //echo 'Message has been sent';
        }



    }
    else{
        $http_reffer= $_SERVER['HTTP_REFERER'];
        $_SESSION['SendMessage']="<div class='alert alert-danger' >Wrong Email id.Please try again </div>";
        \App\Utility\Utility::redirect("$http_reffer");
    }

}

