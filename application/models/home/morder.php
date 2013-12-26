<?php


class Morder extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }


    public function add($data){
        $this->db->trans_start();

        $insertdata=array(
            'fkey-customer-orders' => $data['pkey'],
            'order-amount' => $data['amount'],
            'order-type' => $data['type'],
            'comment' => $data['comment'],
            'currency' => $data['currency'],
            'order-start-date' => $data['startdate'],
            'order-end-date' => $data['enddate'],
            'order-status' => $data['status'],
            'charged' => 0
        );
        $this->db->insert('od-customer-orders', $insertdata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while adding Order!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Order added Successfully in Account of '.$data['name'];
            return $return;
        }
    }


    public function view($key){
        $this->db->where('fkey-customer-orders',$key);
        $query=$this->db->get('od-customer-orders');
        return $query->result_array();
    }


    public function remove($key){
        $this->db->trans_start();
        $this->db->where('pkey',$key);
        $this->db->delete('od-customer-orders');
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


    public function getorder($key){
        $this->db->where('pkey',$key);
        $query=$this->db->get('od-customer-orders');
        $result=$query->result_array();
        return $result[0];
    }


    public function edit($data){
        $this->db->trans_start();

        $updatedata=array(
            'order-amount' => $data['amount'],
            'order-type' => $data['type'],
            'comment' => $data['comment'],
            'currency' => $data['currency'],
            'order-start-date' => $data['startdate'],
            'order-end-date' => $data['enddate'],
            'order-status' => $data['status']
        );
        $this->db->where('pkey', $data['pkey']);
        $this->db->update('od-customer-orders', $updatedata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Editing Order!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Order Edited Succesfully';
            return $return;
        }
    }


    public function charge($orderkey,$customerkey){
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('date');
        $return=array();
        $this->db->trans_start();
        $this->db->where('pkey',$orderkey);
        $query=$this->db->get('od-customer-orders');
        $result=$query->result_array();
        $result=$result[0];
        $datestring = "%m/%d/%Y";
        $time = time();

        if($result['charged'] == 0){
            $insertdata=array(
                'fkey-customer-payment' => $customerkey,
                'od-amount' => $result['order-amount'],
                'payment-method' => 'Debited from Deposit',
                'type' => 'Spend',
                'comment' => $result['comment'],
                'currency' => $result['currency'],
                'fkey-order-id' => $orderkey,
                'date' => mdate($datestring, $time)
            );
            $this->db->insert('od-customer-payment', $insertdata);
        }else{
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Order Already Charged!';
            return $return;
        }
        $this->db->where('pkey',$orderkey);
        $this->db->update('od-customer-orders',['charged'=> 1]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Charging For Order!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Order Charged Succesfully!';
            return $return;
        }
    }



    public function uncharge($orderkey,$customerkey){
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('date');
        $return=array();
        $this->db->trans_start();
        $this->db->where('pkey',$orderkey);
        $this->db->update('od-customer-orders',['charged'=> 0]);
        $this->db->where('fkey-order-id',$orderkey);
        $this->db->delete('od-customer-payment');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Un-Charging the Order!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Order UnCharged Succesfully!';
            return $return;
        }
    }

}
