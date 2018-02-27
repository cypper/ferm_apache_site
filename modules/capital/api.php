<?php
	require_once 'modules/transactions/api.php';
	require_once 'modules/prices/api.php';

	class CapAPI
	{
		static $cap = null;
		static $capital_data = null;
		static $capital_data_per_month = null;
		static function init() {

			if (!self::$cap) {
				// self::$cap = JD::get_vars("./databases/capital.json");
				self::$cap = $GLOBALS['MQ']->get_json_first_var("main_json","capital");
				// UT::show(self::$cap);

				// exit();
			}
		}
		static function get_info($group, $id) {
			self::init();
			return self::$cap->$group->$id;
		}
		static function get_group($tofindid) {
			self::init();
			foreach (self::$cap as $group => $ids) {
				foreach ($ids as $id => $info) {
					if ($id == $tofindid) return $group;
				}
			}
		}
		static function capital_data_calculate($tns) {
			self::init();
			$capital_data = new stdClass();
			$wallets = TnsAPI::wallets($tns);
			$items = TnsAPI::items($tns);
			$usd_to_uah = PriAPI::price("USD","UAH");

			$wallets_values = [];
			$items_values = [];
			$sum_in_usd = 0;
			$items_sum = 0;
			$wallets_data = [];
			$data_in_usd = [];
			$data_in_uah = [];

			foreach ($items as $item => $value) {
				$item_total = 0;
				$item_count = 0;
				$item_average = $value[0];
				foreach ($value as $i => $price) {
					$item_total += $price;
					$item_average = ($item_average+$price)/2;
					$item_count++;
				}
				$items_values[] = [
					$item,
					$item_count,
					"<b>".$item_average. "</b>/".($item_average*$usd_to_uah),
					"<b>".$item_total. "</b>/".($item_total*$usd_to_uah),
				];
				$items_sum += $item_total;
			}

			$prices_str = "";
			foreach ($wallets as $key => $value) {
				if (self::get_group($key) == "wallets") {
					$prices_str .= ",".$key;
				}
			}
			$prices_str = substr($prices_str,1);
			$prices = PriAPI::price_in_usd($prices_str);

			foreach ($wallets as $key => $value) {
				if (self::get_group($key) == "wallets") {
					$price = $prices->$key->USD;
				} else {
					$price = PriAPI::stuff_price_in_usd($key);
				}
				$in_usd = $value*$price;
				if ($in_usd < 1 && $in_usd > -1) continue;
				$sum_in_usd += $in_usd;


				$newdata_in_usd = [
					"key"=>$key,
					"value"=>$in_usd
				];
				array_push($data_in_usd, $newdata_in_usd);
				$newdata_in_uah = [
					"key"=>$key,
					"value"=>$in_usd*$usd_to_uah
				];
				array_push($data_in_uah, $newdata_in_uah);
				$newdata = [
					"key"=>$key,
					"value"=>$value
				];
				array_push($wallets_data, $newdata);
				
				$newvalues = [
					$key,
					$value,
					$price,
					$in_usd,
					$in_usd*$usd_to_uah,
				];

				array_push($wallets_values, $newvalues);
			}

			$sum_in_uah = $sum_in_usd*$usd_to_uah;
			$items_sum_in_uah = ($sum_in_usd + $items_sum)*$usd_to_uah;

			$capital_data->wallets_values = $wallets_values;
			$capital_data->items_values = $items_values;
			$capital_data->sum_in_uah = $sum_in_uah;
			$capital_data->items_sum_in_uah = $items_sum_in_uah;
			$capital_data->data_in_usd = $data_in_usd;
			$capital_data->data_in_uah = $data_in_uah;
			$capital_data->wallets_data = $wallets_data;
			$capital_data->items_sum = $items_sum;
			$capital_data->sum_in_usd = $sum_in_usd;

			return $capital_data;
		}
		static function capital_data_calculate_all_time() {
			if (!self::$capital_data) {

				$tns = TnsAPI::get_all_transactions();

				self::$capital_data = self::capital_data_calculate($tns);
			}
		}
		static function capital_data_calculate_per_month() {
			if (!self::$capital_data_per_month) {
				self::$capital_data_per_month = [];
				$first = TnsAPI::get_oldest_transaction();
				$start_time = strtotime($first->date);
				$start_time = date(DATE_FORMAT, strtotime("+1 month", $start_time));
				$start_time = "01".ltrim($start_time, "0123456789");
				$prev = $start_time;

				for ($i=0; $i < 10; $i++) { 
					// UT::show("+".$i." month");
					$current = date(DATE_FORMAT, strtotime("-".($i+1)." month", strtotime($start_time)));

					$tns = TnsAPI::get_transaction_in_period($current, $prev);
					
					$per_month = self::capital_data_calculate($tns);
					$per_month->date = date("M Y" , strtotime($current));
					self::$capital_data_per_month[] = $per_month;

					$prev = $current;
				}
			}
		}
		static function get_capitals_list() {
			self::init();
			$ids = [];
			foreach (self::$cap->capitals as $id => $info) {
				$ids[$id] = $info;
			}
			foreach (self::$cap->mining as $id => $info) {
				$ids[$id] = $info;
			}
			foreach (self::$cap->items as $id => $info) {
				$ids[$id] = $info;
			}
			foreach (self::$cap->resources as $id => $info) {
				$ids[$id] = $info;
			}
			return $ids;
		}
		static function get_wallets_list() {
			self::init();
			$wallets = [];
			foreach (self::$cap->wallets as $wallet => $info) {
				$wallets[$wallet] = $info;
			}
			foreach (self::$cap->stuff as $wallet => $info) {
				$wallets[$wallet] = $info;
			}
			return $wallets;
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

	$api = new API("cap_api");

	$api->dispatch();
?>