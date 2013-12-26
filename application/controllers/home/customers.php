<?php

class Customers extends CI_Controller
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
                $this->load->model('home/mcustomer');
                $result=$this->mcustomer->add($data);
                $data['status']=$result;
                if($result){
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/customer/add',$data);
                    $this->load->view('structs/footer');
                }else{
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/customer/add',$data);
                    $this->load->view('structs/footer');
                }
            }else{
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/customer/add');
                $this->load->view('structs/footer');
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function edit($customerid=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mcustomer');
                $result=$this->mcustomer->edit($data);
                $this->show($result);
            }else{
                if(isset($customerid)){
                    $this->load->model('home/mcustomer');
                    $result = $this->mcustomer->get_personal_contact($customerid);
                    $data['data']=$result;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/customer/edit',$data);
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
            $this->load->model('home/mcustomer');
            $result=$this->mcustomer->show();
            $data['data']=$result;
            if(isset($statusdata) && is_array($statusdata)){
                $data['status']=$statusdata;
            }
            $this->load->view('structs/header');
            $this->load->view('structs/home-sidebar');
            $this->load->view('home/customer/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function trash($pkey){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->model('home/mcustomer');
            $result=$this->mcustomer->trash($pkey);
            $this->show($result);
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function getallmeta($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($pkey)){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->getall($pkey);
                return $result;
            }
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
                $this->load->model('home/mcustomer');
                $result=$this->mcustomer->view($pkey);
                $data['data']=$result;
                $data['meta']=$this->getallmeta($pkey);
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/customer/view',$data);
                $this->load->view('structs/footer');
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function filemanager($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->view('structs/header');
            $this->load->view('structs/home-sidebar');
            $basedir=$this->config->item('customerfiles');
            $this->load->helper('path');

            if($pkey){
                $this->load->model('home/mcustomer');
                $customerdirectory=$this->mcustomer->getdirectory($pkey);
                $data['path']=set_realpath($basedir.'/'.$customerdirectory.'/');
                $data['url']= site_url($basedir).'/'.$customerdirectory.'/';
            }else{
                $this->load->helper('path');
                $data['path']=set_realpath($basedir);
                $data['url']= site_url($basedir);
            }

            $this->load->view('home/filemanager/filemanager',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function printit($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($pkey)){
                $this->load->model('home/mcustomer');
                $result=$this->mcustomer->view($pkey);
                $data['data']=$result;
                $data['meta']=$this->getallmeta($pkey);
                $this->load->view('home/customer/printit',$data);
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

}
