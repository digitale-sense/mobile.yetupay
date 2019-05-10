<?php
define('PATH', '../../');
$message = array();
if(isset($_POST['bill_id'],$_POST['user_password'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $bill_id = htmlspecialchars($_POST['bill_id']);
    $user_password = htmlspecialchars($_POST['user_password']);
    $bill_dao = new BillDAO();
    $bill = $bill_dao->get_bill_by_id($bill_id);
    $user_dao = new UserDAO();
    $user = $user_dao->get_user_by_id($bill->getUserId());
    $hash_user_password = hash('sha512',$user_password,true);
    $business_dao = new BusinessDAO();
    $business = $business_dao->get_business_by_id($bill->getBusinessId());
    $payment_dao = new PaymentDAO();
    $payments = $payment_dao->get_payments_by_bill_id($bill->getId());
    if($hash_user_password == $user->getPass()){
        $total_amount = $bill->getAmount() + $bill->getTax();
        if($bill->getCurrency() == 'USD'){
            if($user->getUSDSold() >= $total_amount)
                $bill_dao->validate_payment($user,$business,$bill,$payments);
            else
                // unsufficient sold
                $message = array_merge($message, array('code' => -3));
        }
        else{
            if($user->getCDFSold() >= $total_amount)
                $bill_dao->validate_payment($user,$business,$bill,$payments);
            else
                // unsufficient sold
                $message = array_merge($message, array('code' => -3));
        }
    }   
    else
        // incorrect password
        $message = array_merge($message, array('code' => -4));
}
?>