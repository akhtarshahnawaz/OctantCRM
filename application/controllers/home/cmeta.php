<?php

class Cmeta extends CI_Controller
{
    function __construct(){
        parent::__construct();
    }

    public function addmeta($pkey=null,$groupid=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->addmeta($data);
                $this->getmeta($data['groupkey'],$result);
            }else{
                if(isset($pkey) && !isset($groupid)){
                    $this->viewgroups($pkey);
                }elseif(isset($pkey) && isset($groupid)){
                    $data['customerkey']=$pkey;
                    $data['groupkey']=$groupid;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/cmeta/addmetadata',$data);
                    $this->load->view('structs/footer');
                }
            }}else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }

    public function getmeta($groupkey,$statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($statusdata)){
                $data['status']=$statusdata;
            }
            $this->load->model('home/mcmeta');
            $result=$this->mcmeta->getmeta($groupkey);
            $group=$this->mcmeta->getgroup($groupkey);
            $data['data']=$result;
            $data['groupname']=$group['od-meta-category'];
            $data['pkey']=$group['fkey-customer-meta-group'];
            $data['groupkey']=$groupkey;

            $this->load->view('structs/header');
            $this->load->view('structs/home-sidebar');
            $this->load->view('home/cmeta/viewmeta',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function addgroup($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->addgroup($data);
                $this->viewgroups($data['pkey'],$result);
            }else{
                if(isset($pkey)){
                    $data['pkey']=$pkey;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/cmeta/addgroup',$data);
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
            $this->load->view('home/cmeta/showall',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function viewgroups($pkey=null,$statusdata=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $this->load->model('home/mcmeta');
            $result=$this->mcmeta->getgroups($pkey);
            $data['data']=$result;
            $data['customerkey']=$pkey;

            if(isset($statusdata)){
                $data['status']=$statusdata;
            }
            $this->load->view('structs/header');
            $this->load->view('structs/home-sidebar');
            $this->load->view('home/cmeta/viewgroups',$data);
            $this->load->view('structs/footer');
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function getall($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($pkey)){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->getall($pkey);
                $data['data']=$result;
                $this->load->view('structs/header');
                $this->load->view('structs/home-sidebar');
                $this->load->view('home/cmeta/viewallmeta',$data);
                $this->load->view('structs/footer');
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function deletemeta($groupkey=null,$metapkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($metapkey) && isset($groupkey)){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->deletemeta($metapkey);
                $this->getmeta($groupkey,$result);
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function editmeta($groupkey=null,$metapkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->editmeta($data);
                $this->getmeta($data['groupkey'],$result);

            }else{
                if(isset($metapkey) && isset($groupkey)){
                    $this->load->model('home/mcmeta');
                    $result=$this->mcmeta->getmetabyid($metapkey);
                    $data['data']=$result;
                    $data['groupkey']=$groupkey;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/cmeta/editmeta',$data);
                    $this->load->view('structs/footer');
                }
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function deletegroup($pkey=null,$groupkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($pkey) && isset($groupkey)){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->deletegroup($groupkey);
                $this->viewgroups($pkey,$result);
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function editgroup($pkey=null,$groupkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/mcmeta');
                $result=$this->mcmeta->editgroup($data);
                $this->viewgroups($data['customerkey'],$result);

            }else{
                if(isset($pkey) && isset($groupkey)){
                    $data['groupkey']=$groupkey;
                    $data['customerkey']=$pkey;
                    $this->load->model('home/mcmeta');
                    $result=$this->mcmeta->getgroup($groupkey);
                    $data['data']=$result;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/cmeta/editgroup',$data);
                    $this->load->view('structs/footer');
                }
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }
}
