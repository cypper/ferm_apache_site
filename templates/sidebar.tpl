<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="/" class="site_title"><i class="fa fa-eercast" style="border: none;"></i> <span>{$main_title}</span></a>
		</div>

		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="{$assets}/images/ferm.jpg" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Hi, {$username}</span>
				<h2>{$username}</h2>
			</div>
		</div>
		<!-- /menu profile quick info -->

		<br />

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
					<li><a href="{$root}/"><i class="fa fa-home"></i> Dashboard</a></li>
					<li>
						<a><i class="fa fa-dollar"></i> Capital</a>
						<ul class="nav child_menu" style="display: none;">
							<li><a href="{$root}/capital">Capital</a></li>
							<li><a href="{$root}/capital_more">Capital More</a></li>
						</ul>
					</li>
					<li><a href="{$root}/transactions"><i class="fa fa-home"></i> Transactions</a></li>
					<li><a href="{$root}/investors"><i class="fa fa-home"></i> Investors</a></li>
					<li><a href="{$root}/workers"><i class="fa fa-home"></i> Workers</a></li>
					<li><a href="{$root}/file_maneger"><i class="fa fa-home"></i> File Maneger</a></li>
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
</div>