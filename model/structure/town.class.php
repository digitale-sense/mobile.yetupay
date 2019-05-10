<?php
class Town{
    private $id;
    private $department_id;
    private $name;

    public function __construct($id,$department_id,$name){
        $this->id = $id;
        $this->department_id = $department_id;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getDepartmentId(){
        return $this->department_id;
    }

    public function getName(){
        return $this->name;
    }
}
?>