<?php
class District{
    private $id;
    private $township_id;
    private $name;

    public function __construct($id,$township_id,$name){
        $this->id = $id;
        $this->township_id = $township_id;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getTownshipId(){
        return $this->township_id;
    }

    public function getName(){
        return $this->name;
    }
}
?>