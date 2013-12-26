<?php

class MPayment extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }


    public function add($data){
        $this->db->trans_start();

        $insertdata=array(
            'fkey-customer-payment' => $data['pkey'],
            'od-amount' => $data['amount'],
            'payment-method' => $data['paymentmethod'],
            'type' => $data['paymenttype'],
            'comment' => $data['comment'],
            'fkey-order-id' => null,
            'currency' => $data['currency'],
            'date' => $data['date']
        );
        $this->db->insert('od-customer-payment', $insertdata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while adding Payment!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Payment added Successfully in Account of '.$data['name'];
            return $return;
        }
        }



    public function view($key){
        $this->db->where('fkey-customer-payment',$key);
        $this->db->order_by("date", "asc");
        $query=$this->db->get('od-customer-payment');
        return $query->result_array();
    }

    public function remove($key){
        $this->db->trans_start();
        $this->db->where('pkey',$key);
        $query=$this->db->get('od-customer-payment');
        $result=$query->result_array();
        if($result){
            $result=$result[0];
            if($result['fkey-order-id'] != null){
                $this->db->where('pkey',$result['fkey-order-id']);
                $this->db->update('od-customer-orders',['charged'=> 0]);
            }
        }

        $this->db->delete('od-customer-payment',['pkey'=> $key]);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while deleting!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Deleted Succesfully!';
            return $return;
        }
    }



    public function getpayment($key){
        $this->db->where('pkey',$key);
        $query=$this->db->get('od-customer-payment');
        $result=$query->result_array();
        return $result[0];
    }


    public function edit($data){
        $this->db->trans_start();

        $updatedata=array(
            'od-amount' => $data['amount'],
            'payment-method' => $data['paymentmethod'],
            'type' => $data['paymenttype'],
            'comment' => $data['comment'],
            'currency' => $data['currency'],
            'date' => $data['date']
        );
        $this->db->where('pkey', $data['pkey']);
        $this->db->update('od-customer-payment', $updatedata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Editing Payment!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Order Edited Succesfully';
            return $return;
        }
    }



    public function payment_calculator($pkey){
        $this->db->where('fkey-customer-payment',$pkey);
        $query=$this->db->get('od-customer-payment');
        $result=$query->result_array();
        $calculate=array(
            'usd'=> array(
                'deposited'=>0,
                'spend'=>0,
                'withdraw'=>0,
                'buy'=>0
            ),
            'inr'=>array(
                'deposited'=>0,
                'spend'=>0,
                'withdraw'=>0,
                'buy'=>0
            )
        );



        foreach($result as $transaction){
            if($transaction['currency']=='$'){
                switch($transaction['type']){
                    case 'Deposit':
                        $calculate['usd']['deposited']=$calculate['usd']['deposited']+$transaction['od-amount'];
                        break;
                    case 'Spend':
                        $calculate['usd']['spend']=$calculate['usd']['spend']+$transaction['od-amount'];
                        break;
                    case 'Withdraw':
                        $calculate['usd']['withdraw']=$calculate['usd']['withdraw']+$transaction['od-amount'];
                        break;
                    case 'Buy':
                        $calculate['usd']['buy']=$calculate['usd']['buy']+$transaction['od-amount'];
                        break;
                }

            }elseif($transaction['currency']=='Rs'){
                switch($transaction['type']){
                    case 'Deposit':
                        $calculate['inr']['deposited']=$calculate['inr']['deposited']+$transaction['od-amount'];
                        break;
                    case 'Spend':
                        $calculate['inr']['spend']=$calculate['inr']['spend']+$transaction['od-amount'];
                        break;
                    case 'Withdraw':
                        $calculate['inr']['withdraw']=$calculate['inr']['withdraw']+$transaction['od-amount'];
                        break;
                    case 'Buy':
                        $calculate['inr']['buy']=$calculate['inr']['buy']+$transaction['od-amount'];
                        break;
                }


            }
        }

        return $calculate;
    }
}
