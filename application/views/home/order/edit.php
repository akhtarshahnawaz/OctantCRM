<div class="span8">
    <h1 align="center" class="text-info">Edit Order</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/orders/edit', $attributes); ?>

    <fieldset>

        <hr/>

        <input type="hidden" name="pkey" value="<?php echo $data['pkey'];?>">
        <input type="hidden" name="customerkey" value="<?php echo $customerkey;?>">

        <div class="control-group">
            <label class="control-label" for="inputType">Type </label>
            <div class="controls">
                <input name="type" type="text" value="<?php echo $data['order-type'];?>"  class="input-xlarge" id="inputType" placeholder="Order type"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputAmount">Amount</label>
            <div class="controls">
                <input name="amount" type="text" value="<?php echo $data['order-amount'];?>"  class="input-xlarge" id="inputAmount" placeholder="Amount"/>
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
            <label class="control-label" for="inputStatus">Status</label>
            <div class="controls">
                <select name="status"  class="input-xlarge" id="inputStatus">
                    <option  <?php if($data['order-status']=='Active'){echo 'selected';} ?>>Active</option>
                    <option  <?php if($data['order-status']=='Pending'){echo 'selected';} ?>>Pending</option>
                    <option  <?php if($data['order-status']=='Cancelled'){echo 'selected';} ?>>Cancelled</option>
                    <option  <?php if($data['order-status']=='Completed'){echo 'selected';} ?>>Completed</option>

                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputStartDate">Start Date </label>
            <div class="controls">
                <input name="startdate"  value="<?php echo $data['order-start-date'];?>"   type="text"  class="input-xlarge" id="inputStartDate" placeholder="Start Date"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputEndDate">End Date </label>
            <div class="controls">
                <input name="enddate" type="text"  value="<?php echo $data['order-end-date'];?>"   class="input-xlarge" id="inputEndDate" placeholder="End Date"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputComment">Comment</label>
            <div class="controls">
                <textarea name="comment"  class="input-xlarge" id="inputComment">
                    <?php echo $data['comment'];?>
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
        $( "#inputStartDate" ).datepicker();
        $( "#inputEndDate" ).datepicker();
    });
</script>