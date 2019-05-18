<?php
session_start();
$message = array();
if(isset($_POST['password'])){ 
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/user.class.php');
    require_once('../../model/dao/user.dao.php');
    require_once('../../model/structure/transaction.class.php');
    require_once('../../model/dao/transfer.dao.php');
    require_once('../../model/structure/developer.class.php');
    require_once('../../model/dao/developer.dao.php'); 

    $id = (isset($_POST['id'])) ? $_POST['user_id'] : null;
    $pseudo = (isset($_POST['pseudo'])) ? htmlspecialchars($_POST['pseudo']) : null;
    $email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : null;
    $password = htmlspecialchars($_POST['password']);
    $phone_number = (isset($_POST['phone_number'])) ? htmlspecialchars($_POST['phone_number']) : null;
    $operator = (isset($_POST['operator'])) ? $_POST['operator'] : User::getOperator($phone_number);
    $connection_device = (isset($_POST['connection_device'])) ? htmlspecialchars($_POST['connection_device']) : null;
    // 
    if($operator == 0)
        $user = new User($id,null,$pseudo,$email,$password,$phone_number,null,null,null,null,null,null,null,$connection_device);
    elseif($operator == 1)
        $user = new User($id,null,$pseudo,$email,$password,null,$phone_number,null,null,null,null,null,null,$connection_device);
    elseif($operator == 2)
        $user = new User($id,null,$pseudo,$email,$password,null,null,$phone_number,null,null,null,null,null,$connection_device);
    elseif ($operator == 3) 
        $user = new User($id,null,$pseudo,$email,$password,null,null,null,$phone_number,null,null,null,null,$connection_device);
    else
        $user = new User($id,null,$pseudo,$email,$password,null,null,null,null,null,null,null,null,$connection_device);

    $user_dao = new UserDAO();
    $developer_dao = new DeveloperDAO();
    $id = $user_dao->check_log_in_datas($user);
    
    if(is_null($id)){
        $message = array_merge($message, array('code' => -4));
        header("Location: ../../view/page/login.php?code=".$message['code']);
    }elseif($id>0){
        $user->setId($id);
        $user_dao->update_log_in_informations($user);
        $user = $user_dao->get_user_by_id($id);
        $developer = $developer_dao->get_developer_by_user_id($user->getId());

        if(isset($_POST['stay_connected'])){
            require_once('../start_cookies.php');
            header("Location: ../../view/page/portefeuille.php");            
        }
        else{
            require_once('../start_cookies.php');
            header("Location: ../../view/page/portefeuille.php");
        }
    }
}
?>