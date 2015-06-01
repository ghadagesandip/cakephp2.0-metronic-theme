<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3>Admin Users</h3>
            <ul class="breadcrumb">

                <li>
                    <i class="icon-home"></i>
                    <?php echo $this->Html->link(__('Home'), array('controller'=>'homes','action' => 'index')); ?>
                    <span class="icon-angle-right"></span>
                </li>
                <li>
                    <?php echo $this->Html->link(__('All  Users'), array('action' => 'index')); ?>
                    <span class="icon-angle-right"></span>
                </li>

                <li><a href="#">View User</a></li>
            </ul>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>View User Details </div>
                </div>
                <div class="portlet-body form">
                    <div class="clearfix">
                    </div>
                    <?php
                    echo $this->Form->create('User', array('id' => 'user_add_form', 'class' => 'form_validation_class form-horizontal', 'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    )));
                    $status_array = Configure::read('status_array');
                    ?>

                    <div class="control-group">
                        <label class="control-label" for="email">Email<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            echo $user['User']['email_address'];
                            ?>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="email">Username<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            echo $user['User']['username'];
                            ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Designation<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            echo $user['User']['designation'];
                            ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Contact Number<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            echo $user['User']['contact_number'];
                            ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="status">Status<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            if($user['User']['status']==1)
                            {echo "Active";}
                            else{echo "Inactive";}
                            ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Created<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            echo $user['User']['created'];
                            ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Modified<span class="required">*</span></label>
                        <div class="controls">
                            <?php
                            echo $user['User']['modified'];
                            ?>
                        </div>
                    </div>
                    <?php $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

