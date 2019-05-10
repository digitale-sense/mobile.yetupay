 <?php
class TransferDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function transfer($sender,$receiver,$amount,$currency){
        switch(get_class($sender)){
            case 'Dealer':
                $treq = $this->pdo->query("SELECT id AS last_transaction_id,code AS last_transfer_code FROM transactions WHERE id = (SELECT MAX(id) FROM transactions WHERE type = 'TD')");
                $treq->execute();
                $tres = $treq->fetch();
                $last_transaction_id = (is_null($tres['last_transaction_id'])) ? 0 : $tres['last_transaction_id'];
                $last_transfer_code = (is_null($tres['last_transfer_code'])) ? 'MT0000000000000101' : $tres['last_transfer_code'];
                $new_transaction_code = Transaction::generate_transaction_code_from($last_transfer_code);
                try{
                    $sql = "START TRANSACTION;
                            INSERT INTO transactions(code,user_id,type,amount,currency,state) 
                                VALUES (:code,:user_id,'TD',:amount,:currency,1);
                            INSERT INTO transfers(transaction_id,receiver_id,sender_old_sold,receiver_old_sold)
                                VALUES(:transaction_id,:receiver_id,:sender_old_sold,:receiver_old_sold);
                            UPDATE dealers SET dealer_".strtolower($currency)."_sold = :dealer_new_sold WHERE user_id = :dealer_user_id;
                            UPDATE users SET ".strtolower($currency)."_sold = :user_new_sold WHERE id = :user_id;
                        COMMIT;";
                    $req = $this->pdo->prepare($sql);
                    $sender_old_sold = (strtolower($currency) == "usd") ? $sender->getDealerUSDSold() : $sender->getDealerCDFSold();
                    $receiver_old_sold = (strtolower($currency) == "usd") ? $receiver->getUSDSold() : $receiver->getCDFSold();
                    $datas = array(
                        'code' => $new_transaction_code, 'user_id' => $sender->getUserId(), 'amount' => $amount, 'currency' => $currency,
                        'transaction_id' => $last_transaction_id+1, 'receiver_id' => $receiver->getId(), 
                        'sender_old_sold' => $sender_old_sold, 'receiver_old_sold' => $receiver_old_sold,
                        'dealer_new_sold' => $sender_old_sold-$amount, 'dealer_user_id' => $sender->getUserId(),
                        'user_new_sold' => $receiver_old_sold+$amount, 'user_id' => $receiver->getId()
                    );
                    $req->execute($datas);
                } catch(Exception $e){
                    return $e->getCode();
                }
                break;
            case 'User':
                $treq = $this->pdo->query("SELECT id AS last_transaction_id,code AS last_transfer_code FROM transactions WHERE id = (SELECT MAX(id) FROM transactions WHERE type = 'TT')");
                $treq->execute();
                $tres = $treq->fetch();
                $last_transaction_id = (is_null($tres['last_transaction_id'])) ? 0 : $tres['last_transaction_id'];
                $last_transfer_code = (is_null($tres['last_transfer_code'])) ? 'DT0000000000000101' : $tres['last_transfer_code'];
                $new_transaction_code = Transaction::generate_transaction_code_from($last_transfer_code);
                $tsql = "START TRANSACTION;
                            INSERT INTO transactions(code,user_id,type,amount,currency,state) 
                                VALUES (:code,:user_id,'UT',:amount,:currency,1);
                            INSERT INTO transfers(transaction_id,receiver_id,sender_old_sold,receiver_old_sold)
                                VALUES(:transaction_id,:receiver_id,:sender_old_sold,:receiver_old_sold);
                            UPDATE users SET ".strtolower($currency)."_sold = :sender_new_sold WHERE id = :sender_id;
                            UPDATE users SET ".strtolower($currency)."_sold = :receiver_new_sold WHERE id = :receiver_id;
                        COMMIT;";
                try{
                    $treq = $this->pdo->prepare($tsql);
                    $sender_old_sold = (strtolower($currency) == "usd") ? $sender->getUSDSold() : $sender->getCDFSold();
                    $receiver_old_sold = (strtolower($currency) == "usd") ? $receiver->getUSDSold() : $receiver->getCDFSold();
                    $datas = array(
                        'code'=>$new_transaction_code, 'user_id'=>$sender->getId(), 'amount'=>$amount, 'currency'=>$currency,
                        'transaction_id'=>$last_transaction_id+1, 'receiver_id'=>$receiver->getId(), 
                        'sender_old_sold'=>$sender_old_sold, 'receiver_old_sold'=>$receiver_old_sold,
                        'sender_new_sold'=>$sender_old_sold-$amount,'sender_id'=>$sender->getId(),
                        'receiver_new_sold'=>$receiver_old_sold+$amount,'receiver_id'=>$receiver->getId());
                    $treq->execute($datas);
                    break;
                } catch(Exception $e){
                    return $e->getCode();
                }
            default:
                break;
        }
    }

    public function get_transfers($user,$offset){
        
    }
}
?>