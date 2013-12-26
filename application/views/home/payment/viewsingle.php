<div class="span8">
    <h3 align="center" class="text-info">Payment Details</h3>

    <a  title="Back to Payments List" class="btn btn-mini" href="<?php echo site_url("home/payment/view");?>/<?php echo $customerkey;?>" ><i class="icon-arrow-left"></i> Back</a>
    <a  title="Delete Payment" class="btn btn-mini" href="<?php echo site_url("home/payment/edit");?>/<?php echo $customerkey;?>/<?php echo $data['pkey'];?>" ><i class="icon-edit"></i> Edit Payment</a>
    <a  title="Edit Payment" class="btn btn-mini" href="<?php echo site_url("home/payment/remove");?>/<?php echo $customerkey;?>/<?php echo $data['pkey'];?>" ><i class="icon-trash"></i> Delete Payment</a>

    <br/><br/>

    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">

        <tr>
            <th>Date</th>
            <td><?php echo $data['date']; ?></td>
        </tr>
        <tr>
            <th>Amount</th>
            <td><?php echo $data['currency'].' '.$data['od-amount']; ?></td>
        </tr>
        <tr>
            <th>Method</th>
            <td><?php echo $data['payment-method']; ?></td>
        </tr>
        <tr>
            <th>Type</th>
            <td><?php echo $data['type']; ?></td>
        </tr>
        <tr>
            <th>Details</th>
            <td><?php echo $data['comment']; ?></td>
        </tr>

    </table>

</div>