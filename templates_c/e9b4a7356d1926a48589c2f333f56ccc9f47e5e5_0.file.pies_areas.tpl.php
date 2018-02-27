<?php
/* Smarty version 3.1.30, created on 2018-02-07 21:16:50
  from "/home/cypper/Documents/localhost/templates/widgets/pies_areas.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a7b50a2e798b0_46441715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9b4a7356d1926a48589c2f333f56ccc9f47e5e5' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/pies_areas.tpl',
      1 => 1517538266,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a7b50a2e798b0_46441715 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('random', rand(1,2000));
?>
<div class="col-md-6 col-sm-6 col-xs-12">
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
</div>


<?php echo '<script'; ?>
>
	<?php $_smarty_tpl->_assignInScope('sum', 0);
?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['data'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
			<?php $_smarty_tpl->_assignInScope('sum', $_smarty_tpl->tpl_vars['sum']->value+$_smarty_tpl->tpl_vars['value']->value['value']);
?>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	var dom = document.getElementById("echart_pie<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
");
	var myChart = echarts.init(dom);
	var labelTop = {
	    normal : {
	        label : {
	            show : true,
	            position : 'center',
	          
	            formatter : '{b}',
	          
	            textStyle: {
	                baseline : 'bottom'
	            }
	        },
	        labelLine : {
	            show : false
	        }
	    }
	};
	var labelFromatter = {
	    normal : {
	        label : {
	            formatter : function (params){
	                return (100*(<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
 - params.value)/<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
).toFixed(2) + '%'
	            },
	            textStyle: {
	                baseline : 'top'
	            }
	        }
	    },
	}
	var labelBottom = {
	    normal : {
	        color: '#ccc',
	        label : {
	            show : true,
	            position : 'center'
	        },
	        labelLine : {
	            show : false
	        }
	    },
	    emphasis: {
	        color: 'rgba(0,0,0,0)'
	    }
	};
	var radius = [40, 55];
	var option = {
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
	    title : {
	        text: '<?php echo $_smarty_tpl->tpl_vars['vars']->value['title'];?>
',
	        subtext: '',
	        x: 'center'
	    },
	    toolbox: {
	        show : true,
	        feature : {
	        	
	            dataView : {show: true, readOnly: false},
	         
	            magicType : {
	                show: true, 
	                type: ['pie', 'funnel'],
	                option: {
	                    funnel: {
	                        width: '20%',
	                        height: '30%',
	                        itemStyle : {
	                            normal : {
	                                label : {
	                                    formatter : function (params){
	                                        return 'other\n' + params.value + '%\n'
	                                    },
	                                    textStyle: {
	                                        baseline : 'middle'
	                                    }
	                                }
	                            },
	                        } 
	                    }
	                }
	            },
	            restore : {
	            	show: true
	            },
	            saveAsImage : {
	            	show: true
	            }
	        }
	    },
	   series : [
	        <?php $_smarty_tpl->_assignInScope('top', 0);
?>
	        <?php $_smarty_tpl->_assignInScope('el', 0);
?>
	        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['data'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
		        {
		            type : 'pie',
		            center : [ '<?php echo $_smarty_tpl->tpl_vars['el']->value%5*15+20;?>
%', <?php if ($_smarty_tpl->tpl_vars['el']->value < 5) {?> '30%' <?php } else { ?> '70%' <?php }?>],
		            radius : radius,
		            x: (100*(<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['value']->value['value'];?>
)/<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
).toFixed(2)+'%',
		            itemStyle : labelFromatter,
		            data : [
		                {
		                	name:'other', value:<?php echo round(($_smarty_tpl->tpl_vars['sum']->value-$_smarty_tpl->tpl_vars['value']->value['value']),2);?>
, itemStyle : labelBottom
		                },{
		                	name:'<?php echo $_smarty_tpl->tpl_vars['value']->value['key'];?>
', value:<?php echo round($_smarty_tpl->tpl_vars['value']->value['value'],2);?>
,itemStyle : labelTop
		                }
		            ]
		        },
		        <?php $_smarty_tpl->_assignInScope('el', $_smarty_tpl->tpl_vars['el']->value+1);
?>
	        

	        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	        
	    ],
	    color: ["#3cb99a", "#34495d", "#3498db", "#11efb9", "#8abb6e", "#9b59b6", "#3dbb9c"]
	};

	if (option && typeof option === "object") {
	    myChart.setOption(option);
	}
<?php echo '</script'; ?>
><?php }
}
