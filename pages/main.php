<?php
	$tm = new Tm();
	require_once 'modules/transactions/modules.php';
	require_once 'modules/capital/modules.php';
	require_once 'modules/workers/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("main", $tm);


	$modules = [
		[
			CapitalModules::capitalization_module()
		],[
			CapitalModules::circle_wallets_usd_module(),
			WorkersModules::status_module(["size"=>8]),
		],[
			TnsModules::transactions_module()
		]
	];


	$tm->display($modules);
?>