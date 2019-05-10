<?php
class Dealer{
    private $id;
    private $user_id;
    private $dealer_cdf_sold;
    private $dealer_usd_sold;
    private $address;
    private $lat;
    private $lng;
    private $district_id;
    private $dealer_sign_in_datetime;

    public function __construct($id,$user_id,$dealer_cdf_sold,$dealer_usd_sold,$address,$lat,$lng,$district_id,$dealer_sign_in_datetime){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->dealer_cdf_sold = $dealer_cdf_sold;
        $this->dealer_usd_sold = $dealer_usd_sold;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->district_id = $district_id;
        $this->dealer_sign_in_datetime = $dealer_sign_in_datetime;
    }

    public function getId(){
        return $this->id;    
    }
    public function getUserId(){
        return $this->user_id;    
    }
    public function getDealerCDFSold(){
        return $this->dealer_cdf_sold;
    }
    public function getDealerUSDSold(){
        return $this->dealer_usd_sold;
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
    public function getDealerSignInDatetime(){
        return $this->dealer_sign_in_datetime;
    }
}
?>