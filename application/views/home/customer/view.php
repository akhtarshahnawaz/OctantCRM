<div class="span8">
    <h3 align="center" class="text-info">Customer Information</h3>

    <a  title="Back to Customers List" class="btn btn-mini" href="<?php echo site_url("home/customers/show");?>" >Back</a>
    <a  title="View Orders" class="btn btn-mini" href="<?php echo site_url("home/orders/view");?>/<?php echo $data['pkey'];?>" ><i class="icon-eye-open"></i> View Order</a>
    <a  title="Add Order" class="btn btn-mini btn-success" href="<?php echo site_url("home/orders/add");?>/<?php echo $data['pkey'];?>" ><i class="icon-plus"></i> Add Order</a>
    <a  title="View Payment" class="btn btn-mini" href="<?php echo site_url("home/payment/view");?>/<?php echo $data['pkey'];?>" ><i class="icon-eye-open"></i> View Payment</a>
    <a  title="Add Payment" class="btn btn-mini btn-success" href="<?php echo site_url("home/payment/add");?>/<?php echo $data['pkey'];?>" ><i class="icon-plus-sign"></i> Add Payment</a>
    <a title="Edit Customer" href="<?php echo site_url("home/customers/edit");?>/<?php echo $data['pkey'];?>" class="btn btn-mini "><i class="icon-edit"></i> Edit</a>
    <a title="Delete Customer" href="<?php echo site_url("home/customers/delete");?>/<?php echo $data['pkey'];?>" class="btn btn-mini"><i class="icon-trash"></i> Delete</a>
    <a href="<?php echo site_url("home/customers/filemanager");?>/<?php echo $data['pkey'];?>" class="btn btn-mini  btn-primary"><i class="icon-folder-open"></i> Browse Files</a>
    <a href="<?php echo site_url("home/customers/printit");?>/<?php echo $data['pkey'];?>" target="_blank" class="btn btn-mini  btn-danger"><i class="icon-print"></i> Print</a>

    <br/><br/>

    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">

    <tr>
            <th>Name</th>
            <td><?php echo $data['od-firstname'].' '.$data['od-lastname']; ?></td>
        </tr>
        <tr>
            <th>Company</th>
            <td><?php echo $data['od-company']; ?></td>
        </tr>
        <tr>
            <th>Designation</th>
            <td><?php echo $data['od-designation']; ?></td>
        </tr>
    <tr>
            <th>E-Mail (Primary)</th>
            <td><?php echo $data['emailp']; ?></td>
        </tr>
        <tr>
            <th>E-Mail (Secondary)</th>
            <td><?php echo $data['emails']; ?></td>
        </tr>
        <tr>
            <th>Phone (Primary)</th>
            <td><?php echo $data['phonep']; ?></td>
        </tr>
        <tr>
            <th>Phone (Secondary)</th>
            <td><?php echo $data['phones']; ?></td>
        </tr>
        <tr>
            <th>Website</th>
            <td><?php echo $data['website']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $data['address']; ?></td>
        </tr>
    </table>

    <?php foreach($meta as $okey=>$ovalue):?>

    <?php if(isset($ovalue) && $ovalue!=null): ?>
        <h3 class="text-info" align="center"><?php echo $okey; ?></h3>
        <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
            <?php foreach($ovalue as $ikey=>$ivalue):?>
            <tr>
                <th><?php echo $ikey;?></th>
                <td><?php echo $ivalue;?></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php endif; ?>
    <?php endforeach;?>

</div>