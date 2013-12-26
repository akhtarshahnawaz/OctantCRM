<?php

class Search extends CI_Controller
{
    function __construct(){
        parent::__construct();

    }

    public function index(){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            $data=$data['search'];
            if($data){
                $this->load->model('home/msearch');
                $result['customers']=$this->msearch->search_customers($data);
                $result['contacts']=$this->msearch->search_contacts($data);

                if($result){
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/search/result',$result);
                    $this->load->view('structs/footer');
                }else{
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('structs/footer');
                }
            }else{
                //if no data in search field
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

}
