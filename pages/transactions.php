<?php
	$tm = new Tm();
	require_once 'modules/transactions/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("transactions", $tm);



	$modules = [
		[
			TnsModules::add_transaction_module(),
			TnsModules::edit_transaction_module()
		],[
			TnsModules::transactions_module()
		]
	];


	$tm->display($modules);
?>