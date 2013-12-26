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
        $this->load->view('structs/header');
        $this->load->view('structs/contact-sidebar');
        $this->load->view('contact/compose');
        $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function sendmail($to=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){

                $this->load->library('email');
                $this->email->from($this->config->item('EmailFrom'), $this->config->item('EmailFromHeader'));
                $this->email->reply_to($this->config->item('EmailReplyTo'), $this->config->item('EmailReplyToHeader'));
                $this->email->to($data['to']);
                $this->email->subject($data['subject']);
                $this->email->message($data['message']);
                $status=$this->email->send();
                if($status){
                    $this->load->model('contact/mcontact');
                    $result=$this->mcontact->add($data,$this->config->item('EmailFrom'));
                    $data['status']=$result;
                    $this->loadcompose($data);
                }

            }else{
                if(isset($to)){
                    $data['to']=$to;
                    $this->loadcompose($data);
                }else{
                    $this->loadcompose();
                }
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }



public function loadcompose($data=null){
    $this->load->library('session');
    $logged=$this->session->userdata('logged_in');
    if($logged){
    if(isset($data)){
        $this->load->view('structs/header');
        $this->load->view('structs/contact-sidebar');
        $this->load->view('contact/compose',$data);
        $this->load->view('structs/footer');
    }else{
        $this->load->view('structs/header');
        $this->load->view('structs/contact-sidebar');
        $this->load->view('contact/compose');
        $this->load->view('structs/footer');
    }
    }else{
        $data['status']='You are currently not logged in!';
        $this->load->view('login',$data);
    }
}


    public function sentmail($statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->model('contact/mcontact');
            $result=$this->mcontact->sentmail();
            $data['data']=$result;
            if(isset($statusdata)){
                $data['status']=$statusdata;
            }
            $this->load->view('structs/header');
            $this->load->view('structs/contact-sidebar');
            $this->load->view('contact/sentmail',$data);
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
                $this->load->model('contact/mcontact');
                $result=$this->mcontact->view($pkey);
                $data['data']=$result;
                $this->load->view('structs/header');
                $this->load->view('structs/contact-sidebar');
                $this->load->view('contact/view',$data);
                $this->load->view('structs/footer');
            }else{
                $this->sentmail();
            }

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function remove($pkey){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->model('contact/mcontact');
            $result=$this->mcontact->remove($pkey);
            $this->sentmail($result);
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

}