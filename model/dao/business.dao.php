<?php
class BusinessDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function add($business){
        try{
            $req = $this->pdo->prepare("INSERT INTO business(user_id,name,type,address,lat,lng,district_id) VALUES(:user_id,:name,:type,:address,:lat,:lng,:district_id)");
            $res = $req->execute(array(
                'user_id' => $business->getUserId(),
                'name' => $business->getName(),
                'type' => $business->getType(),
                'address' => $business->getAddress(),
                'lat' => $business->getLat(),
                'lng' => $business->getLng(),
                'district_id' => $business->getDistrictId()
            ));
            $last_id_req = $this->pdo->query('SELECT LAST_INSERT_ID() last_id');
            $last_id_req->execute();
            $response = $last_id_req->fetch();
            return $response['last_id'];
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function get_business_by_id($business_id){
        try{
            $req = $this->pdo->prepare("SELECT * FROM business WHERE business_id = :business_id");
            $req->execute(array('business_id' => $business_id));
            $res = $req->fetch();
            return new Business($res['business_id'],$res['user_id'],$res['name'],$res['type'],$res['business_cdf_sold'],$res['business_usd_sold'],$res['telephone'],$res['email'],$res['address'],$res['lat'],$res['lng'],$res['district_id'],$res['create_datetime']);
        } catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function get_business_by_user_id($user_id){
        try {
            $req = $this->pdo->prepare("SELECT * FROM business WHERE user_id = :user_id");
            $req->execute(array('user_id' => $user_id));
            $res = $req->fetch();
            return new Business($res['business_id'],$res['user_id'],$res['name'],$res['type'],$res['business_cdf_sold'],$res['business_usd_sold'],$res['telephone'],$res['email'],$res['address'], $res['lat'], $res['lng'], $res['district_id'], $res['create_datetime']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>