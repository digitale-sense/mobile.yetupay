<?php
    if (isset($_GET['user_id'])) {
        require_once('../../db_config/connection_manager.class.php');
        require_once('../../db_config/db_params.class.php');
        require_once('../../model/structure/transaction.class.php');
        require_once('../../model/dao/transaction.dao.php');
        
        $user_id = htmlspecialchars($_GET['user_id']); 
        $trans = new Transaction(null, $user_id, null, null, null, null, null, null, null);
        $trans_dao = new TransactionDAO();
        $transaction = $trans_dao->getTrans($user_id);
    }
?>