<div class="span8">
    <h1 align="center">Edit User</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('admin/user/edit', $attributes); ?>
    <fieldset>
        <hr/>
        <input type="hidden" name="pkey" value="<?php echo $data[0]['pkey'];?>">
        <div class="control-group">
            <label class="control-label" for="inputUsername">Username </label>
            <div class="controls">
                <input name="username" type="text"  class="input-xlarge" value="<?php echo $data[0]['od-username'];?>" placeholder="Username" id="inputUsername">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
            <div class="controls">
                <input name="password" type="text"  class="input-xlarge"  placeholder="Password" id="inputPassword">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputType">Type</label>
            <div class="controls">
                <select name="accounttype"  class="input-xlarge" id="inputType">
                    <option <?php if($data[0]['od-account-type'] == 'SuperUser'){echo 'selected';} ?>>SuperUser</option>
                    <option <?php if($data[0]['od-account-type'] == 'Admin'){echo 'selected';} ?>>Admin</option>
                    <option <?php if($data[0]['od-account-type'] == 'Manager'){echo 'selected';} ?>>Manager</option>
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
