<?php
define('PATH', '../../');
$message = array();
if(isset($_GET['user_id'],$_GET['password'],$_GET['receiver_login'],$_GET['amount'],$_GET['currency'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $sender = new User($_GET['user_id'],null,null,null,htmlspecialchars($_GET['password']),null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();
    if($user_dao->check_password($sender)){
        $sender = $user_dao->get_user_by_id($sender->getId());
        $amount = $_GET['amount'];
        $currency = $_GET['currency'];
        $sold_available = ($currency == "USD") ? $sender->getUSDSold() : $sender->getCDFSold();
        if($sold_available < $amount)
            $message = array_merge($message, array('code' => -2));
        else{
            $login = htmlspecialchars($_GET['receiver_login']);
            $receiver = new User(null,null,$login,$login,null,$login,$login,$login,$login,null,null,null,null,null);
            $receiver_id = $user_dao->get_user_id_by_login($receiver);
            if(!is_null($receiver_id) && $receiver_id>0 && $receiver_id!=$sender->getId()){
                $receiver = $user_dao->get_user_by_id($receiver_id);
                $transfer_dao = new TransferDAO();
                $transfer_dao->transfer($sender,$receiver,$amount,$currency);
            }
            else
                $message = array_merge($message, array('code' => -1));
        }
    }
    else
        $message = array_merge($message, array('code' => -4));
}
?>