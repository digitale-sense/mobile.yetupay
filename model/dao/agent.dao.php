<?php
class AgentDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function check_password($agent){
        $req = $this->pdo->prepare("SELECT id FROM agents WHERE (id = :agent_id OR login = :agent_login)  AND pass = :pass");
        $req->execute(array('agent_id' => $agent->getId(),'agent_login' => $agent->getLogin(),'pass' => hash("sha512",$agent->getPass(),true)));
        $res = $req->fetch();
        return ($res['id'] == $agent->getId());
    }

    public function credit($agent,$dealer,$amount,$currency){
        $sreq = $this->pdo->prepare("SELECT dealer_".$currency."_sold last_sold FROM dealers WHERE dealer_id = :dealer_id");
        $sreq->execute(array('dealer_id' => $dealer->getDealerId()));
        $sres = $sreq->fetch();
        $last_sold = $sres['last_sold'];
        $new_sold = $last_sold + $amount;
        $currency = strtolower($currency);
        try{
            $sql = "START TRANSACTION;
                    INSERT INTO dealers_debits(agent_id,dealer_id,old_sold,amount,currency) VALUES(:agent_id,:dealer_id,:old_sold,:amount,:currency);
                    UPDATE dealers SET dealer_".$currency."_sold = :new_sold WHERE dealer_id = :dealer_id;
                    COMMIT;";
            $req = $this->pdo->prepare($sql);
            $req->execute(array('agent_id' => $agent->getId(),'dealer_id' => $dealer->getDealerId(),
                                        'old_sold' => $last_sold,'amount' => $amount,'currency' => strtoupper($currency),'new_sold' => $new_sold));
            $result = ($req) ? 1: -3;
            echo $result;
        } catch(Exception $e){
            return null;
        }
    }

}
?>