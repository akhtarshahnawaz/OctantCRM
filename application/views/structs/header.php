<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Octant CRM Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="icon" href="<?php echo base_url().'assets/images/favicon.ico'; ?>" type="image/x-icon">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>assets/js/jquery-1.7.1.min.js"></script>


</head>

<body>
<?php
$CI =& get_instance();
$CI->load->library('session');
$usertype= $CI->session->userdata('usertype');
$CI =& get_instance();
$tab=$CI->uri->segment(1);
?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <i class="icon-th-list icon-white"></i>
            </a>
            <div class="span12">
                <a class="brand" href="#"><img class="img" src="<?php echo base_url().'assets/images/logo-white.png';?>" width="100px" alt="Octant CRM Logo"></a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li <?php if($tab == '' || $tab == 'home'){ echo 'class="active"';} ?>><a  href="<?php echo site_url("/");?>">Home</a></li>
                        <?php if($usertype == 'SuperUser'): ?>
                        <li <?php if($tab == 'admin'){ echo 'class="active"';} ?>><a href="<?php echo site_url("admin");?>">Admin</a></li>
                        <?php endif; ?>
                        <li <?php if($tab == 'contact'){ echo 'class="active"';} ?>><a href="<?php echo site_url("contact");?>">Contact</a></li>

                        <li><a href="<?php echo site_url("index/logout");?>">Logout</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                <?php   $this->load->helper('form');
                $attributes = array('class' => 'navbar-search pull-right');
                echo form_open('home/search', $attributes);
                ?>
                    <input type="text" name="search" class="search-query" placeholder="Search">
                </form>
            </div>
        </div>

    </div>
</div>
