<?php
define('PATH', '../../');
$message = array();
if(isset($_GET['user_id'],$_GET['phone_number'],$_GET['password'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = $_GET['user_id'];
    $password = htmlspecialchars($_GET['password']);   
    $phone_number = htmlspecialchars($_GET['phone_number']);
    $operator = (isset($_GET['operator'])) ? $_GET['operator'] : User::getOperator($phone_number);
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
        }
        else
            $message = array_merge($message, array('code' => -1));
    }
    else
        $message = array_merge($message, array('code' => -4));
}
?>