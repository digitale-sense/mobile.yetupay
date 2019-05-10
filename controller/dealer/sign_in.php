<?php
session_start();
define('PATH', '../../');
$message = array();
if(isset($_POST['user_id'],$_POST['password'],$_POST['address'],$_POST['district_id'])){
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    }); 
    $user_id = $_POST['user_id'];   
    $password = htmlspecialchars($_POST['password']);
    $user = new User($user_id,null,null,null,$password,null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();   
    if($user_dao->check_password($user)){
        $address = htmlspecialchars($_POST['address']);
        $lat = (isset($_POST['lat'],$_POST['lng'])) ? $_POST['lat'] : null;
        $lng = (isset($_POST['lng'],$_POST['lat'])) ? $_POST['lng'] : null;
        $district_id = $_POST['district_id'];
        $dealer = new Dealer(null,$user->getId(),null,null,$address,$lat,$lng,$district_id,null);
        $dealer_dao = new DealerDAO();
        $result = $dealer_dao->check_sign_in_datas($dealer);
        if($result>0){
            $message = array_merge($message, array('code' => 0));
        } 
        else {
            $new_dealer_id = $dealer_dao->add($dealer);
            $dealer = $dealer_dao->get_dealer_by_user_id($new_dealer_id);
        }
    }
    else
        $message = array_merge($message, array('code' => -4));
}
?>