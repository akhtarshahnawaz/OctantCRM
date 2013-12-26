<div class="span8">
    <h3 align="center" class="text-info">Email</h3>

    <a  title="Back to Messages List" class="btn btn-mini" href="<?php echo site_url("contact/index/sentmail");?>"><i class="icon-arrow-left"></i> Back</a>
    <a  title="Delete Message" class="btn btn-mini btn-primary" href="<?php echo site_url("contact/index/remove");?>/<?php echo $data['pkey'];?>"><i class="icon-trash"></i> Delete</a>

    <br/><br/>

    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">

        <tr>
            <th>From</th>
            <td><?php echo $data['from']; ?></td>
        </tr>
        <tr>
            <th>To</th>
            <td><?php echo $data['to']; ?></td>
        </tr>
        <tr>
            <th>Subject</th>
            <td><?php echo $data['subject']; ?></td>
        </tr>
        <tr>
            <th>Message</th>
            <td><?php echo $data['message']; ?></td>
        </tr>

    </table>


</div>