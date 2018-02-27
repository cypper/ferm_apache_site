<?php
	require_once 'modules/user/api.php';
	//
	// USER
	//
	
	class UserModules
	{
		static function all_user_data_module($opt=[]) {
			$module_vars = [
				"title"=>"Profile",
				"header"=>"",
				"subheader"=>UT::show(UserAPI::get_all_user_data(),true),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
	}
?>