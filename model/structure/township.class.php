<?php
class Township{
    private $id;
    private $town_id;
    private $name;

    public function __construct($id,$town_id,$name){
        $this->id = $id;
        $this->town_id = $town_id;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getTownId(){
        return $this->town_id;
    }

    public function getName(){
        return $this->name;
    }
}
?>