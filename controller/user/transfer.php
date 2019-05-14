<?php
define('PATH', '../../');
$message = array();
if(isset($_POST['user_id'],$_POST['password'],$_POST['receiver_login'],$_POST['amount'],$_POST['currency'])){
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/user.class.php');
    require_once('../../model/dao/user.dao.php');
    require_once('../../model/structure/transaction.class.php');
    require_once('../../model/dao/transfer.dao.php');
    
    $sender = new User($_POST['user_id'],null,null,null,htmlspecialchars($_POST['password']),null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();
    if($user_dao->check_password($sender)){
        $sender = $user_dao->get_user_by_id($sender->getId());
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $sold_available = ($currency == "USD") ? $sender->getUSDSold() : $sender->getCDFSold();
        if($sold_available < $amount)
            echo "-2";
        else{
            $login = htmlspecialchars($_POST['receiver_login']);
            $receiver = new User(null,null,$login,$login,null,$login,$login,$login,$login,null,null,null,null,null);
            $receiver_id = $user_dao->get_user_id_by_login($receiver);
            if(!is_null($receiver_id) && $receiver_id>0 && $receiver_id!=$sender->getId()){
                $receiver = $user_dao->get_user_by_id($receiver_id);
                $transfer_dao = new TransferDAO();
                // var_dump($sender,$receiver,$amount,$currency);
                $transfer_dao->transfer($sender,$receiver,$amount,$currency);
                $message = array('state' => 1);
            }
            else
                $message = array('state' => -1);
        }
    }
    else
        $message = array('state' => -4);
}
else
    $message = array('state' => -5);
?>