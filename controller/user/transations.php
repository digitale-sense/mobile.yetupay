<?php
define('PATH', '../../');
$transation= array();
if (isset($_GET['user_id'])) {
    require_once(PATH . 'db_config/connection_manager.class.php');
    require_once(PATH . 'db_config/db_params.class.php');
    spl_autoload_register(function ($class) {
        $file = strpos($class, "DAO") > 1 ? 'm/dao/' . strtolower((substr($class, 0, strpos($class, "Manager")))) . '.dao.php' : 'm/structure/' . strtolower($class) . '.class.php';
        require_once(PATH . $file);
    });
    $user_id = htmlspecialchars($_GET['user_id']);
    $trans = new Transaction(null, $user_id, null, null, null, null, null, null, null);
    $trans_dao = new TransactionDAO();
    $trans_dao->getTrans($user_id);
}
?>