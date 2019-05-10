<?php
class BillDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    }

    public function add($bill,$payments){
        try {
            $req = $this->pdo->query('SELECT MAX(B.id) last_bill_id,MAX(T.id) last_transaction_id FROM bills B,transactions T');
            $req->execute();
            $res = $req->fetch();
            $last_bill_id = (is_null($res['last_bill_id'])) ? 0 : $res['last_bill_id'];
            $last_transaction_id = (is_null($res['last_transaction_id'])) ? 0 : $res['last_transaction_id'];
            $this->pdo->beginTransaction();
            $new_bill_id = $last_bill_id+1;
            $number = date('ym').'-'. str_pad($bill->getBusinessId(),2,"0",STR_PAD_LEFT).'-'.str_pad($new_bill_id,4,"0",STR_PAD_LEFT);
            $bill_deadline = date('Y-m-d H:i:s',strtotime("+2 days"));
            $this->pdo->exec("INSERT INTO bills(number,business_id,user_id,amount,tax,currency,address,payment_datetime) VALUES (".$number.",".$bill->getBusinessId().",".$bill->getUserId().",".$bill->getAmount().",".$bill->getTax().",'".$bill->getCurrency()."','".$bill->getAddress()."','".$bill_deadline."')");
            $insert_transactions_sql = "INSERT INTO transactions(user_id,type,amount,currency) VALUES ";
            $count_payments = count($payments);
            for($i=0; $i<$count_payments; $i++){
                $type = ($payments[$i]['amount'] != $payments[$i]['product_value']) ? 'UP' : 'UB';
                $insert_transactions_sql .= "(".$payments[$i]['sender_id'].",'".$type."',".$payments[$i]['product_value'].",'".$payments[$i]['currency']."'),";  
            }
            $insert_transactions_sql = substr($insert_transactions_sql,0,-1);
            $this->pdo->exec($insert_transactions_sql);
            $insert_payments_sql = "INSERT INTO payments(bill_id,transaction_id,receiver_id,product_designation,value,quantity) VALUES ";
            for($i=0; $i<$count_payments; $i++){
                $transaction_id = $last_transaction_id + $i + 1;
                $insert_payments_sql .= "(".$new_bill_id.",".$transaction_id.",".$payments[$i]['receiver_id'].",'".$payments[$i]['description']."',".$payments[$i]['amount'].",1),";
            }
            $insert_payments_sql = substr($insert_payments_sql,0,-1);
            $this->pdo->exec($insert_payments_sql);
            if($this->pdo->commit()){
                $l = $this->pdo->query('SELECT MAX(id) last_bill_id FROM bills');
                $l->execute();
                $r = $l->fetch();
                return $r['last_bill_id'];
            }
            else
                return 0;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function get_bill_by_id($bill_id){
        try{
            $req = $this->pdo->prepare('SELECT * FROM bills WHERE id = :bill_id');
            $req->execute(array('bill_id' => $bill_id));
            $res = $req->fetch();
            return new Bill($res['id'],$res['number'],$res['business_id'],$res['user_id'],$res['amount'],$res['tax'],$res['currency'],$res['address'],$res['creation_datetime'],$res['payment_datetime'],$res['state']);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function validate_payment(User $user,Business $business,Bill $bill,$payments){
        $user_dao = new UserDAO();
        try{
            $up_t_req = $this->pdo->query('SELECT id AS last_user_payment_transaction_id,code AS last_user_payment_transaction_code FROM transactions WHERE id = (SELECT MAX(id) FROM transactions WHERE type = "UP")');
            $up_t_res = $up_t_req->execute();
            $up_transaction_id = (is_null($up_t_res['last_user_payment_transaction_id'])) ? 0 : $up_t_res['last_user_payment_transaction_id'];
            $up_transaction_code = (is_null($up_t_res['last_user_payment_transaction_code'])) ? 'UP0000000000000101' : $up_t_res['last_user_payment_transaction_code'];
            // $new_user_payment_transaction_code = Transaction::generate_transaction_code_from($last_user_payment_transaction_code);
            $ub_t_req = $this->pdo->query('SELECT id AS last_business_payment_transaction_id,code AS last_business_payment_transaction_code FROM transactions WHERE id = (SELECT MAX(id) FROM transactions WHERE type = "UB")');
            $up_t_res = $up_t_req->execute();
            $ub_transaction_id = (is_null($up_t_res['last_business_payment_transaction_id'])) ? 0 : $up_t_res['last_business_payment_transaction_id'];
            $ub_transaction_code = (is_null($up_t_res['last_business_payment_transaction_code'])) ? 'UB0000000000000101' : $up_t_res['last_business_payment_transaction_code'];
            // $new_business_payment_transaction_code = Transaction::generate_transaction_code_from($last_business_payment_transaction_code);
            $total_amount = $bill->getAmount() + $bill->getTax();
            $user_new_sold = ($bill->getCurrency() == 'USD') ? $user->getUSDSold()-$total_amount : $user->getCDFSold()-$total_amount;
            $business_new_sold = ($bill->getCurrency() == 'USD') ? $business->getBusinessUSDSold() : $business->getBusinessCDFSold();
            $p_sql = 'START TRANSACTION;';
            $p_sql .= 'UPDATE users SET '.strtolower($bill->getCurrency()).'_sold = '.$user_new_sold.' WHERE id = '.$user->getId().';';
            for($i=0; $i<count($payments); $i++){
                switch ($payments[$i]['type']){
                    case 'UP':
                        $receiver = $user_dao->get_user_by_id($payments[$i]['receiver_id']);
                        $receiver_new_sold = ($bill->getCurrency() == 'USD') ? $receiver->getUSDSold() + $payments[$i]['amount'] : $receiver->getCDFSold() + $payments[$i]['amount'];
                        $p_sql .= 'UPDATE users SET '.strtolower($bill->getCurrency()).'_sold = '.$receiver_new_sold.' WHERE id = '.$payments[$i]['receiver_id'].';';
                        $up_transaction_code = Transaction::generate_transaction_code_from($up_transaction_code);
                        $p_sql .= 'UPDATE transactions SET code = "'.$up_transaction_code.'",state = 1 WHERE id = '.$payments[$i]['transaction_id'].';';
                        break;
                    case 'UB':
                        $business_new_sold += $payments[$i]['amount'];
                        $ub_transaction_code = Transaction::generate_transaction_code_from($ub_transaction_code);
                        $p_sql .= 'UPDATE transactions SET code = "'.$ub_transaction_code.'",state = 1 WHERE id = '.$payments[$i]['transaction_id'].';';
                        break;
                }
            }
            $p_sql .= 'UPDATE business SET business_' . strtolower($bill->getCurrency()) . '_sold = '.$business_new_sold.' WHERE business_id = ' . $business->getId() . ';';
            $p_sql .= 'UPDATE bills SET state = 1 WHERE id = '.$bill->getId().';';
            $p_sql .= 'COMMIT;';
            $message = ($p_req = $this->pdo->query($p_sql)) ? 1 : 0;
            echo $message;
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>