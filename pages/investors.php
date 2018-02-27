<?php
	$tm = new Tm();
	require_once 'modules/transactions/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("investors", $tm);

	// Structure

	$modules = [
		[
			TnsModules::investors_module(),
		]
	];


	$tm->display($modules);
?>