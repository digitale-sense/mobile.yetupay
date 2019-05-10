<?php
define('PATH','../../');
$message = array();
if(isset($_POST['dev_name'],$_POST['dev_key'],$_POST['payments'])){
    require_once(PATH.'db_config/connection_manager.class.php');
    require_once(PATH.'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    // extracting user(id)
    $user_id = htmlspecialchars($_POST['user_id']);
    $user = new User($user_id,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
    // extracting developer (dev_name,dev_key)
    $dev_name = htmlspecialchars($_POST['dev_name']);
    $dev_key = htmlspecialchars($_POST['dev_key']);
    $developer_dao = new DeveloperDAO();
    $developer = new Developer(null,null,$dev_name,$dev_key,null,null,null,null,null,null,null);
    $developer = $developer_dao->get_developer_by_key($developer->getKey());
    if(is_null($developer)){
        $business_dao = new BusinessDAO();
        $business = $business_dao->get_business_by_user_id($developer->getUserId());
        // payments
        parse_str($_POST['payments'], $payments);
        $amount = 0;
        // payments receivers;
        for ($i = 0; $i < count($payments); $i++) {
            $amount += $payments[$i]['product_value'];
            if (!is_numeric($payments[$i]['receiver_id']))
                $payments[$i]['receiver_id'] = $business->getId();
        }
        $amount = round(($amount * (1.0)), 2, PHP_ROUND_HALF_UP);
        $tax = round(($amount * (3.6 / 100)), 2, PHP_ROUND_HALF_UP);
        $currency = htmlspecialchars($payments[0]['currency']);
        // bill
        $address = htmlspecialchars($_POST['address']);
        $reference = htmlspecialchars($_POST['reference']);
        $bill = new Bill(null, null, $business->getId(), $user->getId(), $amount, $tax, $currency, $address, null, null, null);
        $bill_dao = new BillDAO();
        $bill_id = $bill_dao->add($bill, $payments);
        $message = array_merge($message, array('code' => $bill_id));
    }
    else
        // name and key do not match
        $message = array_merge($message, array('code' => -2));
}
else
    // something missing
    $message = array_merge($message, array('code' => -1));;
?>