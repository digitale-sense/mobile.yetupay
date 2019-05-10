<?php
session_start();
define('PATH', '../../');
$message = array();
if(isset($_POST['user_id'],$_POST['dev_name'],$_POST['dev_website'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = htmlspecialchars($_POST['user_id']);
    $dev_name = htmlspecialchars($_POST['dev_name']);
    $dev_website = htmlspecialchars($_POST['dev_website']);

    $developer = new Developer(null,$user_id,$dev_name,$dev_website,1,null,null,null,null);
    $developer_dao = new DeveloperDAO();
    $result = $developer_dao->check_name($developer);
    if ($result > 0)
        $message = array_merge($message, array('code' => 0));
    elseif (is_null($result)) {
        // $developer->generateKey();
        $new_developer_id = $developer_dao->add($developer);
        $developer = $developer_dao->get_developer_by_id($new_developer_id);
    }
}
?>