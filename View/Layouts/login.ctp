<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>

    <?php echo $this->Html->charset(); ?>
    <meta charset="utf-8" />
    <title><?php echo $this->fetch('title'); ?></title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>



    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?php
    echo $this->Html->css(array('../assets/plugins/bootstrap/css/bootstrap.min','../assets/plugins/bootstrap/css/bootstrap-responsive.min',
        '../assets/plugins/font-awesome/css/font-awesome.min','../assets/css/style-metro','../assets/css/style','../assets/css/style',
        '../assets/css/style-responsive','../assets/css/themes/default','../assets/plugins/uniform/css/uniform.default'
    ));
    ?>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo $this->Html->css('../assets/css/pages/login')?>
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript">
        var baseUrl = '<?php echo Router::url('/',true); ?>';
    </script>
</head>

<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <?php echo $this->html->image('../assets/img/logo-big.png',array('alt'=>''))?>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<?php echo $this->fetch('content'); ?>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2013 &copy; Metronic. Admin Dashboard Template.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<?php echo $this->Html->script(array('../assets/plugins/jquery-1.10.1.min','../assets/plugins/jquery-migrate-1.2.1.min'));?>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<?php echo $this->Html->script(array('../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min','../assets/plugins/bootstrap/js/bootstrap.min'));?>
<!--[if lt IE 9]>
<?php echo $this->Html->script(array('../assets/plugins/excanvas.min','../assets/plugins/respond.min'));?>
<![endif]-->
<?php echo $this->Html->script(array('../assets/plugins/jquery-slimscroll/jquery.slimscroll.min','../assets/plugins/jquery.blockui.min','../assets/plugins/jquery.cookie.min','../assets/plugins/uniform/jquery.uniform.min'));?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script(array('../assets/plugins/jquery-validation/dist/jquery.validate.min'));?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script(array('../assets/scripts/app','../assets/scripts/login'));?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        App.init();
        Login.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>

</html>
