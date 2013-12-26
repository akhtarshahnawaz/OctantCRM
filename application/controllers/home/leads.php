<?php

class Leads extends CI_Controller
{
    function __construct(){
        parent::__construct();
    }


    public function add(){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mlead');
                $result=$this->mlead->add($data);
                $data['status']=$result;
                if($result){
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/leads/add',$data);
                    $this->load->view('structs/footer');
                }else{
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/leads/add',$data);
                    $this->load->view('structs/footer');
                }
            }else{
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/leads/add');
                $this->load->view('structs/footer');
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }



    public function edit($contactid=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mlead');
                $result=$this->mlead->edit($data);
                $this->show($result);
            }else{
                if(isset($contactid)){
                    $this->load->model('home/mlead');
                    $result = $this->mlead->get_lead_byid($contactid);
                    $data['data']=$result;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/leads/edit',$data);
                    $this->load->view('structs/footer');
                }else{
                    $this->show();
                }
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }


    public function show($statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->model('home/mlead');
            $result=$this->mlead->showall();
            $data['data']=$result;
            if(isset($statusdata) && is_array($statusdata)){
                $data['status']=$statusdata;
            }
            $this->load->view('structs/header');
            $this->load->view('structs/home-sidebar');
            $this->load->view('home/leads/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }


    }

    public function view($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($pkey)){
                $this->load->model('home/mlead');
                $result=$this->mlead->view($pkey);
                $data['data']=$result[0];
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/leads/view',$data);
                $this->load->view('structs/footer');
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }

    public function trash($pkey){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->model('home/mlead');
            $result=$this->mlead->trash($pkey);
            $this->show($result);
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }

    public function upgrade($contactid,$confirm=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($confirm) && $confirm==1){
                $this->load->model('home/mlead');
                $result=$this->mlead->upgrade($contactid);
                $this->show($result);
            }elseif(!isset($confirm)){
                $data['contactid']=$contactid;
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/leads/confirm-upgrade',$data);
                $this->load->view('structs/footer');
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }

}
