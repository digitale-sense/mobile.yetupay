<?php
class Agent{
    private $id;
    private $login;
    private $pass;
    
    public function __construct($id,$login,$pass){
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
    }

    public function getId(){
        return $this->id;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getPass(){
        return $this->pass;
    }
}
?>