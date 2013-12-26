<div class="span8">
    <h1 class="text-info" align="center">Edit Payment</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/payment/edit', $attributes); ?>

    <fieldset>

        <hr/>

        <input type="hidden" name="pkey" value="<?php echo $data['pkey'];?>">

        <input type="hidden" name="customerkey" value="<?php echo $customerkey;;?>">

        <div class="control-group">
            <label class="control-label" for="inputAmount">Amount </label>
            <div class="controls">
                <input name="amount" type="text" value="<?php echo $data['od-amount']; ?>"  class="input-xlarge" id="inputAmount" placeholder="Amount">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputMethod">Payment Method</label>
            <div class="controls">
                <input name="paymentmethod" type="text" value="<?php echo $data['payment-method']; ?>"  class="input-xlarge" id="inputMethod" placeholder="Payment Method">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputType">Type</label>
            <div class="controls">
                <select name="paymenttype"  class="input-xlarge" id="inputType">
                    <option <?php if($data['type']=='Deposit'){echo 'selected';} ?>>Deposit</option>
                    <option <?php if($data['type']=='Spend'){echo 'selected';} ?>>Spend</option>
                    <option <?php if($data['type']=='Withdraw'){echo 'selected';} ?>>Withdraw</option>
                    <option <?php if($data['type']=='Buy'){echo 'selected';} ?>>Buy</option>

                </select>
            </div>
        </div>
            <div class="control-group">
                <label class="control-label" for="inputCurrency">Currency</label>
                <div class="controls">
                    <select name="currency"  class="input-xlarge" id="inputCurrency">
                        <option value="Rs" <?php if($data['currency']=='Rs'){echo 'selected';} ?>>INR</option>
                        <option value="$" <?php if($data['currency']=='$'){echo 'selected';} ?>>USD</option>
                    </select>
                </div>
            </div>

        <div class="control-group">
            <label class="control-label" for="inputDate">Date</label>
            <div class="controls">
                <input name="date"  value="<?php echo $data['date']; ?>"   type="text"  class="input-xlarge" id="inputDate" placeholder="Date">
            </div>
        </div>



        <div class="control-group">
                <label class="control-label" for="inputComment">Comment</label>
                <div class="controls">
                    <textarea name="comment"  class="input-xlarge" id="inputComment">
                        <?php echo $data['comment']; ?>
                    </textarea>
                </div>
         </div>
        <p class="offset2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn">Reset</button>
        </p>
    </fieldset>
    </form>

    </div>
<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" media="screen">
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#inputDate" ).datepicker();
    });
</script>