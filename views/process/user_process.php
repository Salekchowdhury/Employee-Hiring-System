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

$authenticate =new authentication();
$registration =new registration();
if(!isset($_SESSION)){
    session_start();

}
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
/*$name=$data->name;
$image=$data->image;
$profession=$data->profession;
$phone=$data->phone;
$holding_no=$data->holding_no;
$bio=$data->bio;
$owner_name= $ownerData->owner_name;
$building_name= $ownerData->building_name;
$road_no= $ownerData->road_no;
$bio= $ownerData->bio;*/

if(isset($_GET['logout'])){
    session_destroy();
    Utility::redirect("../../views/login_register_forgot/login.php");
    //include_once ("../../views/login_register_forgot/login.php");
}

if(isset($_GET['hire_employee_id'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $employeeData=$datamanipulation->showUserProfile($_GET['hire_employee_id']);
    $employee_id=$employeeData->user_id;
    $employee_phone=$employeeData->phone;
    $employee_name=$employeeData->name;
    $work=$employeeData->work;


    var_dump($user_id);

    $userData=$datamanipulation->showUserProfile($user_id);
    $user_id=$userData->user_id;
    $user_phone=$userData->phone;
    $user_name=$userData->name;
    $user_email=$userData->email;

    $insertBookingData =$datamanipulation->insertBookingData($user_id,$user_name,$user_phone,$user_email,$employee_id,$employee_phone,$employee_name,$work);
if($insertBookingData){
    $_SESSION["updateMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Success - </b> Insert Data Successfully </span>
                        </div>";
   Utility::redirect("$http_reffer");
}




}


if(isset($_POST['uploadImage'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $email= $_POST['email'];

if(!empty($_FILES['profileImage']['name'])){
        $files = $_FILES['profileImage'];
        $fileName = $files['name'];
        $fileTmpName = $files['tmp_name'];

        $destinationFile ='../../contents/img/profile_image/'.date('d_m_Y_h_i_s_').$fileName;
        move_uploaded_file($fileTmpName,$destinationFile);
        //$_POST['destinationFile']=$destinationFile ;
        $data=$datamanipulation->ChangeUserProfile($destinationFile,$email);
        if($data){
            Utility::redirect($http_reffer);


        }
    }
    else{
        $http_reffer= $_SERVER['HTTP_REFERER'];
        $_SESSION['EmptyFile']="<div class='alert alert-danger ' style=' width: 44%;'>please choose your image file</div>";
        Utility::redirect("$http_reffer");
    }

}

if(isset($_POST['update'] )){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $update = $datamanipulation->updateUserData($_POST['user_id'],$_POST['name'],$_POST['profession'],$_POST['phone'],$_POST['road_no'],$_POST['holding_no'],$_POST['building_name'],$_POST['owner_name'],$_POST['bio']);
    var_dump($update);
    if($update){


        $_SESSION["updateMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Update - </b> Update Data Successfully </span>
                        </div>";

        Utility::redirect("$http_reffer");
    }
}

if(isset($_POST['post'] )){
   $inset = $datamanipulation->insertPostData($_POST['post'],$_POST['user_id'],$_POST['email'],$_POST['name']);
   if($inset){
       header("Location: ../Users/home.php");
   }
}
if(isset($_POST['updatePassword'] )){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $user_id=$_POST['user_id'];
    $old_password =$_POST['old_password'];
    $new_password =$_POST['new_password'];
    $confirm_password =$_POST['confirm_password'];


    $userData =$datamanipulation->showUserProfile($user_id);
    $oldPass=$userData->passwor;
    if($oldPass!=$old_password){

        $_SESSION["updateMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Sorry! - </b> Old Password is Wrong </span>
                        </div>";
        Utility::redirect("$http_reffer");

    }else if ($new_password!=$confirm_password){

        $_SESSION["updateMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Sorry! - </b> New Password and Confirm Password Not Match.. </span>
                        </div>";
        Utility::redirect("$http_reffer");
    }else if ($new_password==$confirm_password && $oldPass==$old_password ){

        $changePass =$datamanipulation->updateUserPassword($user_id,$new_password);
        if($changePass){
            $_SESSION["updateMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Update! - </b> Change Your Password Successfully </span>
                        </div>";
            Utility::redirect("$http_reffer");
        }


    }


   $inset = $datamanipulation->insertPostData($_POST['post'],$_POST['user_id'],$_POST['email'],$_POST['name']);
   if($inset){
       header("Location: ../Users/home.php");
   }
}
if (isset($_GET['booking_history_delete_id'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $data =$datamanipulation->deleteBookingData($_GET['booking_history_delete_id']);

    if($data){
        $_SESSION["updateMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Deleted! - </b> Delete Data Successfully </span>
                        </div>";
        Utility::redirect("$http_reffer");
    }





}
if(isset($_POST['show'] )){
    $data = $datamanipulation->ShowPostData();
    echo json_encode($data);
}

if(isset($_POST['showComments'] )){
    $data = $datamanipulation->ShowCommentData();
    echo json_encode($data);
}
if(isset($_POST['showCommentss'] )){
    $data = $datamanipulation->ShowCommentData();

    echo json_encode($data);
}
if(isset($_POST['parent_id'] )){
    $datamanipulation->insertCoomentData($_POST['messages'],$_POST['user_id'],$_POST['parent_id'],$_POST['name'],$_POST['email']);
}
if(isset($_POST['btn_change'] )){
    $datamanipulation->setupdatepass($_POST['re_pass']);
    $datamanipulation->updateUserPassword($_POST['user_id'],$_POST['re_pass']);

}
if(isset($_POST['old_pass'] )){
    $id = $_POST['user_id'];
    $data = $datamanipulation->userPassword($id);
    echo json_encode($data);
}
if(isset($_POST['messages'] )&& isset($_POST['user_id'] ) && isset($_POST['opponent_id'] )){


     $datamanipulation->insertMessages($_POST['messages'],$_POST['user_id'],$_POST['opponent_id']);

}
if(isset($_POST['user_id'] ) && isset($_POST['opponent_id'] )){


   $message =  $datamanipulation->showMessage($_POST['user_id'],$_POST['opponent_id']);
    echo json_encode($message);

}

if (isset($_GET['user_type'])){
     $take = $_GET['user_type'];
     $array;


        $data = $datamanipulation->showAlertonMessageforAllUsers($_GET['user_id'] );

        echo json_encode($data);

}
if (isset($_POST['noticeInfo'])){
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $textarea = $_POST['noticeInfo'];
    $image = "null";
    $datamanipulation->textareaPostSave($user_id,$user_name,$textarea,$image);

}
if (isset($_GET['getData']))
{
    $data = $datamanipulation->getPostDataToShow();
    echo json_encode($data);
}
if (isset($_POST['commentValue'])){
    $commentNo = $_POST['commentNo'];
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $commentValue = $_POST['commentValue'];
    $data = $datamanipulation->insertComment($user_id,$user_name,$commentValue,$commentNo);

}


if (isset($_GET['managePostDelete'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['managePostDelete'];
    $managePostDelete = $datamanipulation->managePostDelete($id);
    if ($managePostDelete){
        $_SESSION['TostUpdate'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Delete post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['postDataCollect'])){

    $user_id = $_POST['value'];
    $data = $datamanipulation->postDataCollectviaUserIds($user_id);
    echo json_encode($data);
}
if (isset($_POST['btn-save-changes'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_id = $_POST['user_no_from'];
    $user_update_post = $_POST['updatePostDataSection'];
    $data = $datamanipulation->postUpdateDataCollectviaUserId($user_id,$user_update_post);
    if ($data){
        $_SESSION['TostUpdate'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-success\" aria-live=\"polite\" style=\"\"><div class=\"toast-message\">Update your post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_POST['btn_change'] )){
    $datamanipulation->setupdatepass($_POST['re_pass']);
    $datamanipulation->updateUserPassword($_POST['user_id'],$_POST['re_pass']);

}
