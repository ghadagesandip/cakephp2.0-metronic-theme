<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 2.3.1
Version: 1.3

-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
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
        '../assets/plugins/font-awesome/css/font-awesome.min','../assets/css/style-metro','../assets/css/style',
        '../assets/css/style-responsive','../assets/css/themes/default','../assets/plugins/uniform/css/uniform.default'
    ));
    ?>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo $this->Html->css(array('../assets/plugins/gritter/css/jquery.gritter','../assets/plugins/bootstrap-daterangepicker/daterangepicker','../assets/plugins/fullcalendar/fullcalendar/fullcalendar','../assets/plugins/jqvmap/jqvmap/jqvmap','../assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart'))?>
    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="favicon.ico" />


    <script type="text/javascript">
        var baseUrl = '<?php echo Router::url('/',true); ?>';
    </script>


</head>

<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<?php echo $this->element('top-header');?>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<?php echo $this->element('sidebar')?>
<!-- END SIDEBAR -->
<!-- BEGIN PAGE -->
<div class="page-content">
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div id="portlet-config" class="modal hide">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
    </div>
    <div class="modal-body">
        Widget settings form goes here
    </div>
</div>
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid">
    <?php echo $this->fetch('content'); ?>
</div>
<!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Metronic by keenthemes.
    </div>
    <div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<?php echo $this->Html->script(array('../assets/plugins/jquery-1.10.1.min','../assets/plugins/jquery-migrate-1.2.1.min'))?>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<?php echo $this->Html->script(array('../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min','../assets/plugins/bootstrap/js/bootstrap.min'))?>
<!--[if lt IE 9]>
<?php echo $this->Html->script(array('../assets/plugins/excanvas.min','../assets/plugins/respond.min'))?>
<![endif]-->
<?php echo $this->Html->script(array('../assets/plugins/jquery-slimscroll/jquery.slimscroll.min','../assets/plugins/jquery.blockui.min','../assets/plugins/jquery.cookie.min','../assets/plugins/uniform/jquery.uniform.min'))?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
    echo $this->Html->script(array('../assets/plugins/jqvmap/jqvmap/jquery.vmap','../assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia','../assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world','../assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe',
                '../assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany','../assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa','../assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata','../assets/plugins/flot/jquery.flot',
                '../assets/plugins/flot/jquery.flot.resize','../assets/plugins/jquery.pulsate.min','../assets/plugins/bootstrap-daterangepicker/date','../assets/plugins/bootstrap-daterangepicker/daterangepicker','../assets/plugins/gritter/js/jquery.gritter',
                '../assets/plugins/fullcalendar/fullcalendar/fullcalendar.min','../assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart','../assets/plugins/jquery.sparkline.min'
    ));
?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script(array('../assets/scripts/app','../assets/scripts/index'))?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        App.init(); // initlayout and core plugins
        Index.init();
        Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        Index.initCharts(); // init index page's custom scripts
        Index.initChat();
        Index.initMiniCharts();
        Index.initDashboardDaterange();
        Index.initIntro();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>

</html>
