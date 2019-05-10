<?php
class DealerDebit{
    private $id;
    private $agent_name;
    private $dealer_id;
    private $old_sold;
    private $amount;
    private $new_sold;
    private $currency;
    private $datetime;

    public function __construct($id,$agent_name,$dealer_id,$old_sold,$amount,$new_sold,$currency,$datetime){
        $this->id = $id;
        $this->agent_name = $agent_name;
        $this->dealer_id = $dealer_id;
        $this->old_sold = $old_sold;
        $this->amount = $amount;
        $this->new_sold = $new_sold;
        $this->currency = $currency;
        $this->datetime = $datetime;
    }

    public function getId(){
        return $this->id;
    }

    public function getAgentName(){
        return $this->agent_name;
    }

    public function getDealerId(){
        return $this->dealer_id;
    }

    public function getOldSold(){
        return $this->old_sold;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function getNewSold(){
        return $this->new_sold;
    }

    public function getCurrency(){
        return $this->currency;
    }

    public function getDatetime(){
        return $this->datetime;
    }
}
?>