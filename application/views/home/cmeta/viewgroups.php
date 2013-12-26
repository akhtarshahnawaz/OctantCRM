
<div class="span8">
    <h3 class="text-info" align="center">Groups</h3>
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

    <p> <a href="<?php echo site_url("home/cmeta/show");?>" class="btn btn-small"><i class="icon-arrow-left"></i> Back</a>
        <a href="<?php echo site_url("home/cmeta/addgroup");?>/<?php echo $customerkey;?>" class="btn btn-primary btn-small"><i class="icon-plus-sign"></i> Add Group</a></p>


    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Group Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>

        <?php foreach ($data as $rows):?>
        <tr>
            <td><?php echo $rows['od-meta-category'];?></td>
            <td><a href="<?php echo site_url("home/cmeta/addmeta");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">Add Data</a>
            <a href="<?php echo site_url("home/cmeta/getmeta");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">View Data</a>
            </td>
            <td><a  class="btn" href="<?php echo site_url("home/cmeta/editgroup");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-edit"></i></a>
            <a  class="btn" href="<?php echo site_url("home/cmeta/deletegroup");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-trash"></i></a></td>

        </tr>
        <?php endforeach;?>
    </table>


</div>