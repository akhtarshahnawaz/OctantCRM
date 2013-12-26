<div class="span8">



    <h1 class="text-info" align="center">Add Customer</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/customers/add', $attributes); ?>
    <?php if(isset($status)):?>
        <?php if($status):?>

        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Customer Added Successfully!
    </div>
            <?php else: ?>

        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> Unable to add customer!
        </div>
        <?php endif;?>
    <?php endif;?>

        <fieldset>
            <legend>Personal Information</legend>

            <div class="control-group">
                <label class="control-label" for="inputFirstName">First Name</label>
                <div class="controls">
                    <input type="text" name="firstname" class="input-xlarge" id="inputFirstName" placeholder="First Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputLastName">Last Name</label>
                <div class="controls">
                    <input type="text" name="lastname"  class="input-xlarge" id="inputLastName" placeholder="Last Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputCompany">Company</label>
                <div class="controls">
                    <input type="text" name="company"  class="input-xlarge" id="inputCompany" placeholder="Company">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputDesignation">Designation</label>
                <div class="controls">
                    <input type="text" name="designation"  class="input-xlarge" id="inputDesignation" placeholder="Designation">
                </div>
            </div>

            <legend>Contact Information</legend>

            <div class="control-group">
                <label class="control-label" for="inputEmail1">E-Mail 1</label>
                <div class="controls">
                    <input  name="email1" type="email"  class="input-xlarge" id="inputEmail1" placeholder="Primary Email">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputEmail2">E-Mail 2</label>
                <div class="controls">
                    <input  name="email2" type="email"  class="input-xlarge" id="inputEmail2" placeholder="Secondary Email">
                </div>
            </div>



            <div class="control-group">
                <label class="control-label" for="inputPhone1">Phone 1</label>
                <div class="controls">
                    <input type="text" name="phone1"  class="input-xlarge" id="inputPhone1" placeholder="Primary Phone">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputPhone2">Phone 2</label>
                <div class="controls">
                    <input type="text" name="phone2"  class="input-xlarge" id="inputPhone2" placeholder="Secondary Phone">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputWebsite">Website</label>
                <div class="controls">
                    <input type="text"  name="website"  class="input-xlarge" id="inputWebsite" placeholder="Website">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputAddress">Address</label>
                <div class="controls">
                    <input type="text"  name="address"  class="input-xlarge" id="inputAddress" placeholder="Address">
                </div>
            </div>


            <p class="offset2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn">Reset</button>
            </p>
        </fieldset>
    </form>

</div>