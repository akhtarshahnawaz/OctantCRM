<div class="span8">

    <h3 class="text-info" align="center">Edit Customer Information</h3>

    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/customers/edit', $attributes);
    ?>
    <fieldset>
        <legend>Personal Information</legend>

        <input type="hidden" name="pkey" value="<?php echo $data['pkey'];?>">

        <div class="control-group">
            <label class="control-label" for="inputFirstName">First Name</label>
            <div class="controls">
                <input type="text" name="firstname" value="<?php echo $data['od-firstname'];?>" class="input-xlarge" id="inputFirstName" placeholder="First Name">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputLastName">Last Name</label>
            <div class="controls">
                <input type="text" name="lastname" value="<?php echo $data['od-lastname'];?>"   class="input-xlarge" id="inputLastName" placeholder="Last Name">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputCompany">Company</label>
            <div class="controls">
                <input type="text" name="company" value="<?php echo $data['od-company'];?>"   class="input-xlarge" id="inputCompany" placeholder="Company">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputDesignation">Designation</label>
            <div class="controls">
                <input type="text" name="designation" value="<?php echo $data['od-designation'];?>"   class="input-xlarge" id="inputDesignation" placeholder="Designation">
            </div>
        </div>

        <legend>Contact Information</legend>

        <div class="control-group">
            <label class="control-label" for="inputEmail1">E-Mail 1</label>
            <div class="controls">
                <input type="text"  name="email1" value="<?php echo $data['emailp'];?>"   class="input-xlarge" id="inputEmail1" placeholder="Primary Email">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputEmail2">E-Mail 2</label>
            <div class="controls">
                <input type="text"  name="email2" value="<?php echo $data['emails'];?>"   class="input-xlarge" id="inputEmail2" placeholder="Secondary Email">
            </div>
        </div>



        <div class="control-group">
            <label class="control-label" for="inputPhone1">Phone 1</label>
            <div class="controls">
                <input type="text" name="phone1" value="<?php echo $data['phonep'];?>"   class="input-xlarge" id="inputPhone1" placeholder="Primary Phone">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputPhone2">Phone 2</label>
            <div class="controls">
                <input type="text" name="phone2" value="<?php echo $data['phones'];?>"   class="input-xlarge" id="inputPhone2" placeholder="Secondary Phone">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputWebsite">Website</label>
            <div class="controls">
                <input type="text"  name="website" value="<?php echo $data['website'];?>"   class="input-xlarge" id="inputWebsite" placeholder="Website">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputAddress">Address</label>
            <div class="controls">
                <input type="text"  name="address" value="<?php echo $data['address'];?>"   class="input-xlarge" id="inputAddress" placeholder="Address">
            </div>
        </div>


        <p class="offset2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="reset" class="btn">Reset</button>
        </p>
    </fieldset>
    </form>

</div>