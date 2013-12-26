<div class="span8">


    <h3 class="text-info" align="center">Edit Lead</h3>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/leads/edit', $attributes); ?>
        <fieldset>
            <legend>Personal Information</legend>

            <input type="hidden" name="pkey" value="<?php echo $data['pkey'];?>">

            <div class="control-group">
                <label class="control-label" for="inputEmail">First Name</label>
                <div class="controls">
                    <input type="text" name="firstname" value="<?php echo $data['od-firstname'];?>" class="input-xlarge" id="inputFirstName" placeholder="First Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Last Name</label>
                <div class="controls">
                    <input type="text" name="lastname" value="<?php echo $data['od-lastname'];?>"   class="input-xlarge" id="inputLastName" placeholder="Last Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Company</label>
                <div class="controls">
                    <input type="text" name="company" value="<?php echo $data['od-company'];?>"   class="input-xlarge" id="inputCompany" placeholder="Company">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Designation</label>
                <div class="controls">
                    <input type="text" name="designation" value="<?php echo $data['od-designation'];?>"   class="input-xlarge" id="inputDesignation" placeholder="Designation">
                </div>
            </div>

            <legend>Contact Information</legend>

            <div class="control-group">
                <label class="control-label" for="inputEmail">E-Mail</label>
                <div class="controls">
                    <input type="text"  name="email" value="<?php echo $data['od-email'];?>"   class="input-xlarge" id="inputEmail" placeholder="Email">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Website</label>
                <div class="controls">
                    <input type="text"  name="website" value="<?php echo $data['od-website'];?>"   class="input-xlarge" id="inputWebsite" placeholder="Website">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Phone</label>
                <div class="controls">
                    <input type="text" name="phone" value="<?php echo $data['od-phone'];?>"   class="input-xlarge" id="inputPhone" placeholder="Phone">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Address</label>
                <div class="controls">
                    <input type="text"  name="address" value="<?php echo $data['od-address'];?>"   class="input-xlarge" id="inputAddress" placeholder="Address">
                </div>
            </div>

            <legend>Lead Details</legend>

            <div class="control-group">
                <label class="control-label" for="inputDetails">Details</label>
                <div class="controls">
                    <textarea name="details"  class="input-xlarge" id="inputDetails">
                        <?php echo $data['details'];?>
                    </textarea>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label" for="inputStatus">Status</label>
                <div class="controls">
                    <select name="status"  class="input-xlarge" id="inputStatus">
                        <option <?php if($data['status']=='Active'){ echo 'selected';} ?> value="Active">Active</option>
                        <option <?php if($data['status']=='Potential'){ echo 'selected';} ?> value="Potential">Potential</option>
                        <option <?php if($data['status']=='Inactive'){ echo 'selected';} ?> value="Inactive">Inactive</option>

                    </select>
                </div>
            </div>

            <p class="offset2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="reset" class="btn">Reset</button>
            </p>
        </fieldset>
    </form>

</div>