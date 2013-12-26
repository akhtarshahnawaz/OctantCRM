<?php




class Mtrash extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }


    public function showcustomer(){
        $this->db->where('od-trash',1);
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


    public function showleads(){
        $this->db->select('pkey,od-firstname,od-lastname,od-company,od-email,od-phone');
        $this->db->where('od-trash',1);
        $query=$this->db->get('od-leads');
        $queryresult=$query->result_array();
        return $queryresult;
    }

    public function putbacklead($pkey,$name){
        $name=str_replace('%20',' ',$name);
        $this->db->trans_start();
        $this->db->where('pkey',$pkey);
        $this->db->update('od-leads', ['od-trash'=> 0]);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Putting Back '.$name;
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> '.$name.' is now out of trash!';
            return $return;
        }
    }


    public function putbackcustomer($pkey,$name){
        $name=str_replace('%20',' ',$name);
        $this->db->trans_start();
        $this->db->where('pkey',$pkey);
        $this->db->update('od-customers',['od-trash'=> 0]);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Putting Back '.$name;
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> '.$name.' is now out of trash!';
            return $return;
        }
    }

    public function removelead($pkey,$name){
        $name=str_replace('%20',' ',$name);
        $this->db->trans_start();
        $this->db->where('pkey', $pkey);
        $this->db->delete('od-leads');
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Deleting '.$name;
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> '.$name.' is permanently deleted!';
            return $return;
        }
    }

    public function removecustomer($pkey,$name){
        $name=str_replace('%20',' ',$name);
        $this->db->trans_start();
        $this->db->select('od-files');
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('od-customers');
        $result=$query->result_array();
        $directory = $result[0]['od-files'];

        $this->db->where('pkey', $pkey);
        $this->db->delete('od-customers');
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Deleting '.$name;
            return $return;
        }else{
            $this->load->helper('path');
            $basepath=set_realpath($this->config->item('customerfiles'));
            $path = $basepath.'/'.$directory;
            $this->load->helper('file');
            recursive_remove_directory($path);
            $return['status']=true;
            $return['message']='<strong>Success!</strong> '.$name.' is permanently deleted!';
            return $return;
        }

    }


    public function viewcustomer($pkey){
        $this->db->where('pkey',$pkey);
        $this->db->where('od-trash',1);
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


    public function viewlead($pkey){
        $this->db->where('pkey',$pkey);
        $this->db->where('od-trash',1);

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
}

