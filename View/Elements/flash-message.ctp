<?php if ($this->Session->check('Message.success')) { ?>
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close"></button>
        <?php echo $this->Session->flash('success'); ?>
    </div>
<?php }

if ($this->Session->check('Message.error')) { ?>
    <div class="alert alert-error">
        <button data-dismiss="alert" class="close"></button>
        <?php echo $this->Session->flash('error'); ?>
    </div>
<?php } ?>
