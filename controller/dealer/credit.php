<?php
define('PATH','../../');
$message = array();
if(isset($_GET['agent_id'$_GET['dealer_id'],$_GET['amount'],$_GET['currency'])){
    require_once(PATH.'db_config/connection_manager.class.php');
    require_once(PATH.'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $dealer_id = isset($_GET['dealer_id']) ? htmlspecialchars($_GET['dealer_id']) : 0;
    $password = htmlspecialchars($_GET['password']);
    $sender = new User($dealer_id,null,null,null,$password,null,null,null,null,null,null,null,null,null);
    $dealer_dao = new DealerDAO();
    if($dealer_dao->check_password($sender)){
        $user_id = $_GET['receiver_id'];
        $receiver = new User($user_id,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $amount = $_GET['amount'];
        $currency = $_GET['currency'];
        if($sender->getId() != 0){
            $sender = $dealer_dao->get_dealer_by_id($sender->getId());
            $sold_available = ($currency == "CDF") ? $sender->getCDFSold() : $sender->getUSDSold();
            if($sold_available < $amount)
                $message = array_merge($message,array('code' => 0));
            else {
                if ($dealer_dao->transfer($sender, $receiver, $amount, $currency))
                    $message = array_merge($message, array('code' => 1));
            }            
        }
        else{
            if($dealer_dao->transfer($sender, $receiver, $amount, $currency))
                $message = array_merge($message, array('code' => 1));
        }      
    }
    else
        $message = array_merge($message, array('code' => -4));
}
?>