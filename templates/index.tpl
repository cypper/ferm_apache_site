<!DOCTYPE html>
	<html lang="en">
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=710, initial-scale=1">

		<title>{$main_title}</title>

		<!-- Bootstrap -->
		<link href="{$assets}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{$assets}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="{$assets}/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- iCheck -->
		<link href="{$assets}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
		
		<!-- bootstrap-progressbar -->
		<link href="{$assets}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
		<!-- JQVMap -->
		<link href="{$assets}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
		<!-- bootstrap-daterangepicker -->
		<link href="{$assets}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="{$assets}/css/custom.css" rel="stylesheet">
		<!-- <link href="{$assets}/build/css/custom.min.css" rel="stylesheet"> -->
	<!-- jQuery -->
		<script src="{$assets}/vendors/jquery/dist/jquery.min.js"></script>

		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/3.8.5/echarts.min.js"></script> -->
		<script type="text/javascript" src="{$assets}/js/echarts/echarts.min.js"></script>

	</head>

		<!-- {include file="header.tpl" } -->
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				{include file="sidebar.tpl"}

				{include file="header.tpl"}

				<div class="right_col" role="main">
					{foreach from=$modules item=row}
						<div class="row">
						{foreach from=$row item=col}
							
							{$file=$col.widget}

							{include file="widgets/$file.tpl" vars=$col.vars}

						{/foreach}
						</div>
					{/foreach}

				</div>

				{include file="footer.tpl"}
			</div>
		</div>
	</body>

	<!-- Bootstrap -->
	<script src="{$assets}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="{$assets}/vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="{$assets}/vendors/nprogress/nprogress.js"></script>
	<!-- Chart.js -->
	<script src="{$assets}/vendors/Chart.js/dist/Chart.min.js"></script>
	<!-- gauge.js -->
	<script src="{$assets}/vendors/gauge.js/dist/gauge.min.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="{$assets}/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="{$assets}/vendors/iCheck/icheck.min.js"></script>
	<!-- Skycons -->
	<script src="{$assets}/vendors/skycons/skycons.js"></script>
	<!-- Flot -->
	<script src="{$assets}/vendors/Flot/jquery.flot.js"></script>
	<script src="{$assets}/vendors/Flot/jquery.flot.pie.js"></script>
	<script src="{$assets}/vendors/Flot/jquery.flot.time.js"></script>
	<script src="{$assets}/vendors/Flot/jquery.flot.stack.js"></script>
	<script src="{$assets}/vendors/Flot/jquery.flot.resize.js"></script>
	<!-- Flot plugins -->
	<script src="{$assets}/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
	<script src="{$assets}/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
	<script src="{$assets}/vendors/flot.curvedlines/curvedLines.js"></script>
	<!-- DateJS -->
	<script src="{$assets}/vendors/DateJS/build/date.js"></script>
	<!-- JQVMap -->
	<script src="{$assets}/vendors/jqvmap/dist/jquery.vmap.js"></script>
	<script src="{$assets}/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
	<script src="{$assets}/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="{$assets}/vendors/moment/min/moment.min.js"></script>
	<script src="{$assets}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="{$assets}/js/custom.js"></script>

</html>

