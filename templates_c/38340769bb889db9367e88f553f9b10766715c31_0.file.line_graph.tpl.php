<?php
/* Smarty version 3.1.30, created on 2018-02-27 16:14:41
  from "/home/cypper/Documents/localhost/templates/widgets/line_graph.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a9567d1b06328_73504941',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '38340769bb889db9367e88f553f9b10766715c31' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/line_graph.tpl',
      1 => 1519740877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a9567d1b06328_73504941 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('random', rand(1,2000));
?>
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

            <div id="echart_bar_graph<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
" style="height:350px;width: 100%;"></div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
    ;(function(){
        var bar_data = JSON.parse('<?php echo $_smarty_tpl->tpl_vars['vars']->value['json_data'];?>
');
        var graphs = bar_data.graphs;
        var names = bar_data.names;
        var dom = document.getElementById("echart_bar_graph<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
");
        var myChart = echarts.init(dom);

        var legendData = [];
        var xAxisData = [];
        var series = [];

        for (var iNames = 0; iNames < names.length; iNames++) {
            xAxisData.push(names[iNames]);
        }
        for (var iGraph = 0; iGraph < graphs.length; iGraph++) {
            var graph = graphs[iGraph];
            var serie = {};
            serie.name = graph.name;
            legendData.push(graph.name);
            serie.data = [];
            
            for (var iV = 0; iV < graph.v.length; iV++) {
                var v = graph.v[iV];
                serie.data.push(v);
            }

            serie.type = "line";
            serie.smooth = true;
            serie.areaStyle = {
                normal: {
                }
            };
            serie.label = {
                normal: {
                    show: true,
                    position: 'top'
                }
            };
            // serie.smooth = true;
            serie.animationDelay = function (idx) {
                return idx * 10;
            }
            series.push(serie);
        }
        // for (var i = 0; i < 100; i++) {
        //     xAxisData.push('类目' + i);
        //     data1.push((Math.sin(i / 5) * (i / 5 -10) + i / 6) * 5);
        //     data2.push((Math.cos(i / 5) * (i / 5 -10) + i / 6) * 5);
        // }

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


        var option = {
            title: {
                text: '<?php echo $_smarty_tpl->tpl_vars['vars']->value['title'];?>
'
            },
            legend: {
                data: legendData,
                align: 'left'
            },
            toolbox: {
                // y: 'bottom',
                feature: {
                    magicType: {
                        type: ['stack', 'tiled']
                    },
                    dataView: {},
                    saveAsImage: {
                        pixelRatio: 2
                    }
                }
            },
            tooltip: {},
            xAxis: {
                data: xAxisData,
                silent: false,
                splitLine: {
                    show: false
                }
            },
            yAxis: {
            },
            series: series,
            animationEasing: 'elasticOut',
            animationDelayUpdate: function (idx) {
                return idx * 5;
            },
            color: shuffle(["#3cb99a", "#34495d", "#3498db", "#11efb9", "#8abb6e", "#9b59b6", "#3dbb9c"])
        };

        myChart.setOption(option);
    })()
<?php echo '</script'; ?>
>
<?php }
}
