<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3>Users</h3>
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <?php echo $this->Html->link(__('Home'), array('controller'=>'homes','action' => 'index')); ?>
                    <span class="icon-angle-right"></span>
                </li>
                <li>
                    <?php echo $this->Html->link(__('All Users'), array('action' => 'index')); ?>
                    <span class="icon-angle-right"></span>
                </li>
                <li><a href="#">Edit User</a></li>
            </ul>
            <div class="portlet box blue">
                <?php echo $this->element('flash-message'); ?>
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>Edit User Details</div>

                </div>
                <div class="portlet-body form">
                    <div class="clearfix">
                    </div>
                    <?php
                    echo $this->Form->create('User', array('class' => 'form_validation_class form-horizontal form-bordered form-label-stripped', 'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    )));

                    ?>

                    <div class="control-group">
                        <label class="control-label" for="email">Role<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $this->Form->input('id'); ?>
                            <?php echo $this->Form->input('role_id'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Email<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $this->Form->input('email_address'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Username<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $this->Form->input('username'); ?>
                        </div>
                    </div>


                    <div class="form-actions">
                        <?php echo $this->Form->input(__('<i class="icon-ok"></i>Submit'), array('type' => 'button', "class" => "submit btn blue")); ?>
                        <button type="reset" id='cmdCancel' class="btn">Reset</button>
                        <a class="btn" href="<?php echo $this->Html->url(array('action'=>'index'))?>">Back</a>
                    </div>
                    <?php $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
