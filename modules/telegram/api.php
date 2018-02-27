<?php

	/**
	* Telegram
	*/
	class TelAPI
	{
		static $botapi;
		static $boturl;
		static $chats;
		static function init() {
			self::$botapi = '516848268:AAEdIuckiW6h6cLw2QK10OCjBVjtkqOhxck';
			self::$boturl = "https://api.telegram.org/bot".self::$botapi;
			//self::$chats = [318962643];
			self::$chats = [323843333,318962643];
		}

		static function sendMessage($text) {
			self::init();
			foreach (self::$chats as $i => $chat_id) {
				$url = self::$boturl."/sendMessage";
				$params=[
					'chat_id'=>$chat_id,
					'text'=>$text,
					'parse_mode'=>"Markdown",
				];
				UT::curl($url,$params);
			}
		}
	}

	$api = new API("tel_api");

	$api->set_get("text",function(){
		$answer = TelAPI::sendMessage($_GET["text"]);
		return json_encode($answer);
	}, "application/json");

	$api->dispatch();
?>
