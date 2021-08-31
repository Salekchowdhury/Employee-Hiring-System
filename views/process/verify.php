<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 26-Sep-19
 * Time: 4:59 PM
 */

include_once ("../../vendor/autoload.php");
use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();

if(!isset($_SESSION)){
    session_start();
}
$email=$_SESSION['email'];

 $registration=new registration();
 if(isset($_POST['confirm'])){
     $status=$registration->verify($_POST['code']);
     if($status){
         utility::redirect("../../views/login_register_forgot/login.php");
         //include_once ("");
     }else{

         $http_referer=$_SERVER['HTTP_REFERER'];
         $_SESSION['errorMesseage']="<div class='alert alert-danger'>Wrong Code, Try again..</div>";
         utility::redirect($http_referer);
     }
 }

if(isset($_POST['confirm_forgot_password'])){
    $status=$registration->verifyToken($_POST['code']);
    if($status){
        utility::redirect("../../views/login_register_forgot/change_password.php");
        //include_once ("../../views/login_register_forgot/change_password.php");
    }else{

        $http_referer=$_SERVER['HTTP_REFERER'];
        $_SESSION['errorMesseage']="<div class='alert alert-danger'>Wrong Code, Try again..</div>";
        utility::redirect($http_referer);
    }
}
if(isset($_POST['old_pass'] )){
    $id = $_POST['user_id'];
    $data = $datamanipulation->userPassword($id);
    echo json_encode($data);
}