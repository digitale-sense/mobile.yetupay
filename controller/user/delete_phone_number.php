<?php
session_start();
define('PATH', '../../');
$message = array();
if(isset($_POST['user_id'],$_POST['phone_number'],$_POST['password'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = $_POST['user_id'];   
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $password = htmlspecialchars($_POST['password']);
    $user = new User($user_id,null,null,$phone_number,$password,null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();
    if(($user_dao->check_password($user)))
        $message = ($user_dao->update_phone_number($user,$user->getOperator($phone_number))) ? array_merge($message, array('code' => 1)) : array_merge($message, array('code' => -3));
    else
        $message = array_merge($message, array('code' => -4));
}
