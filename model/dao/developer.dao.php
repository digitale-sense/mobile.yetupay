<?php
class DeveloperDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function check_name(Developer $developer){
        $req = $this->pdo->prepare( "SELECT id FROM developers WHERE LOWER(name) = :name");
        $req->execute(array('name' => strtolower($developer->getName())));
        $res = $req->fetch();
        return $res['id'];
    }

    public function check_by_user_id($developer){
        $req = $this->pdo->prepare("SELECT * FROM developers WHERE user_id  = ? ");
        $req->execute(array($developer->getUserId()));
        $res = $req->fetchAll();
        return $res;
    }

    public function check_key(Developer $developer){
        $req = $this->pdo->prepare("SELECT id FROM developers WHERE key = :key");
        $req->execute(array('key' => hash('sha512',$developer->getKey(),true)));
        $res = $req->fetch();
        return $res['id'];
    }

    public function add(Developer $developer){
        $req = $this->pdo->prepare("INSERT INTO developers(user_id) VALUES(:user_id)");
        $res = $req->execute(array('user_id' => $developer->getUserId()));
        $last_id_req = $this->pdo->query('SELECT LAST_INSERT_ID() last_id');
        $last_id_req->execute();
        $response = $last_id_req->fetch();
        return $developer->getUserId();
    }

    public function get_developer_by_key($developer_key){
        try{
            $req = $this->pdo->prepare("SELECT * FROM developers WHERE dev_key = :developer_key");
            $req->execute(array('developer_key' => hash('sha512',$developer_key,true)));
            $res = $req->fetch();
            return (is_null($res)) ? null : new Developer($res['developer_id'],$res['user_id'],$res['name'],$res['website'],$res['dev_key'],$res['type'],$res['developer_cdf_sold'],$res['developer_usd_sold'],$res['developer_sign_in_datetime']);
        } catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function get_developer_by_user_id($developper_id){
        $req = $this->pdo->prepare("SELECT * FROM developers WHERE user_id = :user_id");
        $req->execute(array('user_id' => $developper_id));
        $res = $req->fetch(); 
        $user = new Developer($res['developer_id'],$res['user_id'],$res['developer_cdf_sold'],$res['developer_usd_sold'],$res['developer_sign_in_datetime']);
        return $user;     
    }
}

?>