<div class="span8">
    <?php
    if($customers != null && $contacts !=null){
        echo '<h3 class="text-info" align="center">Search Result</h3>';
    }
    ?>

    <?php if($customers != null): ?>
    <h1 class="lead" align="center">Customers</h1>
    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Designation</th>
            <th scope="col"></th>
        </tr>

        <?php foreach ($customers as $rows):?>
        <tr>
            <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
            <td><?php echo $rows['od-company']; ?></td>
            <td><?php echo $rows['od-designation']; ?></td>
            <td>
                    <a href="<?php echo site_url("home/customers/view");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view full</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
        <?php endif; ?>


    <?php if($contacts != null): ?>
    <h1 class="lead" align="center">Leads</h1>
    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col"></th>
        </tr>

        <?php foreach ($contacts as $rows):?>
        <tr <?php if($rows['status'] == 'Active'){ echo 'class = "info"';}elseif($rows['status']=='Potential'){ echo 'class="success"';}?>>
            <td><?php echo $rows['od-firstname'].' '.$rows['od-lastname']; ?></td>
            <td><?php echo $rows['od-company']; ?></td>
            <td><?php echo $rows['od-email']; ?></td>
            <td><?php echo $rows['od-phone']; ?></td>
            <td>
                <a href="<?php echo site_url("home/leads/view");?>/<?php echo $rows['pkey'];?>" class="btn btn-primary btn-mini">view full</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <?php endif; ?>

    <?php
    if($customers == null && $contacts ==null){
        echo '<h1 align="center" class="text-error">Sorry! No search result found</h1>';
    }
    ?>
</div>