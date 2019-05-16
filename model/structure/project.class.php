<?php
class Project{
    private $id;
    private $dev_id;
    private $name;
    private $description;
    private $type;
    private $domain;
    private $key;
    private $create_datetime;
    public function __construct($id,$dev_id,$name,$description,$type,$domain,$key,$create_datetime) {
        $this->id = $id;
        $this->dev_id = $dev_id;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->domain = $domain;
        $this->key = $key;
        $this->create_datetime = $create_datetime;
    }

    public function getId(){
        return $this->id;
    }
    public function getDevId(){
        return $this->dev_id;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getType(){
        return $this->type;
    }
    public function getDomain(){
        return $this->domain;
    }
    public function getKey(){
        return $this->key;
    }
    public function getCreateDatetime(){
        return $this->create_datetime;
    }
    public function nameIsCorrect(){
        return preg_match("#^[a-zA-Z0-9_]{2,40}$#",$this->getName());
    }
    public function descriptionIsCorrect(){
        return preg_match("/.*(?=.{0,250})((?=.*[!@#$%^&*()\-_=+{};:,<.>]){1})(?=.*\d)((?=.*[a-z]){1})((?=.*[A-Z]){1}).*$/i",$this->getDescription());
    }
    public function domainIsCorrect(){
        return preg_match("#^(((http)(s?)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4}))$#",$this->getDomain());
    }
    public function generateKey(){
        $this->key = hash('sha256',$this->getDomain().' '.$this->getName().' '.$this->getType().' '.time(),false);
    }
}
?>