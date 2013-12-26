<div class="span8">
    <h1 class="text-info" align="center">Add Payment</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/payment/add', $attributes); ?>

    <fieldset>
        <h2 class="lead" align="center">Payment will go in account of <?php if(isset($name)) echo $name;?>.</h2>

        <hr/>

        <input type="hidden" name="pkey" value="<?php echo $uid;?>">
        <input type="hidden" name="name" value="<?php echo $name;?>">

        <div class="control-group">
            <label class="control-label" for="inputAmount">Amount </label>
            <div class="controls">
                <input name="amount" type="text"  class="input-xlarge" id="inputAmount" placeholder="Amount">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputMethod">Payment Method</label>
            <div class="controls">
                <input name="paymentmethod" type="text"  class="input-xlarge" id="inputMethod" placeholder="Payment Method">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputType">Type</label>
            <div class="controls">
                <select name="paymenttype"  class="input-xlarge" id="inputType">
                    <option>Deposit</option>
                    <option>Spend</option>
                    <option>Withdraw</option>
                    <option>Buy</option>

                </select>
            </div>
        </div>
            <div class="control-group">
                <label class="control-label" for="inputCurrency">Currency</label>
                <div class="controls">
                    <select name="currency"  class="input-xlarge" id="inputCurrency">
                        <option value="Rs">INR</option>
                        <option value="$">USD</option>
                    </select>
                </div>
            </div>

        <div class="control-group">
            <label class="control-label" for="inputDate">Date</label>
            <div class="controls">
                <input name="date" type="text"  class="input-xlarge" id="inputDate" placeholder="Date">
            </div>
        </div>


         <div class="control-group">
                <label class="control-label" for="inputComment">Comment</label>
                <div class="controls">
                    <textarea name="comment"  class="input-xlarge" id="inputComment">

                    </textarea>
                </div>
         </div>
        <p class="offset2">
            <button type="submit" class="btn btn-primary">Submit</button>
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