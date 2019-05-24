<?php
session_start();
$message = array();
if(isset($_POST['phone_number'])){
    echo "salut";
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/user.class.php');
    require_once('../../model/dao/user.dao.php'); 

    $user_id = $_SESSION['user_id'];
    $password = htmlspecialchars($_SESSION['user_pass']);   
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $operator = (isset($_POST['operator'])) ? $_POST['operator'] : User::getOperator($phone_number);
    $user_dao = new UserDAO();
    $user = new User($user_id,null,null,null,$password,null,null,null,null,null,null,null,null,null);
    if($user_dao->check_password($user)){
        if($operator != -1){
            if($operator == 0)
                $user = new User($user_id,null,null,null,$password,$phone_number,null,null,null,null,null,null,null,null);
            elseif($operator == 1)
                $user = new User($user_id,null,null,null,$password,null,$phone_number,null,null,null,null,null,null,null);
            elseif($operator == 2)
                $user = new user($user_id,null,null,null,$password,null,null,$phone_number,null,null,null,null,null,null);
            elseif($operator == 3) 
                $user = new user($user_id,null,null,null,$password,null,null,null,$phone_number,null,null,null,null,null);
            //
            $message = ($user_dao->update_phone_number($user,$operator)) ? array_merge(array('code' => 1)) : array_merge(array('code' => -3));
            $m='Numero ajouter';
            header('location: ../../view/page/numbers.php');
        }
        else{
            $message = array_merge($message, array('code' => -1));
            echo "bonjour";
        }
    }
    else
        $message = array_merge($message, array('code' => -4));
}else{
    var_dump($_SESSION);
}
?>