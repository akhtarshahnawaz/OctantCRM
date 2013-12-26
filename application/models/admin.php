<?php
class Admin extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }

    public function login($data){
        $this->load->library('encrypt');
        $query = $this->db->get_where('od-login',['od-username'=> $data['username'],'od-password'=>$this->encrypt->sha1($data['password'])],1);
        if ($query->num_rows() > 0)
        {
           return $query->result_array();
        }
        else{
            return FALSE;
        }
    }

    public function loadindex(){

        $this->db->where('order-status','Active');
        $query=$this->db->get('od-customer-orders');
        $result['activeorders']=$query->result_array();

        $activecustomer=array();
        foreach($result['activeorders'] as $order){
            $activecustomer[]=$order['fkey-customer-orders'];
        }
        if($activecustomer != null){
            $this->db->where_in('pkey',$activecustomer);
            $this->db->where('od-trash !=','1');
            $query=$this->db->get('od-customers');
            $result['activecustomers']=$query->result_array();
        }

        $this->db->where('od-trash !=','1');
        $this->db->where('status','Potential');
        $query=$this->db->get('od-leads');
        $result['potentialleads']=$query->result_array();

        $this->db->where('od-trash !=','1');
        $this->db->where('status','Active');
        $query=$this->db->get('od-leads');
        $result['activeleads']=$query->result_array();


        return $result;

    }

}
