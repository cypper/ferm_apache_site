<?php
	$tm = new Tm();

	require_once 'modules/access/api.php';
	require_once 'modules/capital/modules.php';

	AccessAPI::check_permission("capital", $tm);


	$modules = [
		[
			CapitalModules::items_per_month()
		],[
			CapitalModules::capital_per_month()
		],[
			CapitalModules::earnings_per_month()
		],[
			CapitalModules::items_module()
		],[
			CapitalModules::circle_wallets_module(),
			CapitalModules::circle_wallets_usd_module(),
			CapitalModules::circle_wallets_uah_module()
		]
	];


	$tm->display($modules);
?>