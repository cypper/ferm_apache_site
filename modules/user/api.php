<?php
	//
	// USER
	//
	
	class UserAPI
	{
		static function get_all_user_data() {
			return $_SESSION["user"];
		}
	}
?>