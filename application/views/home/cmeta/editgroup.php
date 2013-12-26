<div class="span8">



    <h2 class="text-info" align="center">Edit Group</h2>
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/cmeta/editgroup', $attributes); ?>
    <hr/></br></br></br></br>
        <fieldset>
            <input type="hidden" name="pkey" value="<?php echo $groupkey; ?>">
            <input type="hidden" name="customerkey" value="<?php echo $customerkey; ?>">

            <div class="input-append offset2">
                <input type="text" value="<?php echo $data['od-meta-category']; ?>" name="groupname" class="input-xlarge" id="inputGroup" placeholder="Group Name">
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </fieldset>
    </form>

</div>