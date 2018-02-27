<?php
	$tm = new Tm();
	// require_once 'modules/diary.php';
	require_once 'modules/diary/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("user",$tm);


	$modules = [
		[
			DiaryModules::manage_ticket_module()
		],[
			DiaryModules::diary_data_module()
		]
	];


	$tm->display($modules);
?>