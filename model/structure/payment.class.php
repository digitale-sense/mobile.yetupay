<?php
class Payment{
    private $id;
    private $bill_id;
    private $transaction_id;
    private $receiver_id;
    private $product_designation;
    private $value;
    private $quantity;

    public function __construct($id,$bill_id,$transaction_id,$receiver_id,$product_designation,$value,$quantity){
        $this->id;
        $this->bill_id;
        $this->transaction_id = $transaction_id;
        $this->receiver_id = $receiver_id;
        $this->product_designation = $product_designation;
        $this->value = $value;
        $this->quantity =$quantity;
    }

    public function getId(){
        return $this->id;
    }
    public function getBillId(){
        return $this->bill_id;
    }
    public function getReceiverId(){
        return $this->receiver_id;
    }
    public function getTransactionId(){
        return $this->transaction_id;
    }
    public function getProductDesignation(){
        return $this->product_designation;
    }
    public function getValue(){
        return $this->value;
    }
    public function getQuantity(){
        return $this->quantity;
    }
}   
?>