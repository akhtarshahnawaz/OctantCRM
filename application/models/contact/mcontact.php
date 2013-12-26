<?php

class Mcontact extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function add($data,$from){
        $this->db->trans_start();

        $insertarray=array(
            'from'=> $from,
            'to'=> $data['to'],
            'subject'=>$data['subject'],
            'message'=>$data['message']
        );
        $this->db->insert('od-email',$insertarray);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Sending Message!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Message Successfully Send!';
            return $return;
        }
    }

    public function sentmail(){
        $query=$this->db->get('od-email');
        $result=$query->result_array();
        return $result;
    }


    public function view($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('od-email');
        $result=$query->result_array();
        return $result[0];
    }


    public function remove($pkey){
        $this->db->trans_start();
        $this->db->where('pkey',$pkey);
        $this->db->delete('od-email');
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem Deleting Email!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Email Deleted Sucessfully!';
            return $return;
        }
    }

}
