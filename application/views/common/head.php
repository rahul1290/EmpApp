<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>
	<?php 
		$pageTitle = isset($title) ? $title : 'Emp-Portal'; 
		print_r($pageTitle);
	?>
</title>
<link rel="stylesheet" href="<?php echo base_url('assets');?>/plugins/fontawesome-free/css/all.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/adminlte.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/css.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/ionicons.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/adminlte.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/jquery-ui.css" /> 
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/wickedpicker.min.css" /> 
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/select2-bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/bootstrap-duallistbox.min.css" />

<style>
	.main-sidebar {
		#background-color: #c7262b;
		background-color: #012f6a;
	}
	
	.main-header {
		background-color: #c7262b;
		#background-color: #012f6a;
	}
	.error {
		border-color : crimson !important;
	}
	
	.success {
		border-color : darkseagreen !important;
	}
	
	
</style>