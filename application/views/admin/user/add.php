<div class="span8">
    <h1 align="center">Add User</h1>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('admin/user/add', $attributes); ?>
    <fieldset>
        <hr/>
        <div class="control-group">
            <label class="control-label" for="inputUsername">Username </label>
            <div class="controls">
                <input name="username" type="text"  class="input-xlarge"  placeholder="Username" id="inputUsername">
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
                    <option>SuperUser</option>
                    <option>Admin</option>
                    <option>Manager</option>
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
