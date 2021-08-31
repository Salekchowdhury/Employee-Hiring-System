<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 22-Mar-20
 * Time: 4:52 AM
 */

namespace App\DataManipulation;
use App\Model\Database as DB;
use  App\Utility\Utility;



class DataManipulation extends DB
{
    public $password;

    public function setupdatepass($data)
    {
        if (array_key_exists('re_pass', $data)) {
            $this->password = $data['re_pass'];
        }
    }


    public function Search($data)
    {
        $sql = "SELECT content FROM post WHERE content LIKE '%$data%'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }

    public function deleteEmergencyCell($id)
    {
        $sql=" delete from emergency_cell WHERE id ='".$id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }


    public function deleteNotice($id)
    {
        $sql=" delete from notice WHERE id ='".$id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function checkEmail($email)
    {
        $sql = "SELECT * from users WHERE email='".$email."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showAllAdmin()
    {
        $sql = "SELECT * from users WHERE type='Admin'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function viewEmergencyCell($id)
    {
        $sql = "select * from emergency_cell where id = '" . $id . "'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }

    public function showUserProfile($id)
    {
        $sql = "select * from users where user_id = '" . $id . "'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }

    public function showOwnerData($holding_no)
    {
        $sql = "select * from users where holding_no = '".$holding_no."' && type='employee'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }

    public function chatUserDetailsShowOnTable()
    {
        $sql = "select * from users where type = 'User'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }

    public function ShowPostData()
    {
        $sql = "SELECT * FROM post ORDER BY id DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }

    public function ShowCommentData()
    {
        $sql = "SELECT * FROM comment";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }

    public function ShowCommentDatabyId($id)
    {
        $sql = "SELECT * FROM comment WHERE comment_id = '" . $id . "'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function showAllEmployee()
    {
        $sql = "SELECT * FROM users WHERE type='Employee' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function updateRegisterToken($emailToken, $email)
    {
        $array = array($emailToken);
        $sql = "update  users set email_token=? WHERE email='$email'";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public function getPostDataToShow(){
        $sql = "SELECT * FROM post ORDER BY no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function insertComment($user_id,$name,$post,$commentNo){
        $dataArray=array($user_id,$name,$post,$commentNo);
        $sql="insert into post(user_id,name,post,date,time,commentNo)VALUES (?,?,?,now(),now(),?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function Move_to_trash_employee_acount($id)
    {
        $sql = "update users set action ='delete' WHERE user_id ='".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
     public function Move_to_trash_user_acount($id)
    {
        $sql = "update users set action ='delete' WHERE user_id ='".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function textareaPostSave($user_id,$name,$post,$image){
        $dataArray=array($user_id,$name,$post,$image);
        $sql="insert into post(user_id,name,post,image,date,time)VALUES (?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function updateUserPassword($user_id, $re_pass)
    {
        $array = array($re_pass);
        $sql = "update  users set password=? WHERE user_id='".$user_id."'";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public function EditEmergencyCell($phone, $name,$id)
    {
        $array = array($phone,$name);
        $sql = "update  emergency_cell set phone=?,service_name=? WHERE id='".$id."'";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public function ShowEmployeeList()
    {
        $sql = "SELECT * FROM users WHERE email is not NULL && type = 'Employee'  ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function userPassword($user_id)
    {
        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }

    public function allUsers($id)
    {
        $sql = "SELECT * FROM users WHERE type='Employee' && user_id !='" . $id . "'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function insertMessageForChatSellers($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message){
        $data=array($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);
        $sql="insert into chat(user_id,employee_id,user_name,employee_name,message_to,date,time)VALUES (?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($data);
        $update = "update chat set message = 'seen' where user_id = '".$buyers_id."' &&  employee_id = '".$sellers_id."'";
        $this->Dbconnect->exec($update);
        return $status;
    }
    public function showAlertonMessage($sellers_id){
        $message = "unseen";
        $sql = "select user_id, message from chat where  employee_id = '".$sellers_id."' &&  message='".$message."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();

        return $status;
    }
    public function viewSellerBuyersTotalInfoS($buyers_id,$sellers_id){
        $sql = "SELECT * FROM chat where user_id = '".$buyers_id."' &&  employee_id = '".$sellers_id."' ORDER BY no DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        $update = "update chat set message = 'seen' where user_id = '".$buyers_id."' &&  employee_id = '".$sellers_id."'";
        $this->Dbconnect->exec($update);

        return $satatus;
    }
    public function viewAllUserTOWork()
    {
        $sql = "SELECT * FROM users WHERE type='User' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function insertMessageForChat($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message){
        $dataArray=array($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);
        $sql="insert into chat(user_id,employee_id,user_name,employee_name,message_from,date,time)VALUES (?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        $update = "update chat set messageRead = 'seen' where user_id = '".$buyers_id."' &&  employee_id = '".$sellers_id."'";
        $this->Dbconnect->exec($update);
        return $status;
    }
    public function showAlertonMessageforbuyers($id){
        $message = "unseen";
        $sql = "select employee_id, messageRead from chat where user_id = '".$id."' && messageRead='".$message."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();

        return $status;
    }
    public function viewSellerBuyersTotalInfo($buyers_id,$sellers_id){
        $sql = "SELECT * FROM chat where user_id = '".$buyers_id."' &&  employee_id = '".$sellers_id."' ORDER BY no DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        $updates = "update chat set messageRead = 'seen' where user_id = '".$buyers_id."' &&  employee_id = '".$sellers_id."'";
        $this->Dbconnect->exec($updates);

        return $satatus;
    }
    public function ShowAllBookingHistory()
    {
        $sql = "SELECT * FROM confim_history ORDER BY date DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }

    public function showAlertonMessageforAllUsers($id)
    {

        $sql = "SELECT * FROM chat WHERE user_id='" . $id . "' || opponent_id='" . $id . "' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatuss = $data->fetchAll();

        return $satatuss;
        /*if ($satatuss){
            $sql = "select opponent_id, message from chat where opponent_id ='".$id2."'  && user_id ='".$id."' && message='unseen'";
            $data = $this->Dbconnect->query($sql);
            $data->setFetchMode(\PDO::FETCH_OBJ);
            $status = $data->fetchAll();

            return $status;
        }
        else{

            $sql = "select user_id, message_read from chat where user_id ='".$id2."' && opponent_id ='".$id."' && message_read='unseen'";
            $data = $this->Dbconnect->query($sql);
            $data->setFetchMode(\PDO::FETCH_OBJ);
            $status = $data->fetchAll();

            return $status;
        }*/


    }

    public function showMessage($id, $opponent_id)
    {

        $temp = $opponent_id;
        $temp2 = $id;
        $sql = "SELECT parent_id FROM chat WHERE parent_id=0 && user_id='" . $id . "' && opponent_id='" . $opponent_id . "'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        if ($satatus) {
            $sql = "SELECT * FROM chat WHERE user_id='" . $id . "' && opponent_id='" . $opponent_id . "'";
            $data = $this->Dbconnect->query($sql);
            $data->setFetchMode(\PDO::FETCH_OBJ);
            $satatus = $data->fetchAll();


            $sql5 = "update chat set message = 'seen' WHERE user_id ='" . $id . "' && opponent_id ='" . $opponent_id . "'";
            $one = $this->Dbconnect->exec($sql5);

            return $satatus;
        } else {
            $sql = "SELECT * FROM chat WHERE user_id='" . $temp . "' && opponent_id='" . $temp2 . "'";
            $data = $this->Dbconnect->query($sql);
            $data->setFetchMode(\PDO::FETCH_OBJ);
            $satatus = $data->fetchAll();

            $sql5 = "update chat set message_read = 'seen' WHERE user_id ='" . $temp . "' && opponent_id ='" . $temp2 . "'";
            $one = $this->Dbconnect->exec($sql5);

            return $satatus;
        }


    }

    public function Image($id)
    {
        $sql = "SELECT image FROM users WHERE user_id='" . $id . "'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }


    public function ChangeUserProfile($destinationFile, $email)
    {
        $array = array($destinationFile);
        $sqls = "update users set image=? WHERE  email='" . $email . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }

    public function updateNotice($id, $notice)
    {
        $array = array($notice);
        $sqls = "update notice set note=? WHERE  id='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
 public function confirm_building_woner($id,$action)
    {
       $array = array($action);
        $sqls = "update users set action=? WHERE  user_id='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
 public function confirm_user_by_building_woner($id,$action)
    {
       $array = array($action);
        $sqls = "update users set action=? WHERE  email='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function delete_admin($id)
    {
        $sql = "delete from users WHERE user_id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deleteBookingData($id)
    {
        $sql = "delete from confim_history WHERE id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function updateUserData($user_id, $name,$profession, $phone,$road_no, $holding_no, $building_name ,$owner_name,$address, $bio)
    {
        $array = array($name);
        $sqls = "update post set name=? WHERE  user_id='".$user_id."'";
        $data2 = $this->Dbconnect->prepare($sqls);
        $data2->execute($array);

        $dataArray = array($name,$profession, $phone,$road_no, $holding_no, $building_name ,$owner_name,$address,$bio);
        $sql = "update  users set name=?,profession=?,phone=?,road_no=?,holding_no=?,building_name=?,owner_name=?,address=?,bio=? WHERE  user_id='" . $user_id . "'";
        //var_dump($sql);
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($dataArray);
        //var_dump($status);


        return $status;

    }
    public function updateUserAdminDatazz($user_id, $name, $phone, $profession, $road_no, $bio)
    {
        $array = array($name);
        $sqls = "update post set name=? WHERE  user_id=$user_id";
        $data2 = $this->Dbconnect->prepare($sqls);
        $data2->execute($array);

        $dataArray = array($name,$profession, $phone,$road_no, $bio);
        $sql = "update  users set name=?,profession=?,phone=?,road_no=?,bio=? WHERE  user_id='" . $user_id . "'";
        //var_dump($sql);
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($dataArray);
        //var_dump($status);


        return $status;

    }

    public function insertPostData($post, $user_id, $email, $name)
    {
        $dataArray = array($post, $user_id, $email, $name);
        $sql = "insert into post(content,user_id,email,name,date,time)
                  VALUES ( ?, ?, ?, ?, now(),now())";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }


    public function insertEmergencyCell($phone,$service_name)
    {
        $dataArray = array($phone,$service_name);
        $sql = "insert into emergency_cell(phone,service_name)
                  VALUES ( ?, ?)";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }
    public function insertNotice($notice)
    {
        $dataArray = array($notice);
        $sql = "insert into notice(note,date,time)VALUES (?, now(),now())";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }
    public function insertBookingData($user_id,$user_name,$user_phone,$user_email,$employee_id,$employee_phone,$employee_name,$work)
    {
        $dataArray = array($user_id,$user_name,$user_phone,$user_email,$employee_id,$employee_phone,$employee_name,$work);
        $sql = "insert into confim_history(user_id,user_name,user_phone,user_email,employee_id,employee_phone,employee_name,works_details,date)VALUES (?,?,?,?,?,?,?,?,now())";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }
     public function insert_new_employee($name,$profession,$building_name,$owner_name,$holding_no,$road_no,$address,$bio,$phone,$work,$type,$action,$image)
    {
        $dataArray = array($name,$profession,$building_name,$owner_name,$holding_no,$road_no,$address,$bio,$phone,$work,$type,$action,$image);
        $sql = "insert into users(name,profession,building_name,owner_name,holding_no,road_no,address,bio,phone,work,type,action,image)VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }
    public function insert_new_admin($name,$type,$profession,$email,$bio,$phone,$password,$image)
    {
        $dataArray = array($name,$type,$profession,$email,$bio,$phone,$password,$image);
        $sql = "insert into users(name,type,profession,email,bio,phone,password,image)VALUES (?,?,?,?,?,?,?,?)";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }

    public function insertMessages($message, $user_id, $opponent_id)
    {
        $temp = $opponent_id;
        $temp2 = $user_id;
        $sqlCheck = "select parent_id from chat WHERE user_id = $temp && opponent_id = $temp2 && parent_id = 0 || user_id = $user_id && opponent_id = $opponent_id && parent_id = 0";
        $datas = $this->Dbconnect->query($sqlCheck);
        $datas->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $datas->fetchAll();
        if ($satatus) {

            $sqlChecks = "select parent_id from chat WHERE user_id = $user_id && opponent_id = $opponent_id && parent_id = 0";
            $datass = $this->Dbconnect->query($sqlChecks);
            $datass->setFetchMode(\PDO::FETCH_OBJ);
            $satatuss = $datass->fetchAll();
            if ($satatuss) {
                $dataArray = array($message, $user_id, $opponent_id);
                $sql = "insert into chat(message_from,user_id,opponent_id)
                  VALUES ( ?, ?, ?)";
                $sth = $this->Dbconnect->prepare($sql);
                $status = $sth->execute($dataArray);
                return $status;

            } else {
                $dataArray = array($message, $temp, $temp2);
                $sql = "insert into chat(message_to,user_id,opponent_id,parent_id)
                  VALUES ( ?, ?, ?,1)";
                $sth = $this->Dbconnect->prepare($sql);
                $status = $sth->execute($dataArray);
                return $status;
            }


        } else {
            $dataArray = array($message, $user_id, $opponent_id);
            $sql = "insert into chat(message_from,user_id,opponent_id)
                  VALUES ( ?, ?, ?)";
            $sth = $this->Dbconnect->prepare($sql);
            $status = $sth->execute($dataArray);

            $sql5 = "update chat set message = 'seen' WHERE user_id ='" . $user_id . "' && opponent_id ='" . $opponent_id . "'";
            $one = $this->Dbconnect->exec($sql5);
            return $status;

        }

    }


    public function notificationfind($parent_id)
    {
        $sql3 = "select * from post where id='" . $parent_id . "'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }

   public function viewPendingBuildinWoner()
    {
        $sql3 = "select * from users where  action='no'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }

     public function viewAllDeleteAccount()
    {
        $sql3 = "select * from users where  action='delete'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }
  public function ShowMyBookingHistory($id)
    {
        $sql3 = "select * from confim_history where  user_id='".$id."'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }


    public function CheckVarifyAccount($email)
    {
        $sql3 = "select * from users where email='".$email."' && action='yes'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }


    public function viewBuldingWonerDataforSendEmail($email)
    {
        $sql3 = "select * from users where email='".$email."'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }
   public function ConfirmerDataBYid($id)
    {
        $sql3 = "select * from users where user_id='".$id."'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }

    public function viewAllPendingUser($holding_id)
    {
        $sql3 = "select * from users where type='User' && action='no'&& holding_no='".$holding_id."' ";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }

    public function checkValid($id)
    {
        $sql3 = "select * from users where user_id='".$id."' && action='no' && type='employee'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }

    public function checkValUserid($email)
    {
        $sql3 = "select * from users where email='".$email."' && action='no' && type='User'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }
    public function ShowMyConfirmHistoryById($user_id)
    {
        $sql3 = "select * from confim_history where employee_id='".$user_id."'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }

    public function viewAllBuildingWoner()
    {
        $sql3 = "select * from users where type='Employee' && action!='delete'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }
     public function viewAllUser()
    {
        $sql3 = "select * from users where type='User' && action!='delete'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetchAll();
        return $status2;
    }

    public function totalBuildingWoner()
    {
        $sql3 = "SELECT COUNT(*) as total FROM users WHERE type='employee'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }
      public function totalUser()
    {
        $sql3 = "SELECT COUNT(*) as total FROM users WHERE type='User'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
        }
   public function totalPendigApproval()
    {
        $sql3 = "SELECT COUNT(*) as total FROM users WHERE type=eemployeeion='no'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
        }
 public function totalEmergencyCell()
    {
        $sql3 = "SELECT COUNT(*) as total FROM emergency_cell";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
        }
public function totalNotice()
    {
        $sql3 = "SELECT COUNT(*) as total FROM notice";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
        }

    public function viewPostByUserId($user_id)
    {
        $sql = "select * from post WHERE user_id = '".$user_id."' && commentNo is null  ORDER BY no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function postUpdateDataCollectviaUserId($user_id,$post){
        $dataArray=array($post);
        $sql="update  post set post=? WHERE no ='".$user_id."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($dataArray);
        return $status;
    }

    public function viewAllPostForAdmin(){
        $sql = "SELECT * FROM post WHERE commentNo is NULL ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function viewPostComment($postNo){
        $sql = "SELECT * FROM post where commentNo = '".$postNo."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function managePostDelete($postNo){
        $sql=" delete from post WHERE commentNo ='".$postNo."' || no='".$postNo."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function postDataCollectviaUserIds($id){
        $sql = "SELECT * FROM post WHERE no ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function ShowNoticById($id)
    {
        $sql3 = "select * from notice where id='".$id."'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }

      public function view_building_woner_profile_by_email($id)
    {
        $sql3 = "select * from users where user_id='".$id."'";
        $sth3 = $this->Dbconnect->query($sql3);
        $sth3->setFetchMode(\PDO::FETCH_OBJ);
        $status2 = $sth3->fetch();
        return $status2;
    }

    public function ViewAllEmergencyCell()
    {
        $sql = "select * from emergency_cell";
        $sth = $this->Dbconnect->query($sql);
        $sth->setFetchMode(\PDO::FETCH_OBJ);
        $status = $sth->fetchAll();
        return $status;
    }

    public function notificationfind2($parent_id, $status2)
    {
        $sql4 = "select * from notifications where user_id='" . $status2 . "' && post_id='" . $parent_id . "'";
        $sth4 = $this->Dbconnect->query($sql4);
        $sth4->setFetchMode(\PDO::FETCH_OBJ);
        $status3 = $sth4->fetch();
        if ($status3)
        {
            return false;
        }
        else {
            $dataArray3 = array($status2, $parent_id);
            $sql5 = "insert into notifications(user_id,post_id) VALUES (?,?)";
            $sth5 = $this->Dbconnect->prepare($sql5);
            $sth5->execute($dataArray3);
            return true;
        }
    }

    public function updatenotification($user_id, $parent_id)
    {
        $sql = "select actions from notifications where user_id =$user_id && post_id =$parent_id  ";
        $sth4 = $this->Dbconnect->query($sql);
        $sth4->setFetchMode(\PDO::FETCH_OBJ);
        $status3 = $sth4->fetchAll();
        foreach ($status3 as $list){
            if($list->actions == "yes"){
                $sqls63 = "update notifications set actions = 'no' WHERE  user_id ='".$user_id."' && post_id = '".$parent_id."'";
                $data23 = $this->Dbconnect->exec($sqls63);

            }
        }

        $sqls6 = "update notifications set actions = 'yes' WHERE  user_id !='".$user_id."' && post_id = '".$parent_id."'";
        $data2 = $this->Dbconnect->exec($sqls6);
        return $data2;
    }

    public function insertCoomentData($messages, $user_id, $parent_id, $name, $email)
    {
        $dataArray = array($messages, $user_id, $parent_id, $name, $email);
        $dataArray2 = array($user_id, $parent_id);
        $sql = "insert into post(content,user_id,parent_id,name,email,date,time)
                  VALUES ( ?,?, ?, ?, ?, now(),now())";
        $sth = $this->Dbconnect->prepare($sql);
        $status = $sth->execute($dataArray);

        $sql2 = "insert into notifications(user_id,post_id)
                  VALUES ( ?,?)";
        $sth2 = $this->Dbconnect->prepare($sql2);
        $sth2->execute($dataArray2);
        $user_id_from_admin = $this->notificationfind($parent_id);
        $this->notificationfind2($parent_id, $user_id_from_admin->user_id);
        $this->updatenotification($user_id, $parent_id);
        return $status;
    }

    public function viewAlert($user_id){
        $sql = "select post_id from notifications WHERE actions = 'yes' && user_id = '".$user_id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_NUM);
        $status = $data->fetchAll();

        return $status;
    }
    public function viewAlertTrack(){
        $sql = "select id from post WHERE parent_id is NULL ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_NUM);
        $status = $data->fetchAll();

        return $status;
    }
    public function viewAllNotice(){
        $sql = "select * from notice ORDER BY id DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();

        return $status;
    }

    public function viewNotificationDataById($id){
        $sql = "select name from post where id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();

        return $status;
    }
    public function searchViaUrl($id,$parent_id){
        if($parent_id == null){
            $sqls = "SELECT * FROM post WHERE id ='".$id."' or parent_id ='".$id."'  ";
            $datas = $this->Dbconnect->query($sqls);
            $datas->setFetchMode(\PDO::FETCH_OBJ);
            $satatuss = $datas->fetchAll();
            return $satatuss;
        }
        else{
            $sqls = "SELECT * FROM post WHERE id ='".$parent_id."' or parent_id ='".$parent_id."'  ";
            $datas = $this->Dbconnect->query($sqls);
            $datas->setFetchMode(\PDO::FETCH_OBJ);
            $satatuss = $datas->fetchAll();
            return $satatuss;
        }

    }
    public function searchUrl($url)
    {
        $sql = "SELECT * FROM post WHERE content like '%$url%'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        if($satatus){
            $list = $this->searchViaUrl($satatus->id,$satatus->parent_id);
            return $list;
        }
        else{
            return false;
        }

    }
    public function searchUrlViaId($id)
    {
        $sqls = "SELECT * FROM post WHERE parent_id ='".$id."'   ";
        $datas = $this->Dbconnect->query($sqls);
        $datas->setFetchMode(\PDO::FETCH_OBJ);
        $satatuss = $datas->fetchAll();
        return $satatuss;

    }
    public function chatActionViaUser($id)
    {
        $sqls = "SELECT * FROM users WHERE  user_id ='".$id."' ";
        $datas = $this->Dbconnect->query($sqls);
        $datas->setFetchMode(\PDO::FETCH_OBJ);
        $satatuss = $datas->fetch();
        return $satatuss;

    }
    public function updateChatActiveNo($id)
    {
        $sql = "update  users set chatStatus = 'no' WHERE  user_id ='".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;

    }
    public function updateChatActiveYes($id)
    {
        $sql = "update  users set chatStatus = 'yes' WHERE  user_id ='".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;

    }
    public function recovery_data($id)
    {
        $sql = "update  users set action = 'yes' WHERE  user_id ='".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;

    }
    public function allUsersForActiveDeactive($id)
    {
        $sqls = "SELECT * FROM users WHERE  user_id ='".$id."' ";
        $datas = $this->Dbconnect->query($sqls);
        $datas->setFetchMode(\PDO::FETCH_OBJ);
        $satatuss = $datas->fetch();
        return $satatuss;

    }



}