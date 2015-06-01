<div class="page-sidebar nav-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="page-sidebar-menu">
        <li>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler hidden-phone"></div>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li>
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <form class="sidebar-search">
                <div class="input-box">
                    <a href="javascript:;" class="remove"></a>
                    <input type="text" placeholder="Search..." />
                    <input type="button" class="submit" value=" " />
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li class="start <?php if($this->request->controller=='homes') { ?>active <?php } ?>">
            <a href="<?php echo $this->Html->url(array('controller'=>'homes','action'=>'index'));?>">
                <i class="icon-home"></i>
                <span class="title">Home</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="start <?php if($this->request->controller=='roles') { ?>active <?php } ?>">
            <a href="<?php echo $this->Html->url(array('controller'=>'roles','action'=>'index'));?>">
                <i class="icon-home"></i>
                <span class="title">Roles</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="start <?php if($this->request->controller=='users') { ?>active <?php } ?>">
            <a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'index'));?>">
                <i class="icon-home"></i>
                <span class="title">Users</span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>