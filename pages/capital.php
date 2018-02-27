<?php
	$tm = new Tm();

	require_once 'modules/access/api.php';
	require_once 'modules/capital/modules.php';

	AccessAPI::check_permission("capital", $tm);


	$modules = [
		[
			CapitalModules::capitalization_module()
		],[
			CapitalModules::wallets_module()
		],[
			CapitalModules::graph_per_month()
		],[
			CapitalModules::circles_wallets_module(),
			CapitalModules::circles_wallets_usd_module()
		]
	];


	$tm->display($modules);
?>