<?php

class Muser extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){

    }

    public function add($data){
        $this->db->trans_start();

        $this->load->library('encrypt');
        $this->db->where('od-username',$data['username']);
        $query=$this->db->get('od-login');
        if($query->num_rows() > 0){
            $return['status']=false;
            $return['message']='<strong>Error!</strong> User Already Exist!';
            return $return;
        }
        $insertdata=array(
            'od-username' => $data['username'],
            'od-password' => $this->encrypt->sha1($data['password']),
            'od-account-type' => $data['accounttype']
        );
        $this->db->insert('od-login', $insertdata);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Adding User!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> User Added Successfully!';
            return $return;
        }

    }

    public function edit($data){
        $this->db->trans_start();
        $this->load->library('encrypt');
        if($data['password'] !=null){
            $insertdata=array(
                'od-username' => $data['username'],
                'od-password' => $this->encrypt->sha1($data['password']),
                'od-account-type' => $data['accounttype']
            );
            $this->db->where('pkey',$data['pkey']);
            $this->db->update('od-login', $insertdata);
        }else{
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Please Enter a Password!';
            return $return;
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Editing User!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> User Edited Successfully!';
            return $return;
        }

    }

    public function showall($uid=null){
        if(isset($uid)){
            $this->db->where('pkey',$uid);
            $query = $this->db->get('od-login',1);
            return $query->result_array();
        }else{
            $this->db->select('pkey,od-username,od-account-type');
            $query = $this->db->get('od-login');
            return $query->result_array();
        }
    }


    public function remove($uid){
        $this->db->trans_start();
        $this->db->where('pkey', $uid);
        $this->db->delete('od-login');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Deleting User!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> User Deleted Successfully!';
            return $return;
        }

    }



}
