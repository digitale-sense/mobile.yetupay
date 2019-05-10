<?php
class TransactionDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }
}

?>