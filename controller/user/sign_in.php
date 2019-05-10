<?php
session_start();
define('PATH','../../');
$message = array();
if(isset($_GET['pseudo'],$_GET['phone_number'],$_GET['password'])){
    require_once(PATH.'db_config/connection_manager.class.php');
    require_once(PATH.'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $pseudo = htmlspecialchars($_GET['pseudo']);   
    $phone_number = htmlspecialchars($_GET['phone_number']);
    $password = htmlspecialchars($_GET['password']);
    $operator = (isset($_GET['operator'])) ? $_GET['operator'] : User::getOperator($phone_number);
    if($operator != -1){
        if($operator == 0)
            $user = new User(null,null,$pseudo,null,$password,$phone_number,null,null,null,null,null,null,null,null,null);
        elseif($operator == 1)
            $user = new User(null,null,$pseudo,null,$password,null,$phone_number,null,null,null,null,null,null,null,null);
        elseif($operator == 2)
            $user = new user(null,null,$pseudo,null,$password,null,null,$phone_number,null,null,null,null,null,null,null);
        elseif($operator == 3) 
            $user = new user(null,null,$pseudo,null,$password,null,null,null,$phone_number,null,null,null,null,null,null);
        //
        if($user->isPasswordCorrect()){
            $user_dao = new UserDAO();
            $result = $user_dao->check_sign_in_datas($user);
            if($result>0)
                $message = array_merge($message, array('code' => 0));
            elseif(is_null($result)){
                $new_user_id = $user_dao->add($user);
                $user = $user_dao->get_user_by_id($new_user_id);
            }
        }
        else
            // invalid password
            $message = array_merge($message, array('code' => -2));
    }
    else
        // invalid phone number
        $message = array_merge($message,array('code' => -1));
}
?>