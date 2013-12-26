<?php
$CI =& get_instance();
$page=$CI->uri->segment(2);
$subpage = $CI->uri->segment(3);
?>

<div class="container">
    <div class="span3">
        <div class="well sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">Users</li>
                <li <?php if($page == 'index' && $subpage == 'sendmail'){ echo 'class="active"';} ?>><a href="<?php echo site_url("contact/index/sendmail");?>">Compose</a></li>
                <li <?php if($page == 'index' && $subpage == 'sentmail'){ echo 'class="active"';} ?>><a href="<?php echo site_url("contact/index/sentmail");?>">Sent Mails</a></li>


            </ul>
        </div>
    </div>