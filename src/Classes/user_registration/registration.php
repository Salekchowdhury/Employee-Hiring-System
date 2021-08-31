<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 26-Mar-20
 * Time: 7:09 AM
 */

namespace App\user_registration;
use App\Model\Database as DB;
use App\Utility\Utility;
if(!isset($_SESSION)){
    session_start();
}
$http_referrer=$_SERVER['HTTP_REFERER'];

class registration extends DB
{
   public $name, $email, $phone, $type , $password, $holding_no,$profession,$destinationFile;

    public function setPasswordData($data){

        if(array_key_exists('password',$data)){
            $this->password=$data['password'];
        }


    }

    public function setUserData($data){

        if(array_key_exists('emailToken',$data)){
            $this->emailToken=$data['emailToken'];
        }


    }
    public function updateTokenUsers($email)
    {
        $sql = "update users set email_token = 'yes' WHERE email='".$email."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }

    public function checkUserEmail($email,$code)
    {
        $sql = "select * from users WHERE email = '".$email."' && email_token = '".$code."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }
    public function setTutotEmailImage($data){
        if(array_key_exists('email',$data)){
            $this->email=$data['email'];
        }
        if(array_key_exists('destinationFile',$data)){
            $this->destinationFile=$data['destinationFile'];
        }

        /* if(array_key_exists('emailToken',$data)){
             $this->emailToken=$data['emailToken'];

         }*/
    }
    public function setData($data){
        if(array_key_exists('name',$data)){
            $this->name=$data['name'];
        }

        if(array_key_exists('email',$data)){
            $this->email=$data['email'];
        }
        if(array_key_exists('phone',$data)){
            $this->phone=$data['phone'];
        }
        if(array_key_exists('type',$data)){
            $this->type=$data['type'];
        }
        if(array_key_exists('holding_no',$data)){
            $this->holding_no=$data['holding_no'];
        }
        if(array_key_exists('profession',$data)){
            $this->profession=$data['profession'];
        }

        if(array_key_exists('password',$data)){
            $this->password=$data['password'];
        }

        if(array_key_exists('destinationFile',$data)){
            $this->destinationFile=$data['destinationFile'];
        }
       return $this;
    }



    public function insertRegisterData(){
            $dataArray=array($this->name,$this->email,$this->type,$this->holding_no,$this->profession,$this->password,$this->phone,$this->destinationFile);
            $sql="insert into users(name,email,type,holding_no,profession,password,phone,image)VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $sth=$this->Dbconnect->prepare($sql);
            $status=$sth->execute($dataArray);
            return $status;



    }
    public function insert_register_data($name,$email,$position,$phone,$password,$emailToken,$image)
    {
        $dataArray = array($name,$email,$position,$phone,$password,$emailToken,$image);
        $sql = "insert into users(name,email,type,phone,password,email_token,image)
                  VALUES ( ?, ?, ?, ?,?,?,?)";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }
    public  function updatePassword($password,$email){
        $array=array($password);
        $sql="update users set password=?, email_token='yes'  WHERE email ='".$email."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($array);
        return $status;

    }
    public  function verifyToken($code){
        $sql="select * from users WHERE  email_token='".$code."'";
        $status=$this->Dbconnect->query($sql);
        $status->setFetchMode(\PDO::FETCH_OBJ);
        $data=$status->fetch();
        return $data;
    }
    public  function emailIsExits(){
        $sql="select email from tbregistration WHERE  email='".$this->email."'";
        $status=$this->Dbconnect->query($sql);
        $status->setFetchMode(\PDO::FETCH_OBJ);
        $data=$status->fetch();
        return $data;
    }


}