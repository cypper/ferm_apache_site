{assign var='random' value=1|rand:2000}
<div class="col-md-6 col-sm-6 col-xs-12">
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
</div>


<script>
	{$sum=0}
	{foreach from=$vars.data item=value}
			{$sum=$sum+$value.value}
	{/foreach}
	var dom = document.getElementById("echart_pie{$random}");
	var myChart = echarts.init(dom);
	var labelTop = {
	    normal : {
	        label : {
	            show : true,
	            position : 'center',
	          {literal}
	            formatter : '{b}',
	          {/literal}
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
	                return (100*({$sum} - params.value)/{$sum}).toFixed(2) + '%'
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
	            {foreach from=$vars.data item=value}'{$value.key}',{/foreach}
	        ]
	    },
	    title : {
	        text: '{$vars.title}',
	        subtext: '',
	        x: 'center'
	    },
	    toolbox: {
	        show : true,
	        feature : {
	        	{literal}
	            dataView : {show: true, readOnly: false},
	         {/literal}
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
	        {$top=0}
	        {$el=0}
	        {foreach from=$vars.data item=value}
		        {
		            type : 'pie',
		            center : [ '{$el%5*15 + 20}%', {if $el<5} '30%' {else} '70%' {/if}],
		            radius : radius,
		            x: (100*({$sum} - {$value.value})/{$sum}).toFixed(2)+'%',
		            itemStyle : labelFromatter,
		            data : [
		                {
		                	name:'other', value:{($sum-$value.value)|round:2}, itemStyle : labelBottom
		                },{
		                	name:'{$value.key}', value:{$value.value|round:2},itemStyle : labelTop
		                }
		            ]
		        },
		        {$el=$el+1}
	        

	        {/foreach}
	        
	    ],
	    color: ["#3cb99a", "#34495d", "#3498db", "#11efb9", "#8abb6e", "#9b59b6", "#3dbb9c"]
	};

	if (option && typeof option === "object") {
	    myChart.setOption(option);
	}
</script>