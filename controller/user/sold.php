<?php
$message = array();
if(isset($_SESSION['user_id'])){
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/user.class.php');
    require_once('../../model/dao/user.dao.php'); 

    $user_id = htmlspecialchars($_SESSION['user_id']);
    // $password = htmlspecialchars($_GET['password']);  
    $user = new User($user_id,null,null,null,null,null,null,null,null,null,null,null,null,null);
    $user_dao = new UserDAO();
    $user = $user_dao->get_user_by_id($user_id);
    $message = array_merge($message, array("CDF" => $user->getCDFSold(), "USD" => $user->getUSDSold(),"PHONE_NUMBER"=>['AIRTEL_MONEY' => $user->getTelAirtel(),'ORANGE_MONEY' => $user->getTelOrange(),'M-PESA' => $user->getTelVodacom(),'AFRICEL_MONEY' => $user->getTelAfricell()]));
    // if($user_dao->check_password($user)){  
        
    // }
    // else
    //     $message = array_merge($message, array('code' => -4));
}

?>