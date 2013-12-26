
<div class="span8">
    <h3 class="text-info" align="center"><?php echo $groupname; ?></h3>
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
    <p> <a href="<?php echo site_url("home/cmeta/viewgroups");?>/<?php echo $pkey;?>" class="btn btn-small"><i class="icon-arrow-left"></i> Back</a>

     <a href="<?php echo site_url("home/cmeta/addmeta");?>/<?php echo $pkey;?>/<?php echo $groupkey;?>" class="btn btn-primary btn-small"><i class="icon-plus-sign"></i> Add Data</a></p>

        <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <?php foreach ($data as $rows):?>
        <tr>
            <th><?php echo $rows['od-meta-key'];?></th>
            <td><?php echo $rows['od-meta-value'];?></td>
            <td><a class="btn" href="<?php echo site_url("home/cmeta/editmeta");?>/<?php echo $groupkey;?>/<?php echo $rows['pkey'];?>"><i class="icon-edit"></i></a> <a class="btn" href="<?php echo site_url("home/cmeta/deletemeta");?>/<?php echo $groupkey;?>/<?php echo $rows['pkey'];?>"><i class="icon-trash"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>

</div>