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
                <li <?php if($page == 'user' && $subpage == 'add'){ echo 'class="active"';} ?>><a href="<?php echo site_url("admin/user/add");?>">Add User</a></li>
                <li <?php if($page == 'user' && $subpage == 'showall'){ echo 'class="active"';} ?>><a href="<?php echo site_url("admin/user/showall");?>">All User</a></li>


                <li class="nav-header">Trash</li>
                <li <?php if($page == 'trash' && $subpage == 'customers'){ echo 'class="active"';} ?>><a href="<?php echo site_url("admin/trash/customers");?>">Customers</a></li>
                <li <?php if($page == 'trash' && $subpage == 'leads'){ echo 'class="active"';} ?>><a href="<?php echo site_url("admin/trash/leads");?>">Leads</a></li>

            </ul>
        </div>
    </div>