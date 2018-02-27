<?php
	$tm = new Tm();

	require_once 'modules/books/modules.php';
	require_once 'modules/access/api.php';

	AccessAPI::check_permission("user",$tm);


	$modules = [
		[
			BooksModules::books_module(),
			BooksModules::json_books_module()
		]
	];


	$tm->display($modules);
?>