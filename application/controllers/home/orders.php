<?php



class Orders extends CI_Controller
{

    function __construct(){
        parent::__construct();
    }

    public function add($pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            $data=$this->input->post();
            if($data){
                $this->load->model('home/morder');
                $result=$this->morder->add($data);
                $this->view($data['pkey'],$result);
            }else{
                if(isset($pkey)){
                    $this->load->model('home/mcustomer');
                    $name=$this->mcustomer->list_customers_name($pkey);
                    $name=$name[0]['od-firstname'].' '.$name[0]['od-lastname'];
                    $data['pkey']=$pkey;
                    $data['name']=$name;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/order/add',$data);
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
            $this->load->view('home/order/showall',$data);
            $this->load->view('structs/footer');
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
                $this->load->model('home/morder');
                $result = $this->morder->view($key);
                $data['data']=$result;
                $data['customerkey']=$key;
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
                $this->load->view('home/order/view',$data);
                $this->load->view('structs/footer');
            }else{
                $this->show();
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }

    }

    public function remove($customerkey=null,$pkey=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($customerkey) && isset($pkey)){
                $this->load->model('home/morder');
                $result = $this->morder->remove($pkey);
                $this->view($customerkey,$result);
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
                $this->load->model('home/morder');
                $result = $this->morder->edit($data);
                $this->view($data['customerkey'],$result);
            }else{
                if(isset($customerkey) && isset($pkey)){
                    $this->load->model('home/morder');
                    $result = $this->morder->getorder($pkey);
                    $data['data']=$result;
                    $data['customerkey']=$customerkey;
                    $this->load->view('structs/header');
                    $this->load->view('structs/home-sidebar');
                    $this->load->view('home/order/edit',$data);
                    $this->load->view('structs/footer');
                }
            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }


    public function charge($customerkey=null,$pkey=null,$backto=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($customerkey) && isset($pkey)){
                $this->load->model('home/morder');
                $result = $this->morder->charge($pkey,$customerkey);
                if(isset($backto)){
                    if($backto=='index'){
                        $backto='/';
                    }else{
                        $string=explode('-',$backto);
                        $backto='/';
                        foreach($string as $str){
                            $backto.='/'.$str.'/';
                        }
                    }
                    $this->load->helper('url');
                    redirect('/', 'refresh');
                }else{
                    $this->view($customerkey,$result);
                }            }
        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

    public function uncharge($customerkey=null,$pkey=null,$backto=null){
        $this->load->library('session');
        $logged=$this->session->userdata('logged_in');
        if($logged){
            if(isset($customerkey) && isset($pkey)){
                $this->load->model('home/morder');
                $result = $this->morder->uncharge($pkey,$customerkey);
                if(isset($backto)){
                    if($backto=='index'){
                        $backto='/';
                    }else{
                        $string=explode('-',$backto);
                        $backto='/';
                        foreach($string as $str){
                            $backto.='/'.$str.'/';
                        }
                    }
                    $this->load->helper('url');
                    redirect('/', 'refresh');
                }else{
                    $this->view($customerkey,$result);
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
            $this->load->model('home/morder');
            $result = $this->morder->getorder($pkey);
            $data['data']=$result;
            $data['customerkey']=$customerkey;
            $this->load->view('structs/header');
            $this->load->view('structs/home-sidebar');
            $this->load->view('home/order/viewsingle',$data);
            $this->load->view('structs/footer');

        }else{
            $data['status']='You are currently not logged in!';
            $this->load->view('login',$data);
        }
    }

}
