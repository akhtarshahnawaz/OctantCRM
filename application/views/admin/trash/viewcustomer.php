<div class="span8">
    <h3 align="center" class="text-info">Customer Information</h3>

    <a  title="Back to Customers List" class="btn btn-mini" href="<?php echo site_url("admin/trash/customers");?>" >Back</a>

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