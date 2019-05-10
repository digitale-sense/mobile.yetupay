<?php
define('PATH', '../../');
$message = array();
if(isset($_GET['user_id'], $_GET['user_hash_password'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = htmlspecialchars($_GET['user_id']);
    $password = htmlspecialchars($_GET['password']);
    $user = new User($user_id, null, null, null, $password, null, null, null, null, null, null, null, null, null);
    $user_dao = new UserDAO();
    if ($user_dao->check_password($user)) {
        $user = $user_dao->get_user_by_id($user_id);
        $message = array_merge($message, array("CDF" => $user->getCDFSold(), "USD" => $user->getUSDSold()));
    } else
        $message = array_merge($message, array('code' => -4));
}
?>