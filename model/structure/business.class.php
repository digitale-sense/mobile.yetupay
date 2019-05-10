<?php
class Business{
    private $id;
    private $user_id;
    private $name;
    private $type;
    private $business_cdf_sold;
    private $business_usd_sold;
    private $telephone;
    private $email;
    private $address;
    private $lat;
    private $lng;
    private $district_id;
    private $create_datetime;

    public function __construct($id,$user_id,$name,$type,$business_cdf_sold,$business_usd_sold,$telephone,$email,$address,$lat,$lng,$district_id,$create_datetime){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->type = $type;
        $this->business_cdf_sold = $business_cdf_sold;
        $this->business_usd_sold = $business_usd_sold;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->district_id = $district_id;
        $this->create_datetime = $create_datetime;
    }

    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function getName(){
        return $this->name;
    }
    public function getType(){
        return $this->type;
    }
    public function getBusinessCDFSold(){
        return $this->business_cdf_sold;
    }
    public function getBusinessUSDSold(){
        return $this->business_usd_sold;
    }
    public function getTelephone(){
        return $this->telephone;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getLat(){
        return $this->lat;
    }
    public function getLng(){
        return $this->lng;
    }
    public function getDistrictId(){
        return $this->district_id;
    }
    public function getCreateDatetime(){
        return $this->create_datetime;
    }
}
?>