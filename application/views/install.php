<?php
$this->load->helper('url');
?>

  <?php
        $ci=& get_instance();
        $ci->load->library('session');
        $type=$ci->session->userdata('type');

        if($ci->session->flashdata('notification')){
            $alertType = $ci->session->flashdata('alertType');
            $notification = $ci->session->flashdata('notification');
            $hasNotification=true;
        }else{
            $hasNotification=false;
        }?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Octant CRM Installation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url().'assets/images/favicon.ico'; ?>" type="image/x-icon">

    <!-- Le styles -->
      <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
      <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
      <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="screen">

      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
<?php   $this->load->helper('form');
        $attributes = array('class' => 'form-signin');
        echo form_open('index/install', $attributes); ?>

        <h2 class="form-signin-heading"><img src="<?php echo base_url().'assets/images/logo.png';?>" alt="Logo"/></h2>

        
                <?php if($hasNotification): ?>
                <div class="alert <?php echo $alertType;?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $notification?>
                </div>
                <?php endif; ?>


        <input type="text" class="input-block-level" placeholder="Username" name="inputUsername">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <input type="password" class="input-block-level" placeholder="Verify Password" name="verifyPassword">
        <button class="btn btn-large btn-warning btn-block" type="submit"><i class="icon-lock"></i> Install</button>
      </form>

    </div>

    <p align="center" style="color: #ccc;">Designed and Developed by <a href="http://octantdesigners.com">Octant Designers</a></p>
        <p align="center" style="color: #ccc;">New Delhi (India)</a></p>


    <script src="<?php echo base_url();?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

  </body>
</html>
