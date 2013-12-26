<div class="span8">



    <h1 class="text-info" align="center">Add Lead</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/leads/add', $attributes); ?>


    <?php if(isset($status)):?>
    <?php if($status):?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Lead Added Successfully!
        </div>
        <?php else: ?>

        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> Unable to add Lead!
        </div>
        <?php endif;?>
    <?php endif;?>



        <fieldset>
            <legend>Personal Information</legend>
            <div class="control-group">
                <label class="control-label" for="inputEmail">First Name</label>
                <div class="controls">
                    <input type="text" name="firstname" class="input-xlarge" id="inputFirstName" placeholder="First Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Last Name</label>
                <div class="controls">
                    <input type="text" name="lastname"  class="input-xlarge" id="inputLastName" placeholder="Last Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Company</label>
                <div class="controls">
                    <input type="text" name="company"  class="input-xlarge" id="inputCompany" placeholder="Company">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Designation</label>
                <div class="controls">
                    <input type="text" name="designation"  class="input-xlarge" id="inputDesignation" placeholder="Designation">
                </div>
            </div>

            <legend>Contact Information</legend>

            <div class="control-group">
                <label class="control-label" for="inputEmail">E-Mail</label>
                <div class="controls">
                    <input type="text"  name="email"  class="input-xlarge" id="inputEmail" placeholder="Email">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Website</label>
                <div class="controls">
                    <input type="text"  name="website"  class="input-xlarge" id="inputWebsite" placeholder="Website">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Phone</label>
                <div class="controls">
                    <input type="text" name="phone"  class="input-xlarge" id="inputPhone" placeholder="Phone">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Address</label>
                <div class="controls">
                    <input type="text"  name="address"  class="input-xlarge" id="inputAddress" placeholder="Address">
                </div>
            </div>

            <legend>Lead Details</legend>

            <div class="control-group">
                <label class="control-label" for="inputDetails">Details</label>
                <div class="controls">
                    <textarea name="details"  class="input-xlarge" id="inputDetails">

                    </textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputStatus">Status</label>
                <div class="controls">
                    <select name="status"  class="input-xlarge" id="inputStatus">
                        <option value="Active">Active</option>
                        <option value="Potential">Potential</option>
                        <option value="Inactive">Inactive</option>

                    </select>
                </div>
            </div>

            <p class="offset2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn">Reset</button>
            </p>
        </fieldset>
    </form>

</div>