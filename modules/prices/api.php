<?php

	/**
	* Prices
	*/
	class PriAPI
	{
		static $price_api = null;
		static $prices = null;
		static $price_api_multi = null;
		static $cached_prices = [];
		static function init() {
			self::$price_api = "https://min-api.cryptocompare.com/data/price?";
			self::$price_api_multi = "https://min-api.cryptocompare.com/data/pricemulti?";
			if (!self::$prices) {
				// self::$prices = JD::get_vars("./databases/prices.json");
				self::$prices = $GLOBALS['MQ']->get_json_first_var("main_json","prices");
				// self::$prices = $GLOBALS['MG']->get_all_vars(MG_DB,"prices")[0];
			}
		}
		static function send_request($from, $to) {
			if (array_key_exists($from.$to, self::$cached_prices)) {
				// UT::show("CACHED");
				return self::$cached_prices[$from.$to];
			} else {
				$url = self::$price_api . "fsym=".$from."&tsyms=".$to;
				$response = json_decode(UT::curl($url));
				self::$cached_prices[$from.$to] = $response;
				return $response;
			}
		}
		static function send_request_multi($from, $to) {
			$url = self::$price_api_multi . "fsyms=".$from."&tsyms=".$to;
			$response = json_decode(UT::curl($url));
			return $response;
		}
		static function stuff_price_in_usd($currency) {
			self::init();
			return self::$prices->$currency->USD;
		}
		static function price($from, $to) {
			self::init();
			return self::send_request($from, $to)->$to;
		}
		static function price_in_usd($currencies) {
			self::init();
			return self::send_request_multi($currencies, "USD");
		}
		static function get_by_id($tofindid) {
			self::init();
			foreach (self::$cap as $group => $ids) {
				foreach ($ids as $id => $info) {
					if ($id == $tofindid) return $info;
				}
			}
			return self::$cap->$group->$id;
		}
		static function get_all_capital() {
			self::init();
			return self::$cap;
		}
	}

	$api = new API("pri_api");

	$api->dispatch();

?>