<?php
$CI =& get_instance();
$page=$CI->uri->segment(2);
$subpage = $CI->uri->segment(3);
?>
<div class="container">
    <div class="span3">
        <div class="well sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">Active Customers</li>
                <li <?php if($page == 'customers' && $subpage == 'add'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/customers/add");?>">Add Customer</a></li>
                <li <?php if($page == 'customers' && $subpage == 'show'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/customers/show");?>">All Customers</a></li>

                <li class="nav-header">Customers Meta</li>
                <li <?php if($page == 'cmeta' && $subpage == 'show'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/cmeta/show");?>">Customer Meta</a></li>

                <li class="nav-header">Leads</li>
                <li <?php if($page == 'leads' && $subpage == 'add'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/leads/add");?>">Add Lead</a></li>
                <li <?php if($page == 'leads' && $subpage == 'show'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/leads/show");?>">All Leads</a></li>

                <li class="nav-header">Payments</li>
                <li <?php if($page == 'payment' && $subpage == 'show'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/payment/show");?>">Payments</a></li>

                <li class="nav-header">Orders</li>
                <li <?php if($page == 'orders' && $subpage == 'show'){ echo 'class="active"';} ?>><a href="<?php echo site_url("home/orders/show");?>">Orders</a></li>

            </ul>
        </div>
    </div>