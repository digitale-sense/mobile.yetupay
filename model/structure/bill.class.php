<?php
class Bill{
    private $id;
    private $number;
    private $business_id;
    private $user_id;
    private $amount;
    private $tax;
    private $currency;
    private $address;
    private $creation_datetime;
    private $payment_datetime;
    private $state;

    public function __construct($id,$number,$business_id,$user_id,$amount,$tax,$currency,$address,$creation_datetime,$payment_datetime,$state){
        $this->id = $id;
        $this->number = $number;
        $this->business_id = $business_id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->tax = $tax;
        $this->currency = $currency;
        $this->address = $address;
        $this->creation_datetime = $creation_datetime;
        $this->payment_datetime = $payment_datetime;
        $this->state = $state;
    }

    public function getId(){
        return $this->id;
    }
    public function getNumber(){
        return $this->number;
    }
    public function getBusinessId(){
        return $this->business_id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getAmount(){
        return $this->amount;
    }
    public function getTax(){
        return $this->tax;
    }
    public function getCurrency(){
        return $this->currency;
    }
    public function getCreationDateTime(){
        return $this->creation_datetime;
    }
    public function getPaymentDateTime(){
        return $this->payment_datetime;
    }
    public function getState(){
        return $this->state;
    }
}
?>