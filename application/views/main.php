<?php
$this->load->helper('date');
date_default_timezone_set('Asia/Kolkata');
?>
<div class="span8">

    <?php if(isset($data['activecustomers'])):?>

    <h3 class="text-info" align="center">Active Customers</h3>


    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Designation</th>
            <th scope="col"></th>
        </tr>


        <?php foreach ($data['activecustomers'] as $rows):?>
        <tr>
            <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
            <td><?php echo $rows['od-company']; ?></td>
            <td><?php echo $rows['od-designation']; ?></td>
            <td>
                <a href="<?php echo site_url("home/customers/view");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view</a>
                <a href="<?php echo site_url("home/customers/filemanager");?>/<?php echo $rows['pkey'];?>" class="btn btn-mini"><i class="icon-folder-open"></i> Browse Files</a>

            </td>
        </tr>
        <?php endforeach;?>
    </table>



    <h3 class="text-info" align="center">Active Orders</h3>
    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Ordered By</th>
            <th scope="col">Type</th>
            <th scope="col">Amount</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col"></th>

        </tr>

        <?php foreach ($data['activeorders'] as $rows):?>
        <?php foreach($data['activecustomers'] as $irows){
            if($irows['pkey']==$rows['fkey-customer-orders']){
                $customername = $irows['od-firstname'].' '.$irows['od-lastname'];                }
        }?>



        <?php if(isset($customername)): ?>
        <tr class="<?php if($rows['charged'] == 1){echo 'success';}elseif($rows['charged'] == 0){ echo 'error';}?>">
            <td><?php echo $customername; ?></td>
            <td><?php echo $rows['order-type'];?></td>
            <td><?php echo $rows['currency'].' '.$rows['order-amount']; ?></td>
            <td><?php echo $rows['order-start-date']; ?></td>
            <td><?php echo $rows['order-end-date']; ?></td>
        <td>
            <?php if($rows['charged'] == 0): ?>
            <a  title="Charge Order" class="btn" href="<?php echo site_url("home/orders/charge");?>/<?php echo $rows['fkey-customer-orders'];?>/<?php echo $rows['pkey'];?>/index" ><i class="icon-check"></i></a></td>
               <?php elseif($rows['charged'] == 1): ?>
            <a  title="Uncharge Order" class="btn" href="<?php echo site_url("home/orders/uncharge");?>/<?php echo $rows['fkey-customer-orders'];?>/<?php echo $rows['pkey'];?>/index" ><i class="icon-ban-circle"></i></a></td>
            <?php endif; ?>
            <?php endif; ?>
        </tr>
        <?php endforeach;?>
    </table>
<?php else:?>
<?php $nocod='<h2 align="center" class="text-warning">No Active Orders Found!</h2>'; ?>
<?php endif; ?>


<?php if($data['potentialleads']):?>

    <h3 class="text-info" align="center">Potential Leads</h3>


    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Designation</th>
            <th scope="col"></th>
        </tr>


        <?php foreach ($data['potentialleads'] as $rows):?>
        <tr>
            <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
            <td><?php echo $rows['od-company']; ?></td>
            <td><?php echo $rows['od-designation']; ?></td>
            <td>
                <a href="<?php echo site_url("home/leads/view");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
        <?php else: ?>
    <?php $nopotentialleads='<h2 align="center" class="text-warning">No Potential Leads Found!</h2>'; ?>
    <?php endif; ?>
<?php if($data['activeleads']): ?>

        <h3 class="text-info" align="center">Active Leads</h3>


        <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Company</th>
                <th scope="col">Designation</th>
                <th scope="col"></th>
            </tr>


            <?php foreach ($data['activeleads'] as $rows):?>
            <tr>
                <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
                <td><?php echo $rows['od-company']; ?></td>
                <td><?php echo $rows['od-designation']; ?></td>
                <td>
                    <a href="<?php echo site_url("home/leads/view");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    <?php else: ?>
    <?php $noactiveleads='<h2 align="center" class="text-warning">No Active Leads Found!</h2>'; ?>
    <?php endif; ?>

    <?php
    if(isset($nocod) && isset($noactiveleads) && isset($nopotentialleads)){
        echo '<h2 align="center" class="text-warning">No Active Tasks Found!</h2>';
    }
    ?>
</div>