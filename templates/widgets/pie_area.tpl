{assign var='random' value=1|rand:2000}
<div class="col-md-4 col-sm-4 col-xs-12">
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

			<div id="echart_pie{$random}" style="height:350px;width: 100%;"></div>
		</div>
	</div>

		<script>
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

			var dom = document.getElementById("echart_pie{$random}");
			var myChart = echarts.init(dom);

			var option = {
			    title : {
			        text: '{$vars.title}',
			        x:'center'
			    },
	{literal}
			    tooltip : {
			        trigger: 'item',
			        formatter: "{a} <br/>{b} : {c} ({d}%)"
			    },
	{/literal}
			    legend: {
			        x : 'center',
			        y : 'bottom',
			        data:[
			        	{foreach from=$vars.data item=value}'{$value.key}',{/foreach}
			        ]
			    },
	{literal}
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
	{/literal}
			    calculable : true,
			    series : [
			        {
			            name: '{$vars.title}',
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
			                {foreach from=$vars.data key=key item=value}
			                	{
			                		value:{$value.value}, name:'{$value.key}'
			                	},
			                {/foreach}
			            ]
			        },
			    ],
			    color: shuffle(["#3cb99a", "#34495d", "#3498db", "#11efb9", "#8abb6e", "#9b59b6", "#3dbb9c"])
			};
			if (option && typeof option === "object") {
			    myChart.setOption(option);
			}
		</script>
</div>