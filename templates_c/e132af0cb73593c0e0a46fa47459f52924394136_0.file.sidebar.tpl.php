<?php
/* Smarty version 3.1.30, created on 2018-02-27 16:00:14
  from "/home/cypper/Documents/localhost/templates/sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a95646e2eb339_10890880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e132af0cb73593c0e0a46fa47459f52924394136' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/sidebar.tpl',
      1 => 1519740012,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a95646e2eb339_10890880 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="/" class="site_title"><i class="fa fa-eercast" style="border: none;"></i> <span><?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
</span></a>
		</div>

		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/images/ferm.jpg" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Hi, <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</span>
				<h2><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</h2>
			</div>
		</div>
		<!-- /menu profile quick info -->

		<br />

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/"><i class="fa fa-home"></i> Dashboard</a></li>
					<li>
						<a><i class="fa fa-dollar"></i> Capital</a>
						<ul class="nav child_menu" style="display: none;">
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/capital">Capital</a></li>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/capital_more">Capital More</a></li>
						</ul>
					</li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/transactions"><i class="fa fa-home"></i> Transactions</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/investors"><i class="fa fa-home"></i> Investors</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/workers"><i class="fa fa-home"></i> Workers</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/file_maneger"><i class="fa fa-home"></i> File Maneger</a></li>
				</ul>
			</div>


		</div>
		<!-- /sidebar menu -->

		<!-- /menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div><?php }
}
