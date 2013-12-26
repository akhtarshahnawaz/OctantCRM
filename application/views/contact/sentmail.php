<div class="span8">
    <h3 class="text-info" align="center">Sent Mail</h3>

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


    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col"></th>

        </tr>

        <?php foreach ($data as $rows):?>
        <tr>
            <td><?php echo substr($rows['from'],0,20).'..'; ?></td>
            <td><?php echo substr($rows['to'],0,20).'..'; ?></td>
            <td><?php echo substr($rows['subject'],0,20).'..'; ?></td>
            <td><?php echo substr($rows['message'],0,20).'..'; ?></td>
            <td>
                <a  title="View Message" class="btn btn-mini" href="<?php echo site_url("contact/index/view");?>/<?php echo $rows['pkey'] ?>" ><i class="icon-eye-open"></i> </a>
                <a  title="Delete Message" class="btn btn-mini" href="<?php echo site_url("contact/index/remove");?>/<?php echo $rows['pkey'] ?>" ><i class="icon-trash"></i> </a>

            </td>
        </tr>
        <?php endforeach;?>
    </table>

</div>