<?php

class Payment extends CI_Controller
{

    function __construct(){
        parent::__construct();
    }

    public function add($uid=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mpayment');
                $result=$this->mpayment->add($data);
                $this->view($data['pkey'],$result);
            }else{
                if(isset($uid)){
                    $this->load->model('home/mcustomer');
                    $name=$this->mcustomer->list_customers_name($uid);
                    $name=$name[0]['od-firstname'].' '.$name[0]['od-lastname'];
                    $data['uid']=$uid;
                    $data['name']=$name;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/payment/add',$data);
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




    public function view($key=null,$statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($key)){
                $this->load->model('home/mpayment');
                $result = $this->mpayment->view($key);
                $data['data']=$result;
                $result=$this->mpayment->payment_calculator($key);
                $data['calculated']=$result;
                if(isset($statusdata) && is_array($statusdata)){
                    $data['status']=$statusdata;
                }
                $data['customerkey']=$key;
                $this->load->model('home/mcustomer');
                $name=$this->mcustomer->list_customers_name($key);
                $name=$name[0]['od-firstname'].' '.$name[0]['od-lastname'];
                $data['name']=$name;
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/payment/view',$data);
                $this->load->view('structs/footer');
            }else{
                $this->show();
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
            $this->load->view('home/payment/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function remove($customerkey=null,$key=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($customerkey) && isset($key)){
                $this->load->model('home/mpayment');
                $result=$this->mpayment->remove($key);
                $this->view($customerkey,$result);
            }else{
                $this->show();
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }



    public function edit($customerkey=null,$pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mpayment');
                $result = $this->mpayment->edit($data);
                $this->view($data['customerkey'],$result);
            }else{
                if(isset($customerkey) && isset($pkey)){
                    $this->load->model('home/mpayment');
                    $result = $this->mpayment->getpayment($pkey);
                    $data['data']=$result;
                    $data['customerkey']=$customerkey;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/payment/edit',$data);
                    $this->load->view('structs/footer');
                }
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function viewsingle($customerkey=null,$pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
                    $this->load->model('home/mpayment');
                    $result = $this->mpayment->getpayment($pkey);
                    $data['data']=$result;
                    $data['customerkey']=$customerkey;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/payment/viewsingle',$data);
                    $this->load->view('structs/footer');

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

}
