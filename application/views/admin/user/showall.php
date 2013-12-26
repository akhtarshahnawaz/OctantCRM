<div class="span8">

    <h1 align="center">Users</h1>


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
            <th scope="col">Username</th>
            <th scope="col">Designation</th>
            <th scope="col"></th>
        </tr>

        <?php foreach ($data as $rows):?>
        <tr>
            <td><?php echo $rows['od-username']; ?></td>
            <td><?php echo $rows['od-account-type']; ?></td>
            <td><a class="btn" href="<?php echo site_url("admin/user/edit");?>/<?php echo $rows['pkey'];?>"><i class="icon-edit"></i></a> <a class="btn" href="<?php echo site_url("admin/user/remove");?>/<?php echo $rows['pkey'];?>"><i class="icon-trash"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>

</div>