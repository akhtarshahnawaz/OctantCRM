<?php

class Msearch extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function search_customers($data){
        $data= preg_replace("/[[:blank:]]+/"," ",$data);
        $data=explode(' ',$data);
        $customers=array();

        $customersearch=array();
        $customerfields=array('od-firstname','od-lastname','od-company','od-designation');
        foreach($data as $item){
            foreach($customerfields as $fields){
                $customersearch[$fields]=$item;
            }
        }

        $this->db->where('od-trash',0);
        $this->db->select('pkey');
        $this->db->or_like($customersearch);
        $query=$this->db->get('od-customers');
        $result=$query->result_array();
        foreach($result as $row){
            $customers[]=$row['pkey'];
        }


        $customercontactsearch=array();
        $customercontactfields=array('emailp','emails','phonep','phones','address','website');
        foreach($data as $item){
            foreach($customercontactfields as $fields){
                $customercontactsearch[$fields]=$item;
            }
        }
        $this->db->select('fkey-customer-contact');
        $this->db->or_like($customercontactsearch);
        $query=$this->db->get('od-customer-contact');
        $result=$query->result_array();
        foreach($result as $row){
            $customers[]=$row['fkey-customer-contact'];
        }

        $customers = array_unique($customers);
        if($customers !=null){
            $this->db->where_in('pkey', $customers);
            $query=$this->db->get('od-customers');
            $result=$query->result_array();
            return $result;
        }else{
            return false;
        }
    }



    public function search_contacts($data){
        $data= preg_replace("/[[:blank:]]+/"," ",$data);
        $data=explode(' ',$data);

        $contactsearch=array();
        $contactfields=array('od-firstname','od-lastname','od-company','od-designation','od-email','od-phone','od-website','od-address','details','status');
        foreach($data as $item){
            foreach($contactfields as $fields){
                $contactsearch[$fields]=$item;
            }
        }


        $this->db->where('od-trash',0);
        $this->db->or_like($contactsearch);
        $query=$this->db->get('od-leads');
        $result=$query->result_array();
        if($result != null){
            return $result;
        }else{
            return false;
        }
    }

}
