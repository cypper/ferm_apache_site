<?php
	require_once 'modules/capital/api.php';
	/**
	* Capital
	*/
	class CapitalModules
	{
		static $cap_data = null;
		static $capital_data_per_month = null;
		static function set_capital_data() {
			CapAPI::capital_data_calculate_all_time();
			self::$cap_data = CapAPI::$capital_data;
		}
		static function set_capital_data_per_month() {
			CapAPI::capital_data_calculate_per_month();
			self::$capital_data_per_month = CapAPI::$capital_data_per_month;
		}
		static function capitalization_module($opt=[]) {
			self::set_capital_data();

			$tm = new Tm('modules/capital/assets/');

			$vars = [
				[
					"title"=>"Amount in usd",
					"data"=>round(self::$cap_data->sum_in_usd). " USD",
					"subdata"=>"",
					"icon"=>"dollar"
				], [
					"title"=>"Amount in uah",
					"data"=>round(self::$cap_data->sum_in_uah). " UAH",
					"subdata"=>"",
					"icon"=>"money"
				], [
					"title"=>"Capitalization",
					"data"=>round(self::$cap_data->sum_in_usd + self::$cap_data->items_sum). " USD",
					"subdata"=>"",
					"icon"=>"dollar"
				], [
					"title"=>"Capitalization in uah",
					"data"=>round(self::$cap_data->items_sum_in_uah). " UAH",
					"subdata"=>"",
					"icon"=>"money"
				]
			];

			$tm->set_smarty_vars(["vars"=>$vars]);

			$output = $tm->get_page('capitalization.tpl');

			$module_vars = [
				"title"=>"Capitalization",
				"header"=>"",
				"subheader"=>$output,
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];

			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
		static function wallets_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"headers"=>["Wallet","Amount", "Price", "In usd", "In uah"],
				"values"=>self::$cap_data->wallets_values,
				"title"=>"Wallet",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"table"
			];
		}
		static function items_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"headers"=>["Item", "Count", "Average price(usd/uah)", "Total(usd/uah)"],
				"values"=>self::$cap_data->items_values,
				"title"=>"Wallet",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"table"
			];
		}
		static function circles_wallets_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"data"=>self::$cap_data->wallets_data,
				"title"=>"Wallets",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"pies_areas"
			];
		}
		static function circles_wallets_usd_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"data"=>self::$cap_data->data_in_usd,
				"title"=>"Prices in usd",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"pies_areas"
			];
		}
		static function circle_wallets_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"data"=>self::$cap_data->wallets_data,
				"title"=>"Wallets",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"pie_area"
			];
		}
		static function circle_wallets_usd_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"data"=>self::$cap_data->data_in_usd,
				"title"=>"Prices in usd",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"pie_area"
			];
		}
		static function circle_wallets_uah_module($opt=[]) {
			self::set_capital_data();
			$module_vars = [
				"data"=>self::$cap_data->data_in_uah,
				"title"=>"Prices in uah",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"pie_area"
			];
		}
		static function graph_per_month($opt=[]) {
			self::set_capital_data_per_month();
			$bar_data = [
				"names"=>[],
				"graphs"=>[]
			];

			$bar_data["graphs"][0] = [
				"name"=>"Capitals difference",
				"opt"=>[
					"type"=>"bar"
				],
				"v"=>[]
			];

			$bar_data["graphs"][1] = [
				"name"=>"Items difference",
				"opt"=>[
					"type"=>"bar"
				],
				"v"=>[]
			];

			$bar_data["graphs"][2] = [
				"name"=>"Total capital",
				"opt"=>[
					"type"=>"line",
					"smooth"=>true
				],
				"v"=>[]
			];
			$total = 0;

			for ($i=count(self::$capital_data_per_month)-1; $i >= 0; $i--) { 
				$data_per_month = self::$capital_data_per_month[$i];
				# code...
				$bar_data["names"][] = $data_per_month->date;
				$bar_data["graphs"][0]["v"][] = $data_per_month->sum_in_usd;
				$bar_data["graphs"][1]["v"][] = $data_per_month->items_sum;
				$total += $data_per_month->sum_in_usd;
				$bar_data["graphs"][2]["v"][] = $total;
			}
			// UT::show($bar_data);

			$module_vars = [
				"title"=>"All in",
				"json_data"=>json_encode($bar_data, JSON_UNESCAPED_UNICODE),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"custom_graph"
			];
		}
		static function earnings_per_month($opt=[]) {
			self::set_capital_data_per_month();
			$bar_data = [
				"names"=>[],
				"graphs"=>[]
			];

			$bar_data["graphs"][0] = [
				"name"=>"usd",
				"v"=>[]
			];
			for ($i=count(self::$capital_data_per_month)-1; $i >= 0; $i--) { 
				$data_per_month = self::$capital_data_per_month[$i];
				# code...
				$bar_data["names"][] = $data_per_month->date;
				$bar_data["graphs"][0]["v"][] = $data_per_month->sum_in_usd;
			}
			// UT::show($bar_data);

			$module_vars = [
				"title"=>"Capital difference",
				"json_data"=>json_encode($bar_data, JSON_UNESCAPED_UNICODE),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"bar_graph"
			];
		}
		static function items_per_month($opt=[]) {
			self::set_capital_data_per_month();
			$bar_data = [
				"names"=>[],
				"graphs"=>[]
			];

			$bar_data["graphs"][0] = [
				"name"=>"usd",
				"v"=>[]
			];
			for ($i=count(self::$capital_data_per_month)-1; $i >= 0; $i--) { 
				$data_per_month = self::$capital_data_per_month[$i];
				# code...
				$bar_data["names"][] = $data_per_month->date;
				$bar_data["graphs"][0]["v"][] = $data_per_month->items_sum;
			}
			// UT::show($bar_data);

			$module_vars = [
				"title"=>"Items difference",
				"json_data"=>json_encode($bar_data, JSON_UNESCAPED_UNICODE),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"bar_graph"
			];
		}
		static function capital_per_month($opt=[]) {

			self::set_capital_data_per_month();
			$bar_data = [
				"names"=>[],
				"graphs"=>[]
			];

			$bar_data["graphs"][0] = [
				"name"=>"Total capital",
				"opt"=>[
					"type"=>"line",
					"smooth"=>true,
					"areaStyle"=> ["normal"=>[]]
				],
				"v"=>[]
			];
			$total = 0;
			for ($i=count(self::$capital_data_per_month)-1; $i >= 0; $i--) { 
				$data_per_month = self::$capital_data_per_month[$i];
				# code...
				$bar_data["names"][] = $data_per_month->date;
				$total += $data_per_month->sum_in_usd;
				$bar_data["graphs"][0]["v"][] = $total;
			}
			// UT::show($bar_data);

			$module_vars = [
				"title"=>"Total capital",
				"json_data"=>json_encode($bar_data, JSON_UNESCAPED_UNICODE),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"custom_graph"
			];
		}
		static function earnings_per_month_text($opt=[]) {
			self::set_capital_data_per_month();


			$module_vars = [
				"title"=>"Prices in uah",
				"header"=>"",
				"subheader"=>UT::show(self::$capital_data_per_month, true),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
	}
?>