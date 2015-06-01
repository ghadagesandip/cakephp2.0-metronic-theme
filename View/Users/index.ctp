<div class="row-fluid">
    <div class="span12">
        <h3>Users</h3>
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <?php echo $this->Html->link(__('Home'), array('controller'=>'homes','action'=>'index')); ?>
                <span class="icon-angle-right"></span>
            </li>

            <li>
                <span> Users</span>
            </li>
        </ul>
        <div class="portlet box light-grey">
            <?php echo $this->element('flash-message'); ?>
            <div class="portlet-title">
                <div class="caption"><i class="icon-globe"></i><?php echo __('Users'); ?></div>
            </div>
            <div class="portlet-body">
                <div class="clearfix">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="btn-group">
                                <a href="<?php echo $this->Html->url(array('action'=>'add'));?>" class="btn green"><i class="icon-plus"></i> Add User </a>
                            </div>
                        </div>
                        <div class="span6">
                            <?php echo $this->element('admin_search'); ?>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th class="hidden-480"><?php echo $this->Paginator->sort('role_id', 'User'); ?></th>
                        <th class="hidden-480"><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
                        <th class="hidden-480"><?php echo $this->Paginator->sort('email_address', 'Email Address'); ?></th>
                        <th class="hidden-480"><?php echo $this->Paginator->sort('created', 'Created On'); ?></th>
                        <th class="hidden-480"><?php echo $this->Paginator->sort('modified', 'Modified'); ?></th>
                        <th colspan="3" class="center hidden-480">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($users)) {
                        foreach ($users as $user) { ?>
                            <tr class="odd gradeX">
                                <td class="center hidden-480"><?php echo h($user['Role']['role_name']); ?>&nbsp;</td>
                                <td class="center hidden-480"><?php echo $this->Function->getFormatedDateTime($user['User']['username']); ?>&nbsp;</td>
                                <td class="center hidden-480"><?php echo $this->Function->getFormatedDateTime($user['User']['email_address']); ?>&nbsp;</td>
                                <td class="center hidden-480"><?php echo $this->Function->getFormatedDateTime($user['User']['created']); ?>&nbsp;</td>
                                <td class="center hidden-480"><?php echo $this->Function->getFormatedDateTime($user['User']['modified']); ?>&nbsp;</td>
                                <td class="action_button_width">
                                    <span ><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn blue')); ?> </span>
                                    <span class="delete_button">
                                    <?php
                                        echo $this->Form->postLink(
                                            'Delete',
                                            array('action' => 'delete', $user['User']['id']),
                                            array('confirm' => 'Are you sure?','class'=>'btn red')
                                        );
                                        ?>
                                    </span>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    else {  ?>
                        <tr><td colspan="7">No record found.</td></tr>
                    <?php }

                    ?>
                    </tbody>
                </table>
                <?php echo $this->element('pagination'); ?>
            </div>
        </div>
    </div>
</div>