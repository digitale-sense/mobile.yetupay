<?php
class Developer{
    private $id;
    private $user_id;
    // private $name;
    // private $website;
    // private $key;
    // private $type;
    private $developer_cdf_sold;
    private $developer_usd_sold;
    private $create_datetime;

    public function __construct($id,$user_id,$developer_cdf_sold,$developer_usd_sold,$create_datetime){
        $this->id = $id;
        $this->user_id = $user_id;
        // $this->name = $name;
        // $this->website = $website;
        // $this->key = $key;
        // $this->type = $type;
        $this->developer_cdf_sold = $developer_cdf_sold;
        $this->developer_usd_sold = $developer_usd_sold;
        $this->create_datetime = $create_datetime;
    }

    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    // public function getName(){
    //     return $this->name;
    // }
    // public function getWebSite(){
    //     return $this->website;
    // }
    // public function getKey(){
    //     return $this->key;
    // }
    // public function getType(){
    //     return $this->type;
    // }
    public function getDeveloperCDFSold(){
        return $this->developer_cdf_sold;
    }
    public function getDeveloperUSDSold(){
        return $this->developer_usd_sold;
    }
    public function getCreateDatetime(){
        return $this->create_datetime;
    }
}
?>