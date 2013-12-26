<div class="span8">
    <h3 align="center" class="text-info">Payment Details</h3>

    <a  title="Back to Orders List" class="btn btn-mini" href="<?php echo site_url("home/orders/view");?>/<?php echo $customerkey;?>" ><i class="icon-arrow-left"></i> Back</a>
    <a  title="Edit Order" class="btn btn-mini" href="<?php echo site_url("home/orders/edit");?>/<?php echo $customerkey;?>/<?php echo $data['pkey'];?>" ><i class="icon-edit"></i> Edit Order</a>
    <a  title="Remove Order" class="btn btn-mini" href="<?php echo site_url("home/orders/remove");?>/<?php echo $customerkey;?>/<?php echo $data['pkey'];?>" ><i class="icon-trash"></i> Delete Order</a>

    <br/><br/>

    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">

        <tr>
            <th>Type</th>
            <td><?php echo $data['order-type']; ?></td>
        </tr>
        <tr>
            <th>Amount</th>
            <td><?php echo $data['currency'].' '.$data['order-amount']; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo $data['order-status']; ?></td>
        </tr>
        <tr>
            <th>Start Date</th>
            <td><?php echo $data['order-start-date']; ?></td>
        </tr>
        <tr>
            <th>End Date</th>
            <td><?php echo $data['order-end-date']; ?></td>
        </tr>

        <tr>
            <th>Details</th>
            <td><?php echo $data['comment']; ?></td>
        </tr>

        <tr>
            <th>Charged</th>
            <td><?php if($data['charged']==1){echo 'Yes';}else{echo 'No';} ?></td>
        </tr>

    </table>

</div>