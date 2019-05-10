<?php
define('PATH', '../../');
$message = array();
if(isset($_GET['agent_id'],$_GET['password'],$_GET['user_login'],$_GET['amount'],$_GET['currency'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $id = $_GET['agent_id'];
    $password = htmlspecialchars($_GET['password']);
    $agent = new Agent($id,null,$password);
    $agent_dao = new AgentDAO();
    if($agent_dao->check_password($agent)){
        $user_dao = new UserDAO();
        $user_login =  $_GET['user_login'];
        $receiver = new User(null,null,$user_login,$user_login,null,$user_login,$user_login,$user_login,$user_login,null,null,null,null,null);
        $user_id = $user_dao->get_user_id_by_login($receiver);
        $dealer_dao = new DealerDAO();
        $dealer = $dealer_dao->get_dealer_by_user_id($user_id);
        $amount = $_GET['amount'];
        $currency = $_GET['currency'];
        $agent_dao->credit($agent,$dealer,$amount,$currency);
    }
}
?>