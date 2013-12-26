<?php

class Mcmeta extends CI_Model
{

    function __construct(){
        parent::__construct();
    }


    public function getgroups($pkey){
        $this->db->where('fkey-customer-meta-group',$pkey);
        $query=$this->db->get('od-customer-meta-group');
        $result=$query->result_array();
        return $result;
    }


    public function addgroup($data){
        $this->db->trans_start();
        $insertdata=array(
            'fkey-customer-meta-group' => $data['pkey'],
            'od-meta-category' => $data['groupname']
        );
        $this->db->insert('od-customer-meta-group', $insertdata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while adding Meta Group!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Meta Group Added Successfully!';
            return $return;
        }
    }

    public function getmeta($groupkey){
        $this->db->where('fkey-meta-group',$groupkey);
        $query=$this->db->get('od-customer-meta');
        $result=$query->result_array();
        return $result;
    }


    public function addmeta($data){
        $this->db->trans_start();
        $insertdata=array(
            'fkey-meta-group' => $data['groupkey'],
            'od-meta-key' => $data['key'],
            'od-meta-value' => $data['value']
        );
        $this->db->insert('od-customer-meta', $insertdata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while adding Meta Group!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Meta Group Added Successfully!';
            return $return;
        }
    }


    /*
   * Get All Meta Data
   * array(
   *      'Meta Group 1'=>array(array of meta elements related to meta group 1)
   *      'Meta Group 2'=>array(array of meta elements related to meta group 2)
   *   )
   * */

    public function getall($pkey){
        $returnarray=array();
        //Get Customer info from od-customer Table
        $this->db->where('pkey',$pkey);
        $query = $this->db->get('od-customers',1);
        $result= $query->result_array();
        $personal_details=$result[0];

        //Get all Meta groups of customer from od-customer-meta-group table
        $this->db->where('fkey-customer-meta-group',$personal_details['pkey']);
        $query = $this->db->get('od-customer-meta-group');
        $customer_groups=$query->result_array();

        foreach($customer_groups as $row){
            $returnarray[$row['od-meta-category']]=array();

            //Get all Meta entities related to current meta group from od-customer-meta table
            $this->db->where('fkey-meta-group',$row['pkey']);
            $query=$this->db->get('od-customer-meta');
            $metarow=$query->result_array();

            //Inserting meta values in array
            foreach($metarow as $singlerow){
                $returnarray[$row['od-meta-category']][$singlerow['od-meta-key']] = $singlerow['od-meta-value'];
            }
        }
        return $returnarray;
    }



    public function getgroup($groupid){
        $this->db->where('pkey',$groupid);
        $query = $this->db->get('od-customer-meta-group');
        $group=$query->result_array();
        return $group[0];

    }

    public function getmetabyid($metaid){
        $this->db->where('pkey',$metaid);
        $query = $this->db->get('od-customer-meta');
        $meta=$query->result_array();
        return $meta[0];

    }

    public function editmeta($data){
        $this->db->trans_start();
        $insertdata=array(
            'od-meta-key' => $data['key'],
            'od-meta-value' => $data['value']
        );
        $this->db->where('pkey',$data['pkey']);
        $this->db->update('od-customer-meta', $insertdata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Editing Data!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Data Edited Successfully!';
            return $return;
        }

    }

    public function deletemeta($metapkey){
        $this->db->trans_start();
        $this->db->where('pkey',$metapkey);
        $this->db->delete('od-customer-meta');
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while deleting Meta Data!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Meta Data Deleted Successfully!';
            return $return;
        }
    }

    public function deletegroup($groupkey){
        $this->db->trans_start();
        $this->db->where('pkey',$groupkey);
        $this->db->delete('od-customer-meta-group');
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while deleting Group!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Group Deleted Successfully!';
            return $return;
        }
    }


    public function editgroup($data){
        $this->db->trans_start();
        $insertdata=array(
            'od-meta-category' => $data['groupname']
        );
        $this->db->where('pkey',$data['pkey']);
        $this->db->update('od-customer-meta-group', $insertdata);
        $this->db->trans_complete();
        $return=array();
        if ($this->db->trans_status() === FALSE)
        {
            $return['status']=false;
            $return['message']='<strong>Error!</strong> Problem while Editing Group Name!';
            return $return;
        }else{
            $return['status']=true;
            $return['message']='<strong>Success!</strong> Group Name Edited Successfully!';
            return $return;
        }

    }


    public function getgroupkey($pkey,$groupname){
        $this->db->where('fkey-customer-meta-group',$pkey);
        $this->db->where('od-meta-category',$groupname);
        $this->db->select('pkey');
        $query=$this->db->get('od-customer-meta-group');
        $result=$query->result_array();
        return $result[0]['pkey'];
    }
}
