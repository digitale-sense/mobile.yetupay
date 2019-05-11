<?php
class TransactionDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function get_all_transaction_by_id($user_id){
        $req = $this->pdo->prepare("SELECT * FROM transaction WHERE user_id = :user_id");
        $req->execute(array('user_id' => $user_id));
        $res = $req->fetchAll();
        return $res;
    }
}

?>