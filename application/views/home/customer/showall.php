<div class="span8"">

    <h1 class="text-info" align="center">Customers</h1>
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
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
        </tr>

        <?php foreach ($data as $rows):?>
        <tr>
            <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
            <td><?php echo $rows['od-company']; ?></td>
            <td><?php echo $rows['phonep']; ?></td>
            <td><?php echo $rows['emailp']; ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?php echo site_url("home/customers/view");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view</a>
                    <button class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url("home/customers/edit");?>/<?php echo $rows['pkey'];?>"><i class="icon-edit"></i> Edit</a></li>
                        <li><a href="<?php echo site_url("home/customers/trash");?>/<?php echo $rows['pkey'];?>"><i class="icon-trash"></i> Move to Trash</a></li>
                        <!-- dropdown menu links -->
                    </ul>
                </div>
                <a href="<?php echo site_url("home/customers/filemanager");?>/<?php echo $rows['pkey'];?>" class="btn btn-mini"><i class="icon-folder-open"></i> Browse Files</a>

            </td>
        </tr>
        <?php endforeach;?>
    </table>

</div>