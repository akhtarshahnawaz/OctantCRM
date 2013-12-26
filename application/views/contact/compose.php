<div class="span8">


    <?php if(isset($status)):?>
    <?php if($status['status']):?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $status['message'];?>
        </div>
        <?php else: ?>

        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $status['message'];?>
        </div>
        <?php endif;?>
    <?php endif;?>

    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal');
    echo form_open('contact/index/sendmail', $attributes); ?>
    <br/><br/><br/>

    <fieldset>

        <div class="control-group">
            <label class="control-label" for="inputEmail">To</label>
            <div class="controls">
                <input type="text" name="to" class="input-xxlarge" value="<?php if(isset($to)){echo $to;}?>"  id="inputEmail" placeholder="">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputSubject">Subject</label>
            <div class="controls">
                <input type="text" name="subject"  class="input-xxlarge" id="inputSubject" placeholder="">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputMessage">Message</label>
            <div class="controls">
                <textarea name="message"  class="input-xxlarge" id="inputMessage">

                </textarea>
            </div>
        </div>



        <p class="offset3">
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="reset" class="btn">Reset</button>
        </p>
    </fieldset>
    </form>

</div>