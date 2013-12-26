<div class="span8">
    <h3 class="text-info" align="center">Lead Information</h3>

    <a  title="Back to Leads List" class="btn btn-mini" href="<?php echo site_url("admin/trash/leads");?>" ><i class="icon-arrow-left"></i> Back</a>

    <br/><br/>
    <table class="table table-striped table-bordered">

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
    </table>

</div>