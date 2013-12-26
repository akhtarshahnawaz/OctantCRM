
<div class="span8">
    <h3 class="text-info" align="center">Crm Statistics</h3>


    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <?php foreach ($data as $key => $value):?>
        <tr>
            <th><?php echo $key; ?></th>
            <td><?php echo $value; ?></td>
        </tr>
        <?php endforeach;?>
    </table>

</div>