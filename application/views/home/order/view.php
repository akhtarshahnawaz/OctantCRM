<?php
$this->load->helper('date');
date_default_timezone_set('Asia/Kolkata');
?>
<div class="span8">
    <h3 class="text-info" align="center">Orders of Customer</h3>

    <h2 class="lead" align="center"><?php if(isset($name)) echo $name; ?></h2>

    <?php if(isset($status)):?>
    <?php if($status['status']):?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $status['message'];?>
        </div>
        <?php else: ?>

        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $status['message'];?>
        </div>
        <?php endif;?>
    <?php endif;?>
    <a  title="Back to Customers List" class="btn btn-mini" href="<?php echo site_url("home/orders/show");?>" ><i class="icon-arrow-left"></i> Back</a></td>
    <a  title="Add Order" class="btn btn-primary btn-mini" href="<?php echo site_url("home/orders/add");?>/<?php echo $customerkey;?>" ><i class="icon-plus-sign"></i> Add Order</a></td>

    <br/><br/>
    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col"></th>

        </tr>

        <?php foreach ($data as $rows):?>
        <tr class="<?php if($rows['order-status'] == 'Active'){echo 'success';}elseif($rows['order-status'] == 'Cancelled'){ echo 'error';}elseif($rows['order-status'] == 'Completed'){ echo 'info';}elseif($rows['order-status'] == 'Pending'){ echo 'warning';}?>">
            <td><?php echo substr($rows['order-type'],0,20).'..'; ?></td>
            <td><?php echo $rows['currency'].' '.$rows['order-amount']; ?></td>
            <td><?php echo $rows['order-status']; ?></td>
            <td><?php echo $rows['order-start-date']; ?></td>
            <td><?php echo $rows['order-end-date']; ?></td>

        <td>
            <a  class="btn" href="<?php echo site_url("home/orders/viewsingle");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-eye-open"></i></a>

            <a title="Edit Order"  class="btn" href="<?php echo site_url("home/orders/edit");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-edit"></i></a>
            <a  title="Delete Order" class="btn" href="<?php echo site_url("home/orders/remove");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-trash"></i></a>
               <?php if($rows['charged'] == 0): ?>
            <a  title="Charge Order" class="btn" href="<?php echo site_url("home/orders/charge");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-check"></i></a></td>
               <?php elseif($rows['charged'] == 1): ?>
            <a  title="Uncharge Order" class="btn" href="<?php echo site_url("home/orders/uncharge");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-ban-circle"></i></a></td>
               <?php endif; ?>

        </tr>
        <?php endforeach;?>
    </table>





</div>