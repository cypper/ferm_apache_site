<?php
/* Smarty version 3.1.30, created on 2018-02-06 03:54:53
  from "/home/cypper/Documents/localhost/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a790aed764845_63765358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ca093b087196cf182ca77afa6a9fdba9a087cc3' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/index.tpl',
      1 => 1517684358,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 2,
    'file:sidebar.tpl' => 1,
    'file:widgets/".((string)$_smarty_tpl->tpl_vars[\'file\']->value).".tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5a790aed764845_63765358 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
	<html lang="en">
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=710, initial-scale=1">

		<title><?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
</title>

		<!-- Bootstrap -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- iCheck -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
		
		<!-- bootstrap-progressbar -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
		<!-- JQVMap -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
		<!-- bootstrap-daterangepicker -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/css/custom.css" rel="stylesheet">
		<!-- <link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/build/css/custom.min.css" rel="stylesheet"> -->
	<!-- jQuery -->
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/jquery/dist/jquery.min.js"><?php echo '</script'; ?>
>

		<!-- <?php echo '<script'; ?>
 type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/3.8.5/echarts.min.js"><?php echo '</script'; ?>
> -->
		<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/js/echarts/echarts.min.js"><?php echo '</script'; ?>
>

	</head>

		<!-- <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 -->
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<?php $_smarty_tpl->_subTemplateRender("file:sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


				<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


				<div class="right_col" role="main">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
						<div class="row">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value, 'col');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['col']->value) {
?>
							
							<?php $_smarty_tpl->_assignInScope('file', $_smarty_tpl->tpl_vars['col']->value['widget']);
?>

							<?php $_smarty_tpl->_subTemplateRender("file:widgets/".((string)$_smarty_tpl->tpl_vars['file']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('vars'=>$_smarty_tpl->tpl_vars['col']->value['vars']), 0, true);
?>


						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						</div>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


				</div>

				<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			</div>
		</div>
	</body>

	<!-- Bootstrap -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<!-- FastClick -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/fastclick/lib/fastclick.js"><?php echo '</script'; ?>
>
	<!-- NProgress -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/nprogress/nprogress.js"><?php echo '</script'; ?>
>
	<!-- Chart.js -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/Chart.js/dist/Chart.min.js"><?php echo '</script'; ?>
>
	<!-- gauge.js -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/gauge.js/dist/gauge.min.js"><?php echo '</script'; ?>
>
	<!-- bootstrap-progressbar -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"><?php echo '</script'; ?>
>
	<!-- iCheck -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/iCheck/icheck.min.js"><?php echo '</script'; ?>
>
	<!-- Skycons -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/skycons/skycons.js"><?php echo '</script'; ?>
>
	<!-- Flot -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/Flot/jquery.flot.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/Flot/jquery.flot.pie.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/Flot/jquery.flot.time.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/Flot/jquery.flot.stack.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/Flot/jquery.flot.resize.js"><?php echo '</script'; ?>
>
	<!-- Flot plugins -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/flot.orderbars/js/jquery.flot.orderBars.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/flot-spline/js/jquery.flot.spline.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/flot.curvedlines/curvedLines.js"><?php echo '</script'; ?>
>
	<!-- DateJS -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/DateJS/build/date.js"><?php echo '</script'; ?>
>
	<!-- JQVMap -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/jqvmap/dist/jquery.vmap.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/jqvmap/dist/maps/jquery.vmap.world.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"><?php echo '</script'; ?>
>
	<!-- bootstrap-daterangepicker -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/moment/min/moment.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap-daterangepicker/daterangepicker.js"><?php echo '</script'; ?>
>

	<!-- Custom Theme Scripts -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/js/custom.js"><?php echo '</script'; ?>
>

</html>

<?php }
}
