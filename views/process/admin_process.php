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

;

if(isset($_GET['logout'])){
    session_destroy();
    Utility::redirect("../../views/login_register_forgot/login.php");
    //include_once ("../../views/login_register_forgot/login.php");
}
if(isset($_POST['uploadImage'])){
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
            Utility::redirect("../../views/Admin/change_profile.php");


        }
    }
    else{
        $http_reffer= $_SERVER['HTTP_REFERER'];
        $_SESSION['EmptyFile']="<div class='alert alert-danger ' style=' width: 44%;'>please choose your image file</div>";
        Utility::redirect("$http_reffer");
    }

}
if(isset($_GET['delete_service'])){
   $id = $_GET['delete_service'];
   $status = $datamanipulation->deleteEmergencyCell($_GET['delete_service']);
   if($status){
       Utility::redirect("../../views/Admin/emergency_cel.php");
   }

}
if(isset($_GET['delete_notice'])){

   $status = $datamanipulation->deleteNotice($_GET['delete_notice']);
   if($status){
       Utility::redirect("../../views/Admin/notice.php");

   }

}
if(isset($_POST['submit'])){
   $phone= $_POST['phone'];
   $service_name= $_POST['service_name'];
    $status = $datamanipulation->insertEmergencyCell($phone,$service_name);
    if($status){
        Utility::redirect("../../views/Admin/emergency_cel.php");
    }


    //include_once ("../../views/Admin/emergency_cel.php");
}

if(isset($_GET['confirm_building_woner'])){
    $action='yes';
    $status = $datamanipulation->confirm_building_woner($_GET['confirm_building_woner'],$action);
    if($status){
        Utility::redirect("../../views/Admin/pending_approval.php");


    }

}
if(isset($_GET['confirm_building_woner_from_all_building_owner'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $action='yes';
    $status = $datamanipulation->confirm_building_woner($_GET['confirm_building_woner_from_all_building_owner'],$action);
    if($status){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Confim - </b> Confirm Data Successfully</span>
                         </div>";

        Utility::redirect("$http_reffer");


    }

}

if(isset($_GET['delete_building_owner'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $status = $datamanipulation->Move_to_trash_employee_acount($_GET['delete_building_owner']);

    if($status){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Moved - </b> Data Move to Trash History.</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }

}

if(isset($_POST['add_employee'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];

    $name =$_POST['name'];
    $profession =$_POST['profession'];
    $building_name =$_POST['building_name'];
    $owner_name =$_POST['owner_name'];
    $holding_no =$_POST['holding_no'];
    $road_no =$_POST['road_no'];
    $bio =$_POST['bio'];
    $address =$_POST['address'];
    $phone =$_POST['phone'];
    $work =$_POST['work'];
    $type="Employee";
    $action="yes";

   $random= rand(1000,9999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $status = "Leave";
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/profile_image/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);



    $status = $datamanipulation->insert_new_employee($name,$profession,$building_name,$owner_name,$holding_no,$road_no,$address,$bio,$phone,$work,$type,$action,$image);

    if($status){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Insert New Employee Data....</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }

}
if(isset($_POST['add_admin'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];

    $name =$_POST['name'];
    $phone =$_POST['phone'];
    $profession =$_POST['profession'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $bio =$_POST['bio'];
    $type ="Admin";


   $random= rand(1000,9999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $status = "Leave";
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/profile_image/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);

     $checkEmail=$datamanipulation->checkEmail($email);
     if(!$checkEmail){

         $status = $datamanipulation->insert_new_admin($name,$type,$profession,$email,$bio,$phone,$password,$image);

         if($status){
             $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Add new admin data....</span>
                         </div>";

             Utility::redirect( "$http_reffer");
         }
     }else{
         $_SESSION["ExistMsg"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Sorry! - </b> $email Already Exists</span>
                         </div>";

         Utility::redirect( "$http_reffer");
     }


}
if(isset($_GET['move_user_owner'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $status = $datamanipulation->Move_to_trash_user_acount($_GET['move_user_owner']);

    if($status){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Moved - </b> Data Move to Trash History.</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }

}
if(isset($_GET['delete_admin_id'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $status = $datamanipulation->delete_admin($_GET['delete_admin_id']);

    if($status){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                               <b> Deleted - </b> Delete Data Successfully.</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }

}

if(isset($_GET['recovery_id'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $status = $datamanipulation->recovery_data($_GET['recovery_id']);

    if($status){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Recovered - </b> Recovery Data Successfully.</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }

}


if(isset($_GET['logout'])){
    session_destroy();
    Utility::redirect("../../views/login_register_forgot/login.php");
    //include_once ("../../views/login_register_forgot/login.php");
}
if(isset($_POST['update'] )){

    $update = $datamanipulation->updateUserAdminDatazz($_POST['user_id'],$_POST['name'],$_POST['phone'],$_POST['profession'],$_POST['road_no'],$_POST['bio']);

    if($update){
        $_SESSION["updatetMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Update - </b> Update Data Successfully.</span>
                         </div>";

        Utility::redirect( "../../views/Admin/change_profile.php");
    }
}
if(isset($_POST['submit_post'] )){
    $inset = $datamanipulation->insertPostData($_POST['post'],$_POST['user_id'],$_POST['email'],$_POST['name']);
    if($inset){
        header("Location: ../Admin/home.php");
    }
}
if(isset($_POST['post'])) {
    $notice = $_POST['notice'];
    $status = $datamanipulation->insertNotice($notice);
    if ($status) {
        Utility::redirect("../../views/Admin/notice.php");
    }
}
    if(isset($_POST['edit_notice'])){
    $id = $_POST['id'];
    $notice = $_POST['notice'];
    $status = $datamanipulation->updateNotice($id,$notice);
    if($status){
        Utility::redirect("../../views/Admin/notice.php");
    }



    //include_once ("../../views/Admin/emergency_cel.php");
}
if(isset($_POST['edit_emergency_cell'])){
   $phone= $_POST['phone'];
   $service_name= $_POST['service_name'];
   $id= $_POST['id'];
    $status = $datamanipulation->EditEmergencyCell($phone,$service_name,$id);
    if($status){
        Utility::redirect("../../views/Admin/emergency_cel.php");
    }


    //include_once ("../../views/Admin/emergency_cel.php");
}

