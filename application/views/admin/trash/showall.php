<div class="span8">
    <h3 class="text-info" align="center">Trash</h3>


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
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col"></th>
        </tr>

        <?php foreach ($data as $rows):?>
        <tr>
            <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
            <td><?php echo $rows['od-company']; ?></td>
            <td><?php if(isset($rows['emailp'])){ echo $rows['emailp'];}elseif(isset($rows['od-email'])){echo $rows['od-email'];}  ?></td>
            <td><?php if(isset($rows['phonep'])){ echo $rows['phonep'];}elseif(isset($rows['od-phone'])){echo $rows['od-phone'];}  ?></td>
            <td>

                <div class="btn-group">
                    <?php if($type == 'customer'): ?>
                        <a href="<?php echo site_url("admin/trash/viewcustomer");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view</a>
                    <?php elseif($type == 'lead'): ?>
                        <a href="<?php echo site_url("admin/trash/viewlead");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view</a>
                    <?php endif; ?>
            <button class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url("admin/trash/putback");?>/<?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?>/<?php echo $rows['pkey']; ?>/<?php echo $type; ?>">Put Back</a></li>
                        <li><a href="<?php echo site_url("admin/trash/remove");?>/<?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?>/<?php echo $rows['pkey']; ?>/<?php echo $type; ?>">Delete</a></li>
                        <!-- dropdown menu links -->
                    </ul>
                </div>

            </td>
        </tr>
        <?php endforeach;?>
    </table>

</div>
