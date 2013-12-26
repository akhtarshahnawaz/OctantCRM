<?php

class Index extends CI_Controller
{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->model('admin/mindex');
        $result=$this->mindex->index();
        $data['data']=$result;
        $this->load->view('structs/header');
        $this->load->view('structs/admin-sidebar');
        $this->load->view('admin/index/index',$data);
        $this->load->view('structs/footer');
    }





}
