<div class="span8">
    <h1 align="center" class="text-info">Add Order</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/orders/add', $attributes); ?>

    <fieldset>
        <h2 align="center" class="lead">Order will be added in name of <?php if(isset($name)) echo $name;?>.</h2>

        <hr/>

        <input type="hidden" name="pkey" value="<?php echo $pkey;?>">
        <input type="hidden" name="name" value="<?php echo $name;?>">

        <div class="control-group">
            <label class="control-label" for="inputType">Type </label>
            <div class="controls">
                <input name="type" type="text"  class="input-xlarge" id="inputType" placeholder="Order type"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputAmount">Amount</label>
            <div class="controls">
                <input name="amount" type="text"  class="input-xlarge" id="inputAmount" placeholder="Amount"/>
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
            <label class="control-label" for="inputStatus">Status</label>
            <div class="controls">
                <select name="status"  class="input-xlarge" id="inputStatus">
                    <option>Active</option>
                    <option>Pending</option>
                    <option>Cancelled</option>
                    <option>Completed</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputStartDate">Start Date </label>
            <div class="controls">
                <input name="startdate" type="text"  class="input-xlarge" id="inputStartDate" placeholder="Start Date"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputEndDate">End Date </label>
            <div class="controls">
                <input name="enddate" type="text"  class="input-xlarge" id="inputEndDate" placeholder="End Date"/>
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
        $( "#inputStartDate" ).datepicker();
        $( "#inputEndDate" ).datepicker();
    });
</script>