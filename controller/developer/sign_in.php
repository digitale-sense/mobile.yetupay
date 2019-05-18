<?php
session_start();
$message = array();
if(isset($_SESSION['user_id'])){
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/developer.class.php');
    require_once('../../model/dao/developer.dao.php'); 
    $user_id = htmlspecialchars($_SESSION['user_id']);
    // $dev_name = htmlspecialchars($_SESSION['dev_name']);
    // $dev_website = htmlspecialchars($_SESSION['dev_website']);
    $developer = new Developer(null,$user_id,null,null,null);
    $developer_dao = new DeveloperDAO();
    $result = $developer_dao->check_by_user_id($developer);
    if (!empty($result)){
        $message = array_merge($message, array('code' => 0));
        header("Location: ../../view/page/home-dev.php");
    }elseif (empty($result)){
        $developer = $developer_dao->get_developer_by_user_id($developer_dao->add($developer));
        $_SESSION['developer_id'] = $developer->getId();
        header("Location: ../../view/page/dev-project.php");
    }
}
?>