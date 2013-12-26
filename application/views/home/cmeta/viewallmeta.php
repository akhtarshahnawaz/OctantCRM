
<div class="span8">

<?php if($data != null): ?>
    <?php foreach($data as $okey=>$ovalue):?>
        <h3 class="text-info" align="center"><?php echo $okey; ?></h3>
        <?php if(isset($ovalue) && $ovalue!=null): ?>
                <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
                    <?php foreach($ovalue as $ikey=>$ivalue):?>
                        <tr>
                            <th><?php echo $ikey;?></th>
                            <td><?php echo $ivalue;?></td>
                        </tr>
                    <?php endforeach;?>
                </table>
        <?php else: ?>
            <p class="text-error lead" align="center">This group has no data in it!</p>
            <?php endif; ?>
    <?php endforeach;?>
    <?php else: ?>
    <h2 class="text-error" align="center">No Meta Values for this Customer!</h2>
    <?php endif;?>
</div>