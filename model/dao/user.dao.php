<?php
class UserDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function add(User $user){
        $req = $this->pdo->prepare("INSERT INTO users(pseudo,pass,tel_airtel,tel_orange,tel_vodacom,tel_africell) VALUES(:pseudo,:pass,:tel_airtel,:tel_orange,:tel_vodacom,:tel_africell)");
        $res = $req->execute(array(
            'pseudo' => $user->getPseudo(),
            'pass' => hash('sha512',$user->getPass(),true),
            'tel_airtel' => $user->getTelAirtel(),
            'tel_orange' => $user->getTelOrange(),
            'tel_vodacom' => $user->getTelVodacom(),
            'tel_africell' => $user->getTelAfricell()
        ));
        $last_id_req = $this->pdo->query('SELECT LAST_INSERT_ID() last_id');
        $last_id_req->execute();
        $response = $last_id_req->fetch();
        return $response['last_id'];
    }

    public function check_sign_in_datas(User $user){
        $req = $this->pdo->prepare("SELECT id FROM users WHERE pseudo = :pseudo OR tel_airtel = :phone_number OR tel_orange = :phone_number OR tel_vodacom = :phone_number OR tel_africell = :phone_number");
        if(!is_null($user->getTelAirtel()))
            $phone_number = $user->getTelAirtel();
        else if(!is_null($user->getTelOrange()))
            $phone_number = $user->getTelOrange();
        elseif(!is_null($user->getTelVodacom()))
            $phone_number = $user->getTelVodacom();
        elseif(!is_null($user->getTelAfricell()))
            $phone_number = $user->getTelAfricell();
        $req->execute(array('phone_number' => $phone_number,'pseudo' => $user->getPseudo()));
        $res = $req->fetch();
        return $res['id'];
    }

    public function check_log_in_datas(User $user){
        try{
            $req = $this->pdo->prepare("SELECT id FROM users WHERE (
                                        (id IS NOT NULL AND id = :id) OR 
                                        (pseudo IS NOT NULL AND pseudo = :pseudo) OR 
                                        (email IS NOT NULL AND email = :email) OR 
                                        (tel_airtel IS NOT NULL AND tel_airtel = :phone_number) OR 
                                        (tel_orange IS NOT NULL AND tel_orange = :phone_number) OR 
                                        (tel_vodacom IS NOT NULL AND tel_vodacom = :phone_number) OR 
                                        (tel_africell IS NOT NULL AND tel_africell = :phone_number))
                                        AND pass = :pass");
            $phone_number;
            if(!is_null($user->getTelAirtel()))
                $phone_number = $user->getTelAirtel();
            else if(!is_null($user->getTelOrange()))
                $phone_number = $user->getTelOrange();
            elseif(!is_null($user->getTelVodacom()))
                $phone_number = $user->getTelVodacom();
            elseif(!is_null($user->getTelAfricell()))
                $phone_number = $user->getTelAfricell();
            else
                $phone_number = null;
            $req->execute(array('id' => $user->getId(),'pseudo' => $user->getPseudo(),'email' => $user->getEmail(),'phone_number' => $phone_number,'pass' => hash('sha512',$user->getPass(),true)));
            $res = $req->fetch();
            return $res['id'];
        } catch(Exception $e){
            if(isset($e->getCode()))
                return 0;
        }
    }

    public function update_log_in_informations(User $user){
        $req = $this->pdo->prepare("UPDATE users SET last_connection_datetime = NOW(),last_connection_device = :last_connection_device WHERE id = :user_id");
        $req->execute(array('user_id' => $user->getId(),'last_connection_device' => $user->getLastConnectionDevice()));
    }

    public function check_password(User $user){
        $req = $this->pdo->prepare("SELECT id FROM users WHERE id = :user_id AND pass = :pass");
        $req->execute(array('user_id' => $user->getId(),'pass' => hash("sha512",$user->getPass(),true)));
        $res = $req->fetch();
        return ($res['id'] == $user->getId());
    }

    public function get_user_by_id($user_id){ 
        $req = $this->pdo->prepare("SELECT * FROM users WHERE id = :user_id");
        $req->execute(array('user_id' => $user_id));
        $res = $req->fetch();    
        $user = new User($res['id'],$res['fullname'],$res['pseudo'],$res['email'],$res['pass'],
                        $res['tel_airtel'],$res['tel_orange'],$res['tel_vodacom'],$res['tel_africell'],
                        $res['cdf_sold'],$res['usd_sold'],
                        $res['sign_in_datetime'],$res['last_connection_datetime'],$res['last_connection_device']);
        return $user;
    }

    public function update_phone_number($user,$operator){
        $operators = array('airtel','orange','vodacom','africell');
        try{
            $sql = "UPDATE users SET tel_".$operators[$operator]." = :phone_number WHERE id = :id";
            $req = $this->pdo->prepare($sql);
            $phone_number;
            if(!is_null($user->getTelAirtel()))
                $phone_number = $user->getTelAirtel();
            else if(!is_null($user->getTelOrange()))
                $phone_number = $user->getTelOrange();
            elseif(!is_null($user->getTelVodacom()))
                $phone_number = $user->getTelVodacom();
            elseif(!is_null($user->getTelAfricell()))
                $phone_number = $user->getTelAfricell();
            return $req->execute(array('id' => $user->getID(),'phone_number' => $phone_number));
        } catch(Exception $e){
            return !isset($e->getCode());
        }
    }

    public function delete_phone_number(User $user,$operator){
        try {
            $operators = array('airtel', 'orange', 'vodacom', 'africell');
            $sql = "UPDATE users SET tel_" . $operators[$operator] . " = null WHERE id = :id";
            $req = $this->pdo->prepare($sql);
            return $req->execute(array('id' => $user->getId()));
        } catch (Exception $e){
            return !is_null($e);
        }
    }

    public function update_email($user){
        try{
            $req = $this->pdo->prepare("UPDATE users SET email = :email WHERE id = :id");
            return $req->execute(array('email' => $user->getEmail(),'id' => $user->getId()));
        } catch(Exception $e){
            return !is_null($e);
        }
    }
    
    public function update_fullname($user){
        try{
            $req = $this->pdo->prepare("UPDATE users SET fullname = :fullname WHERE id = :id");
            return $req->execute(array('fullname' => $user->getFullName(),'id' => $user->getId()));
        } catch(Exception $e){
            return !is_null($e);
        }
    }

    public function update_pseudo($user){
        try{
            $req = $this->pdo->prepare("UPDATE users SET pseudo = :pseudo WHERE id = :id");
            return $req->execute(array('pseudo' => $user->getPseudo(),'id' => $user->getId()));
        } catch(Exception $e){
            return !is_null($e);
        }
    }

    public function update_password($user){
        try {
            $req = $this->pdo->prepare("UPDATE users SET pass = :pass WHERE id = :id");
            return $req->execute(array('pass' => hash('sha512', $user->getPass(), true), 'id' => $user->getId()));
        } catch (Exception $e){
            return !is_null($e);
        }
    }

    public function get_towns(){
        $req = $this->pdo->prepare("SELECT * FROM towns WHERE id = 3");
        $towns = array();
        while($res = $req->fetch())
            $towns[] = new Town($res['id'],$res['department_id'],$res['name']);
        $req->closeCursor();
        return $towns;    
    }

    public function get_townships($town){
        $req = $this->pdo->prepare("SELECT * FROM townships WHERE town_id = :town_id");
        $req->execute(array('town_id' => $town->getId()));
        $townships = array();
        while($res = $req->fetch())
            $townships[] = new Township($res['id'],$res['town_id'],$res['name']);
        $req->closeCursor();
        return $townships;
    }

    public function get_districts($township){
        $req = $this->pdo->prepare("SELECT * FROM districts WHERE township_id = :township_id");
        $req->execute(array('township_id' => $township->getId()));
        $districts = array();
        while($res = $req->fetch())
            $districts[] = new District($res['id'],$res['township_id'],$res['name']);
        $req->closeCursor();
        return $districts;
    }

    public function get_user_id_by_login($user){
        $req = $this->pdo->prepare("SELECT id FROM users WHERE 
                                    (pseudo IS NOT NULL AND pseudo = :login) OR 
                                    (email IS NOT NULL AND email = :login) OR 
                                    (tel_airtel IS NOT NULL AND tel_airtel = :login) OR 
                                    (tel_orange IS NOT NULL AND tel_orange = :login) OR 
                                    (tel_vodacom IS NOT NULL AND tel_vodacom = :login) OR 
                                    (tel_africell IS NOT NULL AND tel_africell = :login)
                                ");
        $req->execute(array('login' => $user->getPseudo()));
        $res = $req->fetch();
        return $res['id'];
    }
}
?>