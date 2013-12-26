<div class="span8">
    <h3 class="text-info" align="center">Lead Information</h3>

    <a  title="Back to Leads List" class="btn btn-mini" href="<?php echo site_url("home/leads/show");?>" ><i class="icon-arrow-left"></i> Back</a>
    <a title="Edit Lead" href="<?php echo site_url("home/leads/edit");?>/<?php echo $data['pkey'];?>" class="btn btn-mini"><i class="icon-edit"></i> Edit</a>
    <a title="Delete Lead" href="<?php echo site_url("home/leads/trash");?>/<?php echo $data['pkey'];?>" class="btn btn-mini"><i class="icon-trash"></i> Delete</a>
    <a  title="Upgrade to Customer" class="btn btn-primary btn-mini" href="<?php echo site_url("home/leads/upgrade");?>/<?php echo $data['pkey'];?>" >Upgrade to Customer</a>

    <br/><br/>
    <table class="table table-striped table-bordered">

        <tr <?php if($data['status'] == 'Active'){ echo 'class = "info"';}elseif($data['status']=='Potential'){ echo 'class="success"';}?>>
            <th>Status</th>
            <td><?php echo $data['status']; ?></td>
        </tr>
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
            <th>E-Mail</th>
            <td><?php echo $data['od-email']; ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php echo $data['od-phone']; ?></td>
        </tr>
        <tr>
            <th>Website</th>
            <td><?php echo $data['od-website']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $data['od-address']; ?></td>
        </tr>
        <tr>
            <th>Details</th>
            <td><?php echo $data['details']; ?></td>
        </tr>
    </table>

</div>