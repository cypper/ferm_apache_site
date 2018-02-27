<?php

	/**
	* Templates
	*/
	class Tm {
		function __construct($dir=null) {
			$this->smarty = new SmartyBC();
			if (!$dir) $this->smarty->setTemplateDir('templates/');
			else $this->smarty->setTemplateDir($dir);
			$this->set_smarty_vars(array(
				"assets"=>"/templates/assets",
				"root"=>"",
				"main_title"=>"Ferm.ua 0.8.1"
			));
			// $this->smarty->caching = 0;
			if (isset($_SESSION["user"])) {
				$this->set_smarty_vars(array(
					"username"=>$_SESSION["user"]->username,
					"email"=>$_SESSION["user"]->email,
					"created_at"=>$_SESSION["user"]->created_at
				));
			}
		}
		function set_smarty_vars($vars) {
			foreach ($vars as $key => $value) {
				$this->smarty->assign($key, $value);
			}
		}
		function display($modules,$vars=[]) {
			$this->set_smarty_vars(array('modules'=>$modules));

			$this->smarty->display('index.tpl');
		}
		function display_page($page) {
			$this->smarty->display($page);
		}
		function get_page($page) {
			return $this->smarty->fetch($page);
		}
		function get_template($path,$filename,$vars=null) {
			$this->smarty->setTemplateDir($path);

			if ($vars) {
				$this->set_smarty_vars(["vars"=>$vars]);
			}


			return $this->get_page($filename);

		}
	}

?>