{assign var='random' value=1|rand:2000}
<div class="col-md-{if isset($vars.size)}{$vars.size}{else}12{/if} col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{$vars.title}</h2>
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

            <div id="echart_bar_graph{$random}" style="height:350px;width: 100%;"></div>
        </div>
    </div>
</div>

<script>
    ;(function(){
        var bar_data = JSON.parse('{$vars.json_data}');
        var graphs = bar_data.graphs;
        var names = bar_data.names;
        var dom = document.getElementById("echart_bar_graph{$random}");
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
            if (!graph.opt) graph.opt = {};
            for(var iOpt in graph.opt) {
                var opt = graph.opt[iOpt];
                serie[iOpt] = opt;
            }


            // serie.type = "line";
            // serie.smooth = true;
            // serie.areaStyle = {
            //     normal: {
            //     }
            // };
            // serie.label = {
            //     normal: {
            //         show: true,
            //         position: 'top'
            //     }
            // };
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
                text: '{$vars.title}'
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
                    show: true
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
</script>
