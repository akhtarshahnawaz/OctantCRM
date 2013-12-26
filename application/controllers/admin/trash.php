<?php




class Trash extends CI_Controller
{

    public function __construct(){
        parent::__construct();
    }


    public function customers($statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            $this->load->model('admin/mtrash');
            $result=$this->mtrash->showcustomer();
            $data['data']=$result;
            if(isset($statusdata) && is_array($statusdata)){
                $data['status']=$statusdata;
            }
            $data['type']='customer';
            $this->load->view('structs/header');
            $this->load->view('structs/admin-sidebar');
            $this->load->view('admin/trash/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }


    public function leads($statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            $this->load->model('admin/mtrash');
            $result=$this->mtrash->showleads();
            $data['data']=$result;
            if(isset($statusdata) && is_array($statusdata)){
                $data['status']=$statusdata;
            }
            $data['type']='lead';

            $this->load->view('structs/header');
            $this->load->view('structs/admin-sidebar');
            $this->load->view('admin/trash/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function putback($name,$pkey,$type){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            if($type=='customer'){
                $this->load->model('admin/mtrash');
                $result=$this->mtrash->putbackcustomer($pkey,$name);
                $this->customers($result);
            }elseif($type=='lead'){
                $this->load->model('admin/mtrash');
                $result=$this->mtrash->putbacklead($pkey,$name);
                $data['data']=$result;
                $this->leads($result);
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function remove($name,$pkey,$type,$confirm=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            if(isset($confirm) && $confirm==1){
                if($type=='customer'){
                    $this->load->model('admin/mtrash');
                    $result=$this->mtrash->removecustomer($pkey,$name);
                    $this->customers($result);
                }elseif($type=='lead'){
                    $this->load->model('admin/mtrash');
                    $result=$this->mtrash->removelead($pkey,$name);
                    $data['data']=$result;
                    $this->leads($result);
                }
            }else{
                $data['name']=$name;
                $data['pkey']=$pkey;
                $data['type']=$type;
                $this->load->view('structs/header');
                $this->load->view('admin/trash/confirm',$data);
                $this->load->view('structs/footer');
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }



    public function viewcustomer($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            if(isset($pkey)){
                $this->load->model('admin/mtrash');
                $result=$this->mtrash->viewcustomer($pkey);
                $data['data']=$result;
                $this->load->model('home/mcmeta');
                $data['meta']=$this->mcmeta->getall($pkey);
                $this->load->view('structs/header');
                $this->load->view('structs/admin-sidebar');
                $this->load->view('admin/trash/viewcustomer',$data);
                $this->load->view('structs/footer');
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }



    public function viewlead($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            if(isset($pkey)){
                $this->load->model('admin/mtrash');
                $result=$this->mtrash->viewlead($pkey);
                $data['data']=$result[0];
                $this->load->view('structs/header');
                $this->load->view('structs/admin-sidebar');
                $this->load->view('admin/trash/viewlead',$data);
                $this->load->view('structs/footer');
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }


}
