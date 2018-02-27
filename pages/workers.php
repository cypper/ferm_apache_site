<?php
	$tm = new Tm();

	require_once 'modules/workers/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("workers", $tm);

	$modules = [
		[
			WorkersModules::status_module(),
			WorkersModules::gpus_status_module(),
			WorkersModules::dump_all_data_module(),
		]
	];

	$tm->display($modules);
?>