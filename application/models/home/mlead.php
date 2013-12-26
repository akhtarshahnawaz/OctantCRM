<?php

class Mlead extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }


    public function add($data){
        $this->db->trans_start();
        $userkey = $this->session->userdata('key');

        $insertdata=array(
            'od-firstname' => $data['firstname'],
            'od-lastname' => $data['lastname'],
            'od-company' => $data['company'],
            'od-designation' => $data['designation'],
            'od-email' => $data['email'],
            'od-website' => $data['website'],
            'od-phone' => $data['phone'],
            'od-address' => $data['address'],
            'details' => $data['details'],
            'status' => $data['status'],
            'owner'=>$userkey,
            'od-trash'=>0
        );
        $this->db->insert('od-leads', $insertdata);
        $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }


    public function edit($data){
        $this->db->trans_start();

        $updatedata=array(
            'od-firstname' => $data['firstname'],
            'od-lastname' => $data['lastname'],
            'od-company' => $data['company'],
            'od-designation' => $data['designation'],
            'od-email' => $data['email'],
            'od-website' => $data['website'],
            'od-phone' => $data['phone'],
            'details' => $data['details'],
            'status' => $data['status'],
            'od-address' => $data['address']
        );
        $this->db->where('pkey', $data['pkey']);
        $this->db->update('od-leads', $updatedata);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while editing data!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Data of Lead '.$data['firstname'].' '.$data['lastname'].' edited successfully!';
            return $return;
        }

    }





    public function showall(){

        $this->db->select('pkey,od-firstname,od-lastname,od-company,od-email,od-phone,status');

        $this->db->where('od-trash',0);
        $query=$this->db->get('od-leads');
        $queryresult=$query->result_array();
        return $queryresult;
    }



    public function get_lead_byid($pkey){

        $this->db->where('pkey',$pkey);
        $this->db->where('od-trash',0);
        $query = $this->db->get('od-leads',1);
        $result= $query->result_array();
        $returnrow=$result[0];
        return $returnrow;
    }



    public function trash($pkey){

        $this->db->trans_start();

        $this->db->where('pkey',$pkey);
        $this->db->update('od-leads',['od-trash'=> 1]);
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

        $query=$this->db->get('od-leads');
        $queryresult=$query->result_array();
        return $queryresult;
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



    //upgrade to customer
    public function upgrade($contactid){
        $userkey = $this->session->userdata('key');
        $this->load->library('encrypt');
        $this->db->trans_start();
        $this->db->where('pkey',$contactid);
        $query=$this->db->get('od-leads');
        $queryresult=$query->result_array();
        $result=$queryresult[0];
        $directory= $this->encrypt->sha1($result['od-firstname'],$result['od-lastname'],$result['od-company'],$result['od-designation']);
        $directory=$this->check_duplicate_directory($directory);

        //Get Insert Personal Details and Insert into 'od-customers' table
        $insertdata=array(
            'od-firstname' => $result['od-firstname'],
            'od-lastname' => $result['od-lastname'],
            'od-company' => $result['od-company'],
            'od-designation' => $result['od-designation'],
            'od-files' => $directory,
            'owner'=>$userkey,
            'od-trash'=> 0
        );

        $insertmeta=array(
          'details' => $result['details']
        );
        $this->db->insert('od-customers', $insertdata);
        $insertid=$this->db->insert_id();


        //Get Customer Id and insert contact details into od-customer-contact
        $insertdata=array(
            'fkey-customer-contact' => $insertid,
            'emailp' => $result['od-email'],
            'phonep' => $result['od-phone'],
            'address' => $result['od-address'],
            'website' => $result['od-website']
        );
        $this->db->insert('od-customer-contact',$insertdata);

        //Insert Lead Details as Customer meta by creating a meta group 'Lead Details'
        $this->load->model('home/mcmeta');
        $this->mcmeta->addgroup(['pkey'=> $insertid,'groupname'=>'Lead Details']);
        $groupid=$this->mcmeta->getgroupkey($insertid,'Lead Details');
        $this->mcmeta->addmeta(['groupkey'=>$groupid,'key'=>'Details','value'=>$insertmeta['details']]);


        //Delete Old Lead
        $this->db->where('pkey',$contactid);
        $this->db->delete('od-leads');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Upgrading Lead to Customer!';
            return $return;
        }else{

            $this->load->helper('path');
            $basepath=set_realpath($this->config->item('customerfiles'));
            $path = $basepath.'/'.$directory;
            if(!is_dir($path)) //create the folder if it's not already exists
            {
                mkdir($path,0777,TRUE);
            }

            $return['status']=true;
            $return['message']='<strong>Success!</strong> Lead '.$result['od-firstname'].' '.$result['od-lastname'].' upgraded to Customer successfully!';
            return $return;
        }

    }
}
