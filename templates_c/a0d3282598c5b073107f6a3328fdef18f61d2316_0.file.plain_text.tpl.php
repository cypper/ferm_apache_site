<?php
/* Smarty version 3.1.30, created on 2018-02-06 03:54:53
  from "/home/cypper/Documents/localhost/templates/widgets/plain_text.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a790aed76d946_04893438',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0d3282598c5b073107f6a3328fdef18f61d2316' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/plain_text.tpl',
      1 => 1517794086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a790aed76d946_04893438 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
	<div class="col-md-<?php if (isset($_smarty_tpl->tpl_vars['vars']->value['size'])) {
echo $_smarty_tpl->tpl_vars['vars']->value['size'];
} else { ?>12<?php }?> col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $_smarty_tpl->tpl_vars['vars']->value['title'];?>
</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a>
							</li>
							<li><a href="#">Settings 2</a>
							</li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
					<h1><?php echo $_smarty_tpl->tpl_vars['vars']->value['header'];?>
</h1>
					<p><?php echo $_smarty_tpl->tpl_vars['vars']->value['subheader'];?>
</p>
			</div>
		</div>
	</div>
</div><?php }
}
