<div class="row-fluid">
    <div class="span6">
        <?php echo $this->Paginator->counter(
            'Page {:page} of {:pages}, showing {:current} records out of
             {:count} total, starting on record {:start}, ending on {:end}'
        );?>
    </div>
    <div class="span6 pull-right">
        <div class="dataTables_paginate paging_bootstrap pagination" style="margin: 0px;">
            <ul>
                <?php if ($this->Paginator->hasPrev()) { ?>
                    <li class="first">   <?php echo $this->Paginator->first('<< ' . __('  '), array(), null, array('class' => 'first disabled')); ?></li>                          
                    <li class="prev">   <?php echo $this->Paginator->prev('< ' . __(' previous '), array(), null, array('class' => 'prev disabled')); ?></li>                          
                <?php } ?>

                <?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a')); ?>

                <?php if ($this->Paginator->hasNext()) { ?>

                    <li class="next"><?php echo $this->Paginator->next(__(' next ') . ' >', array(), null, array('class' => 'next disabled')); ?></li>
                    <li class="last"><?php echo $this->Paginator->last(__(' ') . ' >>', array(), null, array('class' => 'last disabled')); ?></li>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>