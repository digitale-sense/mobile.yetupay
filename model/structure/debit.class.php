<?php
class Debit{
    private $id;
    private $dealer_id;
    private $operator;
    private $transaction_id;

    public function __construct($id,$dealer_id,$operator,$transaction_id){
        $this->id = $id;
        $this->dealer_id = $dealer_id;
        $this->operator =$operator;
        $this->transaction_id = $transaction_id;

    }

    public function getId(){
        return $this->id;
    }
    public function getDealerId(){
        return $this->dealer_id;
    }
    public function getOperator(){
        return  $this->operator;
    }
    public function getTransactionId(){
        return  $this->transaction_id;
    }
}
?>