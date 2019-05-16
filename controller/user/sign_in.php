<?php
session_start();
$message = array();
if(isset($_POST['phone_number'],$_POST['password'])){
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/user.class.php');
    require_once('../../model/dao/user.dao.php');
    require_once('../../model/structure/transaction.class.php');
    require_once('../../model/dao/transfer.dao.php');

    $pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : null ;   
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $password = htmlspecialchars($_POST['password']);
    $operator = (isset($_POST['operator'])) ? $_POST['operator'] : User::getOperator($phone_number);
    if($operator != -1){
        if($operator == 0)
            $user = new User(null,null,$pseudo,null,$password,$phone_number,null,null,null,null,null,null,null,null,null);
        elseif($operator == 1)
            $user = new User(null,null,$pseudo,null,$password,null,$phone_number,null,null,null,null,null,null,null,null);
        elseif($operator == 2)
            $user = new user(null,null,$pseudo,null,$password,null,null,$phone_number,null,null,null,null,null,null,null);
        elseif($operator == 3) 
            $user = new user(null,null,$pseudo,null,$password,null,null,null,$phone_number,null,null,null,null,null,null);
        //
        if($user->isPasswordCorrect()){
            $user_dao = new UserDAO();
            $result = $user_dao->check_sign_in_datas($user);
            if($result>0){
                $message = array_merge($message, array('code' => 0));}
            elseif(is_null($result)){
                $new_user_id = $user_dao->add($user);
                $user = $user_dao->get_user_by_id($new_user_id);
                header("Location: ../../view/page/login.php");
            }
        }
        else{
            // invalid password
            $message = array_merge($message, array('code' => -2));
            header("Location: ../../view/page/sign.php?code=".$message['code']);
        }  
    }
    else{
        // invalid phone number
        $message = array_merge($message,array('code' => -1));
        header("Location: ../../view/page/sign.php?code=".$message['code']);
    }
}
?>