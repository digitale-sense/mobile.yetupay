<?php
define('PATH', '../../');
$message = array();
if(isset($_POST['user_id'],$_POST['email'],$_POST['password'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = $_POST['user_id'];   
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $user = new User($user_id,null,null,$email,$password,null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();
    if(($user_dao->check_password($user))){
        if($user->isEmailCorrect())
            $message = ($user_dao->update_email($user)) ? array_merge($message, array('code' => 1)) : array_merge($message, array('code' => -3)); 
        else
            $message = array_merge($message, array('code' => -2));
    }
    else
        $message = array_merge($message, array('code' => -4));
}
?>