<?php
	/// DEVELOPTMENT
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('disable_functions', '');
	error_reporting(E_ALL);
	session_start();

	////////////////
	// STARTED PACK
	//////////////

	require './config.php';

	////////////////
	// LOAD LIBS
	//////////////

	require './libs/mysqli.php';
	require './libs/utilities.php';
	require('./libs/Smarty/SmartyBC.class.php');
	// require './core/mysqli.php';
	// require './core/parser.php';
	// require './core/site_controller.php';
	// require './core/route.php';

	///////////////
	// CONTROLLERS
	/////////////

	require './controllers/access.php';
	require './controllers/templates.php';
	require './controllers/routing.php';
	require './controllers/api.php';


	///////////
	// INITING
	/////////

	$MQ = new MQ();
	// $MG->get_all_vars(MG_DB,"capital");
	// $MG->collection_from_json();

	// exit();


	///////////
	// ROUTING
	/////////

	$route = new Route();

	$route->dispatch();


?>