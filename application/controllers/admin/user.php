<?php

class User extends  CI_Controller
{

    function __construct(){
        parent::__construct();
    }


    public function add(){
        $data=$this->input->post();
        if($data){
            $this->load->model('admin/muser');
            $result=$this->muser->add($data);
            $this->showall($result);
        }else{
            $this->load->view('structs/header');
            $this->load->view('structs/admin-sidebar');
            $this->load->view('admin/user/add');
            $this->load->view('structs/footer');
        }
    }

    public function edit($userid=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
        $data=$this->input->post();
        if($data){
            $this->load->model('admin/muser');
            $result=$this->muser->edit($data);
            $this->showall($result);
        }else{
            if(isset($userid)){
                $this->load->model('admin/muser');
                $result=$this->muser->showall($userid);
                $data['data']=$result;
                $this->load->view('structs/header');
                $this->load->view('structs/admin-sidebar');
                $this->load->view('admin/user/edit',$data);
                $this->load->view('structs/footer');
            }else{
                $this->showall();
            }

        }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function remove($userid=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            if(isset($userid)){
                $this->load->model('admin/muser');
                $result=$this->muser->remove($userid);
                $this->showall($result);
            }else{
                $this->showall();
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }


    public function showall($statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        $usertype=$this->session->userdata('usertype');
        if($logged && $usertype=='SuperUser'){
            $this->load->model('admin/muser');
            $result=$this->muser->showall();
            $data['data']=$result;
            if(isset($statusdata) && is_array($statusdata)){
                $data['status']=$statusdata;
            }
            $this->load->view('structs/header');
            $this->load->view('structs/admin-sidebar');
            $this->load->view('admin/user/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

}
