<?php
$this->load->helper('date');
date_default_timezone_set('Asia/Kolkata');
?>
<div class="span8">
    <h3 class="text-info" align="center">Payments of Customer</h3>

    <h2 class="lead" align="center"><?php if(isset($name)) echo $name; ?></h2>
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
    <a  title="Back to Customers List" class="btn btn-mini" href="<?php echo site_url("home/payment/show");?>" ><i class="icon-arrow-left"></i> Back</a></td>
    <a  title="Add Payment" class="btn btn-primary btn-mini" href="<?php echo site_url("home/payment/add");?>/<?php echo $customerkey;?>" ><i class="icon-plus-sign"></i> Add Payment</a></td>

    <br/><br/>
    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Amount</th>
            <th scope="col">Method</th>
            <th scope="col">Type</th>
            <th scope="col"></th>

        </tr>

        <?php foreach ($data as $rows):?>
        <tr class="<?php if($rows['type'] == 'Deposit'){echo 'success';}elseif($rows['type'] == 'Spend'){ echo 'info';}elseif($rows['type'] == 'Withdraw'){ echo 'warning';}elseif($rows['type'] == 'Buy'){ echo 'error';}?>">
            <td><?php echo $rows['date'];?></td>
            <td><?php echo $rows['currency'].' '.$rows['od-amount']; ?></td>
            <td><?php echo $rows['payment-method']; ?></td>
            <td><?php echo $rows['type']; ?></td>
            <td>
            <a  class="btn" href="<?php echo site_url("home/payment/viewsingle");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-eye-open"></i></a>
            <a  class="btn" href="<?php echo site_url("home/payment/edit");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-edit"></i></a>
            <a  class="btn" href="<?php echo site_url("home/payment/remove");?>/<?php echo $customerkey;?>/<?php echo $rows['pkey'];?>" ><i class="icon-trash"></i></a></td>

        </tr>
        <?php endforeach;?>
    </table>
<?php
    $accountbalance_inr=$calculated['inr']['deposited']-($calculated['inr']['withdraw']+$calculated['inr']['spend']);
    if($accountbalance_inr<0){
        $odprofit_inr=($calculated['inr']['spend']+$accountbalance_inr)-$calculated['inr']['buy'];
    }else{
        $odprofit_inr=$calculated['inr']['spend']-$calculated['inr']['buy'];
    }
    $company_balance_inr=($calculated['inr']['spend']+$accountbalance_inr)-$calculated['inr']['buy'];


    $accountbalance_usd=$calculated['usd']['deposited']-($calculated['usd']['withdraw']+$calculated['usd']['spend']);
    if($accountbalance_usd<0){
        $odprofit_usd=($calculated['usd']['spend']+$accountbalance_usd)-$calculated['usd']['buy'];
    }else{
        $odprofit_usd=$calculated['usd']['spend']-$calculated['usd']['buy'];
    }
    $company_balance_usd=($calculated['usd']['spend']+$accountbalance_usd)-$calculated['usd']['buy'];

    ;?>
    <table width="100%" class="table table-condensed table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Total Deposited</th>
            <th scope="col">Total Spend</th>
            <th scope="col">Total Withdraw</th>
            <th scope="col">Total Buy</th>
            <th scope="col">Customer Balance</th>
        </tr>
        <tr>
            <td scope="col"><?php echo 'Rs. '.$calculated['inr']['deposited'].'</br>'; ?></td>
            <td scope="col"><?php echo 'Rs. '.$calculated['inr']['spend'].'</br>'; ?></td>
            <td scope="col"><?php echo 'Rs. '.$calculated['inr']['withdraw'].'</br>'; ?></td>
            <td scope="col"><?php echo 'Rs. '.$calculated['inr']['buy'].'</br>'; ?></td>
            <th scope="col" <?php if($accountbalance_inr<0)  {echo 'class="text-error"';} else {echo 'class="text-success"';} ?>><?php echo 'Rs. '.$accountbalance_inr; ?></th>
        </tr>
        <tr>
            <td scope="col"><?php echo '$   '; echo $calculated['usd']['deposited']; ?></td>
            <td scope="col"><?php echo '$   '.$calculated['usd']['spend']; ?></td>
            <td scope="col"><?php echo '$   '.$calculated['usd']['withdraw']; ?></td>
            <td scope="col"><?php echo '$   '.$calculated['usd']['buy']; ?></td>
            <th scope="col" <?php if($accountbalance_usd<0) {echo 'class="text-error"';} else {echo 'class="text-success"';} ?>><?php echo '$   '.$accountbalance_usd; ?></th>
        </tr>
    </table>

    <table width="100%" class="table table-hover table-striped table-bordered">
        <tr>
            <th scope="col">Company Profit</th>
            <th scope="col">Company Balance</th>
        </tr>
        <tr>
            <th scope="col" <?php if($odprofit_inr<0)  {echo 'class="text-error"';} else {echo 'class="text-success"';} ?>><?php echo 'Rs. '.$odprofit_inr; ?></th>
            <td scope="col"><?php echo 'Rs. '.$company_balance_inr.'</br>'; ?></td>

        </tr>
        <tr>
            <th scope="col" <?php if($odprofit_usd<0) {echo 'class="text-error"';} else {echo 'class="text-success"';} ?>><?php echo '$   '.$odprofit_usd; ?></th>
            <td scope="col"><?php echo '$   '.$company_balance_usd; ?></td>
        </tr>
    </table>

</div>