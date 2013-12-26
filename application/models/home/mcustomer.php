<?php

class Mcustomer extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }


    public function check_duplicate_directory($directory){
        $this->db->where('od-files',$directory);
        $query= $this->db->get('od-customers');
        if($query->num_rows>0){
            $this->load->library('encrypt');
            $directory= $this->encrypt->sha1($directory);
            $this->check_duplicate_directory($directory);
        }
            return $directory;
    }


    public function add($data){
        $userkey = $this->session->userdata('key');

        $this->db->trans_start();
        $this->load->library('encrypt');
        $directory= $this->encrypt->sha1($data['firstname'],$data['lastname'],$data['company'],$data['designation']);
        $directory=$this->check_duplicate_directory($directory);

        $insertdata=array(
            'od-firstname' => $data['firstname'],
            'od-lastname' => $data['lastname'],
            'od-company' => $data['company'],
            'od-designation' => $data['designation'],
            'od-files' => $directory,
            'owner'=> $userkey,
            'od-trash'=> 0
        );
        $this->db->insert('od-customers', $insertdata);
        $insertid=$this->db->insert_id();
        $insertdata=array(
            'fkey-customer-contact' => $insertid,
            'emailp' => $data['email1'],
            'emails' => $data['email2'],
            'phonep' => $data['phone1'],
            'phones' => $data['phone2'],
            'address' => $data['address'],
            'website' => $data['website']
        );
        $this->db->insert('od-customer-contact',$insertdata);
        $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }else{
            $this->load->helper('path');
            $basepath=set_realpath($this->config->item('customerfiles'));
            $path = $basepath.'/'.$directory;
            if(!is_dir($path)) //create the folder if it's not already exists
            {
                mkdir($path,0777,TRUE);
            }
            return true;
        }
    }



    public function edit($data){
        $this->db->trans_start();

        $updatedata=array(
            'od-firstname' => $data['firstname'],
            'od-lastname' => $data['lastname'],
            'od-company' => $data['company'],
            'od-designation' => $data['designation']
        );
        $this->db->where('pkey', $data['pkey']);
        $this->db->update('od-customers', $updatedata);

        $updatedata2=array(
            'emailp' => $data['email1'],
            'emails' => $data['email2'],
            'phonep' => $data['phone1'],
            'phones' => $data['phone2'],
            'address' => $data['address'],
            'website' => $data['website']
        );
        $this->db->where('fkey-customer-contact', $data['pkey']);
        $this->db->update('od-customer-contact', $updatedata2);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while editing data!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Data of customer '.$data['firstname'].' '.$data['lastname'].' edited successfully!';
            return $return;
        }
    }


    public function show(){

        $this->db->where('od-trash',0);
        $query=$this->db->get('od-customers');
        $result=$query->result_array();

        foreach($result as &$row){
            $this->db->where('fkey-customer-contact',$row['pkey']);
            $query=$this->db->get('od-customer-contact');
            $contactresult=$query->result_array();
            foreach($contactresult as $contactrow){
                foreach($contactrow as $key => $value){
                    if($key!='pkey'){
                        $row[$key]=$value;
                    }
                }
            }

        }

        return $result;
    }

    public function list_customers_name($pkey=null){
        if($pkey==null){
            $this->db->select('od-firstname,od-lastname');
            $query = $this->db->get('od-customers');
            return $query->result_array();
        }else{
            $this->db->where('pkey',$pkey);
            $this->db->select('od-firstname,od-lastname');
            $query = $this->db->get('od-customers');
            return $query->result_array();
        }

    }



    public function get_personal_contact($pkey){

        $this->db->where('od-trash',0);
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('od-customers');
        $result= $query->result_array();

        foreach($result as &$row){
            //Get Customer Contact Info From od-customer-contact
            $this->db->where('fkey-customer-contact',$row['pkey']);
            $query = $this->db->get('od-customer-contact',1);
            $result2=$query->result_array();
            foreach($result2 as &$row2){
                //Inserting contact values in array from customer table
                foreach($row2 as $key=>$value){
                    if($key != 'pkey'){
                        $row[$key] = $value;
                    }
                }
            }
        }

        return $result[0];
    }


    public function trash($pkey){
        $this->db->trans_start();
        $this->db->where('pkey',$pkey);
        $this->db->update('od-customers',['od-trash'=> 1]);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Deleting Item!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> one item deleted!';
            return $return;
        }
    }



    public function view($pkey){

        $this->db->where('pkey',$pkey);
        $this->db->where('od-trash',0);

        $query=$this->db->get('od-customers');
        $result= $query->result_array();

        foreach($result as &$row){
            //Get Customer Contact Info From od-customer-contact
            $this->db->where('fkey-customer-contact',$row['pkey']);
            $query = $this->db->get('od-customer-contact',1);
            $result2=$query->result_array();
            foreach($result2 as &$row2){
                //Inserting contact values in array from customer table
                foreach($row2 as $key=>$value){
                    if($key != 'pkey'){
                        $row[$key] = $value;
                    }
                }
            }
        }
        return $result[0];
    }


    public function getdirectory($pkey){
        $this->db->select('od-files');
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('od-customers');
        $result=$query->result_array();
        if($result != null){
            return $result[0]['od-files'];
        }
    }


}
