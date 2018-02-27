<?php
	require_once 'modules/user/api.php';

	/**
	* Diary
	*/
	class DiaryAPI
	{
		static $user_info;
		static $diary;
		static $which;
		static function init() {
			$username = UserAPI::get_all_user_data()->username;
			if (!self::$user_info || !self::$diary || !self::$which) {
				self::$which = "WHERE username='$username'";
				self::$user_info = $GLOBALS['MQ']->get_json_var("users","info",self::$which);
				if (!isset(self::$user_info->modules->diary)) {
					self::$user_info->modules->diary = new stdClass();
					self::$user_info->modules->diary->tickets = new stdClass();
					self::$user_info->modules->diary->history = [];
					self::save();
				}
				self::$diary = self::$user_info->modules->diary;
			}
		}
		static function save() {
			if (!self::$user_info || !self::$which) return;
			$GLOBALS['MQ']->update_json_var("users","info",self::$user_info,self::$which);
		}

		static function get_diary() {
			self::init();
			return self::$diary;
		}
		static function update_tickets($tickets) {
			self::init();
			$tickets = json_decode($tickets);
			self::$diary->tickets = $tickets;
			self::save();
			return "done";
		}
		static function add_history($data) {
			self::init();
			$data = json_decode($data);
			self::$diary->history[] = $data;
			self::save();
			return "done";
		}
		static function update_history($data) {
			self::init();
			$data = json_decode($data);
			self::$diary->history = $data;
			self::save();
			return "done";
		}
		static function delete_ticket() {
			self::init();
			return self::$diary;
		}
	}

	$api = new API("diary_api");

	$api->set_get("update_tickets",function(){
		return DiaryAPI::update_tickets($_GET["update_tickets"]);
	});

	$api->set_post("update_tickets",function(){
		return DiaryAPI::update_tickets($_POST["update_tickets"]);
	});
	$api->set_post("update_history",function(){
		return DiaryAPI::update_history($_POST["update_history"]);
	});


	$api->dispatch();


		// if (isset($_POST["add_history"]) && $_POST["diary_post"] == "add_history") {
		// 	$answer = DiaryAPI::add_history($_POST["add_history"]);
		// }
?>