<?php

class Index extends CI_Controller
{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
           $this->load->model('admin');
           $result=$this->admin->loadindex();
            $data['data']=$result;
           $this->load->view('structs/header');
           $this->load->view('structs/home-sidebar');
           $this->load->view('main',$data);
           $this->load->view('structs/footer');

        }else{
           $data['status']='You are currently not logged in!';
           $this->load->view('login',$data);
        }

    }


    public function logout(){
        $this->load->library('session');
        $this->session->sess_destroy();
        $data['loggedout']='Sucessfully Logged Out!';
        $this->load->view('login',$data);
    }

    public function login(){
        $this->load->library('session');
        $this->load->helper('url');
        $logged=$this->session->userdata('logged_in');

        if($logged){
            redirect('/', 'refresh');
        }else{
            $data = $this->input->post();
            if($data){
                $this->load->model('admin');
                $result=$this->admin->login($data);
                if($result){
                    $result=$result[0];
                    $newdata = array(
                        'key' => $result['pkey'],
                        'username' => $result['od-username'],
                        'usertype' => $result['od-account-type'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($newdata);
                    $this->load->helper('url');
                    redirect('/', 'refresh');
                }else{
                    $data['status']= 'Wrong Username or Password';
                    $this->load->view('login',$data);
                }
            }else{
                $this->load->view('login',$data);
            }
        }

    }


    public function install(){
        $data=$this->input->post();
        $this->load->helper('url');
        $this->load->model('admin/mindex');
        
        if($this->mindex->checkInstall()){
            if(!empty($data)){
                $this->mindex->install($data);
             }else{
                $this->load->view('install');
            }
        }else{
            redirect('index/login', 'refresh');
        }
        
    }


    public function getSchema($database=null,$key=null){
        if(isset($database) && isset($key) && sha1($database)==$key){
            $this->load->model('admin/mindex');
            echo $this->mindex->getSchema($database);
        }
    }



}
