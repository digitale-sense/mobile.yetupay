<?php
class Transfer extends Transaction{
    private $id;
    private $transaction_id;
    private $sender_type;
    private $receiver_id;
    private $receiver_type;
    private $old_sold;
    private $new_sold;

    public function __construct($transaction_id,$user_id,$type,$datetime,$amount,$currency,$state,$id,$sender_type,$receiver_id,$receiver_type){
        parent::__construct($transaction_id,$user_id,$type,$datetime,$amount,$currency,$state);
        $this->id = $id;
        $this->sender_type = $sender_type;
        $this->receiver_id = $receiver_id;
        $this->receiver_type = $receiver_type;
    }

    public function getId(){
        return $this->id;
    }
    public function getSenderType(){
        return $this->sender_type;
    }
    public function getReceiverId(){
        return  $this->receiver_id;
    }
    public function getTransactionId(){
        return  $this->transaction_id;
    }
}
?>