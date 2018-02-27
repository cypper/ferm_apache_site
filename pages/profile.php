<?php
	$tm = new Tm();
	require_once 'modules/user/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("user", $tm);



	$modules = [
		[
			UserModules::all_user_data_module()
		]
	];


	$tm->display($modules);
?>