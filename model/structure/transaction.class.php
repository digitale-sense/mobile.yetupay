<?php
class Transaction{
    private $id;
    private $user_id;
    private $code;
    private $type;
    private $datetime;
    private $amount;
    private $currency;
    private $state;

    public function __construct($id,$user_id,$code,$type,$datetime,$amount,$currency,$state){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->code = $code;
        $this->type = $type;
        $this->datetime = $datetime;
        $this->amount =$amount;
        $this->currency = $currency;
        $this->state = $state;
    }

    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function getCode(){
        return $this->code;
    }
    public function getType(){
        return $this->type;
    }
    public function getDateTime(){
        return $this->date_time;
    }
    public function getAmount(){
        return $this->amount;
    }
    public function getCurrency(){
        return $this->currency;
    }
    public function getState(){
        return $this->state;
    }

    public static function generate_transaction_code_from($last_transaction_code){
        $type = substr($last_transaction_code,0,2);
        $last_date = (int) substr($last_transaction_code,12);
        $current_date = (int) date('ymd',strtotime('+2 hours'));
        $number = substr($last_transaction_code,2,10);
        $number++;
        $number = ($current_date > $last_date) ? 1 : $number;
        $number = str_pad($number,10,"0",STR_PAD_LEFT);
        $new_transaction_code = $type.$number.$current_date;
        return $new_transaction_code;
    }
}
?>