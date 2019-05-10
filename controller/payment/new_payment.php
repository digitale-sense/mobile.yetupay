<?php
if(isset($_POST)){
    require_once('../../db_config/db_params.class.php');
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../m/stucture/user.class.php');
    require_once('../../m/dao/user.dao.php');
    require_once('../../m/stucture/transaction.class.php');
    require_once('../../m/dao/transaction.dao.php');
    require_once('../../m/stucture/payment.class.php');
    require_once('../../m/dao/payment.dao.php');

    var_dump($_POST);
}
?>