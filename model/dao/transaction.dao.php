<?php
class TransactionDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = ConnectionManager::getConnection();
    }
    function getTrans($iduser)
    {
        $req = $this->pdo->prepare("SELECT * FROM transactions WHERE user_id=?AND state=1");
        $req->execute(array($iduser));
        return $trans = $req->fetchAll(); 
    }
}

?>