<?php
define('PATH', '../../');
$message = array();
if(isset($_POST['new_password'],$_POST['password'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = $_SESSION['user_id'];   
    $new_password = htmlspecialchars($_POST['new_password']);
    $password = htmlspecialchars($_POST['password']);
    $user = new User($user_id,null,null,null,$password,null,null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();
    if(($user_dao->check_password($user))){
        $user = new User($user_id,null,null,null,$new_password,null,null,null,null,null,null,null,null,null);
        if($user->isPasswordCorrect())
            $message = ($user_dao->update_password($user)) ? array_merge($message, array('code' => 1)) : array_merge($message, array('code' => -3));  
            $_SESSION[password] = $user->getPass();
            header('location: ../../view/page/info-perso.php');
        else
            $message = array_merge($message, array('code' => -2));
    }
    else
        $message = array_merge($message, array('code' => -4));
}
?>