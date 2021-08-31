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
if(isset($_POST['edit_notice'])) {
    $id = $_POST['id'];
    $notice = $_POST['notice'];
    $status = $datamanipulation->updateNotice($id, $notice);
    if ($status) {
        Utility::redirect("../../views/employee/notice.php");
    }
}
if(isset($_GET['delete_notice'])){

    $status = $datamanipulation->deleteNotice($_GET['delete_notice']);
    if($status){
        Utility::redirect("../../views/employee/notice.php");

    }

}

if(isset($_GET['confirm_user_by_building_woner'])){
    $action='yes';
    $status = $datamanipulation->confirm_user_by_building_woner($_GET['confirm_user_by_building_woner'],$action);
    if($status){
        Utility::redirect("../../views/employee/pending_request.php");


    }

}
if(isset($_GET['confirm_user_by_building_woner_from_member_list'])){
    $action='yes';
    $status = $datamanipulation->confirm_user_by_building_woner($_GET['confirm_user_by_building_woner_from_member_list'],$action);
    if($status){
        Utility::redirect("../../views/employee/user.php");


    }

}

if(isset($_POST['update'] )){
    $http= $_SERVER['HTTP_REFERER'];
    $update = $datamanipulation->updateUserData($_POST['user_id'],$_POST['name'],$_POST['profession'],$_POST['phone'],$_POST['road_no'],$_POST['holding_no'],$_POST['owner_name'],$_POST['building_name'],$_POST['address'],$_POST['bio']);
    var_dump($update);
    if($update){
        $_SESSION["UdateMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Updated - </b> Update Your Data Successfully. </span>
                        </div>";
        Utility::redirect("$http");
    }
}

    if (isset($_POST['uploadImage'])) {
        $email = $_POST['email'];

        if (!empty($_FILES['profileImage']['name'])) {
            $files = $_FILES['profileImage'];
            $fileName = $files['name'];
            $fileTmpName = $files['tmp_name'];

            $destinationFile = '../../contents/img/profile_image/' . date('d_m_Y_h_i_s_') . $fileName;
            move_uploaded_file($fileTmpName, $destinationFile);
            //$_POST['destinationFile']=$destinationFile ;
            $data = $datamanipulation->ChangeUserProfile($destinationFile, $email);
            if ($data) {
                Utility::redirect("../../views/Users/change_profile.php");


            }
        } else {
            $http_reffer = $_SERVER['HTTP_REFERER'];
            $_SESSION['EmptyFile'] = "<div class='alert alert-danger ' style=' width: 44%;'>please choose your image file</div>";
            Utility::redirect("$http_reffer");
        }

    }


if (isset($_POST['checkedNo'])){
        $checkedNo = $datamanipulation->updateChatActiveNo($_POST['user_id']);
        return $checkedNo;
}
if (isset($_POST['checkedYes'])){
    $checkedYes = $datamanipulation->updateChatActiveYes($_POST['user_id']);
}

if(isset($_POST['old_pass'] )){
    $id = $_POST['user_id'];
    $data = $datamanipulation->userPassword($id);
    echo json_encode($data);
}

