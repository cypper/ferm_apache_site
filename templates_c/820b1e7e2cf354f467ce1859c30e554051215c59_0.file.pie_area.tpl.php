<?php
/* Smarty version 3.1.30, created on 2018-02-27 15:44:05
  from "/home/cypper/Documents/localhost/templates/widgets/pie_area.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a9560a54c6409_19445347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '820b1e7e2cf354f467ce1859c30e554051215c59' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/pie_area.tpl',
      1 => 1519739036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a9560a54c6409_19445347 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('random', rand(1,2000));
?>
<div class="col-md-4 col-sm-4 col-xs-12">
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

			<div id="echart_pie<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
" style="height:350px;width: 100%;"></div>
		</div>
	</div>

		<?php echo '<script'; ?>
>
			function shuffle(a) {
			    var j, x, i;
			    for (i = a.length - 1; i > 0; i--) {
			        j = Math.floor(Math.random() * (i + 1));
			        x = a[i];
			        a[i] = a[j];
			        a[j] = x;
			    }
			    return a;
			}

			var dom = document.getElementById("echart_pie<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
");
			var myChart = echarts.init(dom);

			var option = {
			    title : {
			        text: '<?php echo $_smarty_tpl->tpl_vars['vars']->value['title'];?>
',
			        x:'center'
			    },
	
			    tooltip : {
			        trigger: 'item',
			        formatter: "{a} <br/>{b} : {c} ({d}%)"
			    },
	
			    legend: {
			        x : 'center',
			        y : 'bottom',
			        data:[
			        	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['data'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>'<?php echo $_smarty_tpl->tpl_vars['value']->value['key'];?>
',<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			        ]
			    },
	
			    toolbox: {
			        show : true,
			        feature : {
			            mark : {show: true},
			            dataView : {show: true, readOnly: true},
			            magicType : {
			                show: true,
			                type: ['pie', 'funnel']
			            },
			            restore : {show: true},
			            saveAsImage : {show: true}
			        }
			    },
	
			    calculable : true,
			    series : [
			        {
			            name: '<?php echo $_smarty_tpl->tpl_vars['vars']->value['title'];?>
',
			            type:'pie',
			            radius : [20, 110],
			            center : ['50%', '50%'],
			            roseType : 'radius',
			            label: {
			                normal: {
			                    show: true
			                },
			                emphasis: {
			                    show: true
			                }
			            },
			            data:[
			                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['data'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
			                	{
			                		value:<?php echo $_smarty_tpl->tpl_vars['value']->value['value'];?>
, name:'<?php echo $_smarty_tpl->tpl_vars['value']->value['key'];?>
'
			                	},
			                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			            ]
			        },
			    ],
			    color: shuffle(["#3cb99a", "#34495d", "#3498db", "#11efb9", "#8abb6e", "#9b59b6", "#3dbb9c"])
			};
			if (option && typeof option === "object") {
			    myChart.setOption(option);
			}
		<?php echo '</script'; ?>
>
</div><?php }
}
