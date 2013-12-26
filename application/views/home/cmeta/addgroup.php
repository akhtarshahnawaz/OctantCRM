<div class="span8">



    <h2 class="text-info" align="center">Add Group</h2>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/cmeta/addgroup', $attributes); ?>
    <hr/></br></br></br></br>
        <fieldset>
            <input type="hidden" name="pkey" value="<?php echo $pkey; ?>">
            <div class="input-append offset2">
                <input type="text" name="groupname" class="input-xlarge" id="inputGroup" placeholder="Group Name">
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </fieldset>
    </form>

</div>