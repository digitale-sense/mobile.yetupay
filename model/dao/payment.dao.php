<?php
class PaymentDAO{
    private $pdo;
    
    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function get_user_payments($user){
        $req = $this->pdo->prepare("SELECT P.id,P.product_designation,U.name,P.quantity,SUM(T.amount * P.quantity) AS total,T.currency FROM payments AS P
            INNER JOIN users AS U
            ON P.receiver_id = U.id
            INNER JOIN transations AS T
            ON P.transaction_id = T.id
            WHERE T.user_id = :id");
        $req->execute(array('id' => $user_id));
        $res = $req->fetchAll();
        if (isset($res)) return $res;
    }

    public function save(Payment $payment){
        $treq = $this->pdo->query("SELECT id AS last_transaction_id,code AS last_payment_code 
            FROM transactions
            WHERE id = (SELECT MAX(id) FROM transactions WHERE type = 'UP')
        ");
        $treq->execute();
        $tres = $treq->fetch();
        $last_transaction_id = (is_null($tres['last_transaction_id'])) ? 0 : $tres['last_transaction_id'];
        $last_payment_code = (is_null($tres['last_payment_code'])) ? 'UP0000000000000101' : $tres['last_payment_code'];
        $new_transaction_code = Transaction::generate_transaction_code_from($last_payment_code);
        $req = $this->pdo->prepare("START TRANSACTION; 
            INSERT INTO transactions(code,user_id,type,amount,currency,state) 
                VALUES (:code,:user_id,'UP',:amount,:currency,0);
            INSERT INTO payments(transaction_id,receiver_id,sender_old_sold,receiver_old_sold)
                VALUES(:transaction_id,:receiver_id,:product_designation,:quantity);
            COMMIT;"
        );
        $req->execute(array(
            'code' => $new_transaction_code,
            'user_id' => $payment->getSenderId(),
            'amount' => $payment->getAmount(),
            'currency',
            'transaction_id',
            'receiver_id',
            'product_designation',
            'quantity'
            )
        );
    }

    public function get_payments_by_bill_id($bill_id){
        $req = $this->pdo->prepare('SELECT P.*,T.*,DATE_FORMAT(B.creation_datetime,"%d/%M/%Y") AS datetime
                FROM payments P
                INNER JOIN bills B ON B.id = P.bill_id
                INNER JOIN transactions T ON T.id = P.transaction_id
                WHERE P.bill_id = :bill_id AND T.state = 0 AND B.state = 0');
        $req->execute(array('bill_id' => $bill_id));
        $payments = $req->fetchAll();
        // while($res = $req->fetch()){
        //     $payments[] = new Payment($res['id'],$res['bill_id'],$res['transaction_id'],$res['receiver_id'],$res['product_description'],$res['quantity']);
        // }
        return $payments;
    }

    public function validate($payment){
        # code...
    }
}    
?>
