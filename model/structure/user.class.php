<?php
class User{
    
    // identite user
    private $id;
    private $fullname;
    private $pseudo;
    private $email;
    private $pass;
    // numero telephone user
    private $tel_airtel;
    private $tel_orange;
    private $tel_vodacom;
    private $tel_africell;
    // solde compte user
    private $cdf_sold;
    private $usd_sold;
    // time 
    private $sign_in_datetime;
    private $last_connection_datetime;
    private $last_connection_device;

    public function __construct($id,$fullname,$pseudo,$email,$pass,$tel_airtel,$tel_orange,$tel_vodacom,$tel_africell,$cdf_sold,$usd_sold,$sign_in_datetime,$last_connection_datetime,$last_connection_device){
        $this->id = $id;
        $this->fullname = $fullname;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->pass = $pass;
        $this->tel_airtel = $tel_airtel;
        $this->tel_orange = $tel_orange;
        $this->tel_vodacom = $tel_vodacom;
        $this->tel_africell = $tel_africell;
        $this->cdf_sold = $cdf_sold;
        $this->usd_sold = $usd_sold;
        $this->sign_in_datetime = $sign_in_datetime;
        $this->last_connection_datetime = $last_connection_datetime;
        $this->last_connection_device = $last_connection_device;
    }

    public function getId(){  
        return $this->id;
    }
    public function getFullname(){
        return $this->fullname;
    }
    public function getPseudo(){
        return $this->pseudo;
    }
    public function getPass(){    
        return $this->pass;
    }
    public function getEmail(){  
        return $this->email;
    }
    public function getTelAirtel(){  
        return $this->tel_airtel;
    }
    public function getTelAfricell(){    
        return $this->tel_africell;
    }
    public function getTelOrange(){  
        return $this->tel_orange;
    }
    public function getTelVodacom(){ 
        return $this->tel_vodacom;
    }
    public function getTelephone(){
        if(!is_null($this->tel_airtel))
            return $this->tel_airtel;
        if (!is_null($this->tel_africell))
            return $this->tel_africell;
        if (!is_null($this->tel_vodacom))
            return $this->tel_vodacom;
        else
            return $this->tel_orange;
    }
    public function getCDFSold(){ 
        return $this->cdf_sold;
    }
    public function getUSDSold(){ 
        return $this->usd_sold;
    }
    public function getSignInDatetime(){  
        return $this->sign_in_datetime;
    }
    public function getLastConnectionDatetime(){    
        return $this->last_connection_datetime;
    }
    public function getLastConnectionDevice(){  
        return $this->last_connection_device;
    }

    public function setId($id){
        $this->id = $id;
    }
    
    public static function getOperator($phone_number){
        $regex = array("#^0*9[9|7][0-9]{7}$#","#^0*8[4|5|9][0-9]{7}$#","#^0*8[12][0-9]{7}$#","#^0*9[0][0-9]{7}$#");
        for($i=0; $i<count($regex); $i++){
            if(preg_match($regex[$i],$phone_number))
                return $i;
        }
        return -1;
    }
    
    public function isPasswordCorrect(){
        return preg_match( "/.*(?=.{8,})((?=.*[!@#$%^&*()\-_=+{};:,<.>]){1})(?=.*\d)((?=.*[a-z]){1})((?=.*[A-Z]){1}).*$/i",$this->getPass());
    }
    public function isEmailCorrect(){
        return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$this->getEmail());
    }
    public function isPseudoCorrect(){
        return preg_match("#^[a-zA-Z0-9_]{2,20}$#",$this->getPseudo());
    }
    public function isFullnameCorrect(){
        return preg_match("#^[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ\s-]{2,64}$#",$this->getFullname());
    }
}
?>