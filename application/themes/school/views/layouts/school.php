<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8">
<title><?php print Settings_model::$db_config['site_title']; ?>:<?php print $template['title']; ?></title>
<?php print $template['metadata']; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php print base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/global/plugins/datatables/extensions/ColVis/dataTables.colVis.css"/>
<link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.css"/>

<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->

<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php print base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php print base_url(); ?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php print base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="<?php print base_url(); ?>css/themes/<?php print Settings_model::$db_config['default_theme']; ?>/custom.css" type="text/css" media="screen" />

<?php 
$controller_name = $this->router->fetch_class(); 
?>
<?php
$this->load->view('generic/js_base_url',array('controller_name'=>$controller_name));
$this->load->view('generic/js_language_files');
?>
<!--<script src="<?php print base_url(); ?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> -->
<script src="<?php print base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php print base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<?php
	$ci =& get_instance();
	$cotroller = $ci->router->fetch_class();
	$cotroller_methodname = $ci->router->fetch_method();
?>
<script type="text/javascript">
$(document).ready(function() {
	/*$.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
		if(oSettings.oFeatures.bServerSide === false){
			var before = oSettings._iDisplayStart;
	 
			oSettings.oApi._fnReDraw(oSettings);
	 
			// iDisplayStart has been reset to zero - so lets change it back
			oSettings._iDisplayStart = before;
			oSettings.oApi._fnCalculateEnd(oSettings);
		}
		  
		// draw the 'current' page
		oSettings.oApi._fnDraw(oSettings);
	};*/
});
</script>
</head>
<?php $controller_name = $this->router->fetch_class();  ?>
<body class="<?php if($controller_name == 'login') { echo "login"; } ?>" >
	<?php print $template['partials']['header']; ?>
	<?php if($controller_name != "login") { ?>
	<!-- BEGIN PAGE CONTAINER -->
	<div class="page-container">
		
		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content"> 
			<div class="container-fluid">
	<?php } ?> 
				<?php print $template['body']; ?>
	<?php if($controller_name != "login") { ?>
			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>
	<!-- END PAGE CONTAINER -->
	<?php } ?> 

	<?php print $template['partials']['footer']; ?>

	<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php print base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<script src="<?php print base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>assets/global/plugins/datatables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php print base_url(); ?>assets/global/plugins/icheck/icheck.min.js"></script>	
	<script src="<?php print base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>

	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	
	<script src="<?php print base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php print base_url(); ?>assets/global/scripts/datatable.js"></script>
	<script src="<?php print base_url(); ?>assets/global/scripts/components-pickers.js"></script>
	 
    <script src="<?php print base_url(); ?>assets/pages/scripts/form-fileupload.js"></script>
	<!--<script src="<?php print base_url(); ?>assets/pages/scripts/table-ajax.js"></script>-->
	<!-- END PAGE LEVEL SCRIPTS -->

	<script type="text/javascript" src="<?php print base_url(); ?>js/underscore-min.js"></script>
    <script type="text/javascript" src="<?php print base_url(); ?>js/backbone-min.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>js/jQuery/jq_functions.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>js/custom.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js?t=6"></script>
	<script>
	jQuery(document).ready(function() {    
	   Metronic.init(); // init metronic core componets
	   Layout.init(); // init layout
	   Demo.init(); // init demo(theme settings page)
	   //ComponentsPickers.init();
	   //Index.init(); // init index page
	   //Tasks.initDashboardWidget(); // init tash dashboard widget
	   //TableAjax.init();
	   
	});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
</html>
