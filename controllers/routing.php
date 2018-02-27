<?php
	
	/**
	* ROUTE
	*/
	class Route
	{
		function __construct() {
			$parsed_url = parse_url($_SERVER['REQUEST_URI']);

			$request = explode('/', $parsed_url["path"]);

			$request = array_splice($request,1);

			$this->action = $request[0];
			$this->params = array_splice($request, 1);
		}
		function exit_404() {
			header("HTTP/1.0 404 Not Found");
			echo "Not Found";
			exit("<h1>404</h1>");
		}
		function dispatch() {
			$PARAMS = $this->params;
			if ($this->action == 'login') {
				$tm = new Tm();
				$tm->display_page('login.tpl');
				return;
			}
			if ($this->action == 'module' && isset($this->params[1]) && $this->params[1] == 'api') {
				$module = $this->params[0];
				$path = "./modules/$module/api.php";
				if (!file_exists($path)) {
					$this->exit_404();
				}
				require $path;
				return;
			}
			// if ($this->action == 'module') {
			// 	$module = $this->params[0];
			// 	$path = "./modules/$module.php";
			// 	if (!file_exists($path)) {
			// 		$this->exit_404();
			// 	}
			// 	require $path;
			// 	return;
			// }
			////////////////
			// CHECK ACCESS
			//////////////

			if (AccessController::access() == false) {
				$tm = new Tm();
				$tm->display_page('login.tpl');
				return;
			};



			if ($this->action == '') {
				require './pages/main.php';
			} else {
				$page = $this->action;
				$path = "./pages/$page.php";
				if (!file_exists($path)) {
					$this->exit_404();
				}
				require $path;
			}
		}
	}

?>