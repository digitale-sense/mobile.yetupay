<?php
class DealerDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function check_sign_in_datas(Dealer $dealer){
        $req = $this->pdo->prepare("SELECT user_id FROM dealers WHERE user_id = :user_id");
        $req->execute(array('user_id' => $dealer->getUserId()));
        $res = $req->fetch();
        return $res['user_id'] == $dealer->getUserId();
    }

    public function add(Dealer $dealer){
        $req = $this->pdo->prepare("INSERT INTO dealers(user_id,address,lat,lng,district_id) VALUES(:user_id,:address,:lat,:lng,:district_id)");
        $req->execute(array('user_id' => $dealer->getUserId(),
                            'address' => $dealer->getAddress(),'lat' => $dealer->getLat(),'lng' => $dealer->getLng(),'district_id' => $dealer->getDistrictId()));
        $last_id_req = $this->pdo->query('SELECT LAST_INSERT_ID() last_id');
        $last_id_req->execute();
        $response = $last_id_req->fetch();
        return $response['last_id'];
    }

    public function get_dealer_by_user_id($user_id){
        $req = $this->pdo->prepare("SELECT * FROM dealers WHERE user_id = :user_id");
        $req->execute(array('user_id' => $user_id));
        $res = $req->fetch();    
        return new Dealer($res['dealer_id'],$res['user_id'],
                            $res['dealer_cdf_sold'],$res['dealer_usd_sold'],
                            $res['address'],$res['lat'],$res['lng'],$res['district_id'],$res['dealer_sign_in_datetime']);
    }

    public function get_location_details($dealer){
        $req = $this->pdo->prepare("SELECT dpt.name department,twn.name town,tws.name township,dst.name district
                                    FROM departments dpt,towns twn,townships tws,districts dst 
                                    WHERE dpt.id = twn.department_id AND twn.id = tws.town_id AND tws.id = dst.township_id AND dst.id = :id");
        $req->execute(array('id' => $dealer->getDistrictId()));
        $res = $req->fetch();
        return $res['department'].",".$res['town'].",".$res['township'].",".$res['district'];
    }

    

    public function get_debits($dealer,$offset){
        try{
            $req = $this->pdo->prepare("SELECT A.login,DD.* FROM dealers_debits DD,agents A WHERE A.id = DD.agent_id AND dealer_id = :dealer_id ORDER BY datetime DESC LIMIT " .$offset.",20");
            $req->execute(array('dealer_id' => $dealer->getDealerId()));
            $debits = array();
            while ($res = $req->fetch())
                $debits[] = array(
                    'id' => $res['id'],
                    'agent_name' => $res['login'],
                    'dealer_id' => $res['dealer_id'],
                    'old_sold' => $res['old_sold'],'amount' => $res['amount'],'new_sold' => $res['old_sold']+$res['amount'],'currency' => $res['currency'],
                    'datetime' => $res['datetime']);
            $req->closeCursor();
            return $debits;
        } catch(Exception $e){
            return -3;
        }
    }

    public function get_transfers($dealer,$offset){
        try{
            $req = $this->pdo->prepare("
                    SELECT D.*,U.*,T.*,TD.* 
                    FROM dealers D
                    INNER JOIN users U ON D.user_id = U.id
                    INNER JOIN transactions T ON T.user_id = D.user_id 
                    INNER JOIN users R ON R.id = T.receiver_id
                    INNER JOIN transfers TD ON TD.transaction_id = T.id
                    WHERE D.user_id = :user_id 
                    ORDER BY datetime DESC LIMIT " .$offset.",20");
            $req->execute(array('user_id' => $dealer->getUserId()));
            $debits = array();
            while ($res = $req->fetch())
                $debits[] = array(
                    'id' => $res['id'],
                    'agent_name' => $res['login'],
                    'dealer_id' => $res['dealer_id'],
                    'old_sold' => $res['old_sold'],'amount' => $res['amount'],'new_sold' => $res['old_sold']+$res['amount'],'currency' => $res['currency'],
                    'datetime' => $res['datetime']);
            $req->closeCursor();
            return $debits;
        } catch(Exception $e){
            return -3;
        }
    }
}
?>