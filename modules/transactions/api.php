<?php
	require_once 'modules/capital/api.php';

	/**
	* Transactions
	*/
	class TnsAPI
	{
		static $tns = null;
		static $db_name = "./databases/transactions.json";
		static function init() {
			if (!self::$tns) {
				// self::$tns = JD::get_vars(self::$db_name);
				// self::$tns = $GLOBALS['MG']->get_all_vars(MG_DB,"transactions");
				self::$tns = (object)$GLOBALS['MQ']->get_json_first_var("main_json","transactions");
				// UT::show(self::$tns);
				// exit();
			}
		}

		static function wallets($tns=null) {
			self::init();
			// require 'modules/capital.php';

			$tns = ($tns !== null) ? $tns : self::$tns;
			$wallets = [];

					// UT::show("///////////////////////////////////////");
			foreach($tns as $i => $tn) {
					// UT::show("---------------------------------------------------");
				$amount = $tn->to->amount;
				$wallet = $tn->to->wallet;
				foreach ($tn->to->capitals as $elI => $info) {
					$id = $info->id;
					$group = CapAPI::get_group($id);
					// if ($id != "company" || $group != "capitals") continue;
					if ($id != "company") continue;

					$perc = $info->percentage;
					if (array_key_exists($wallet, $wallets)) {
						$wallets[$wallet] += $amount*$perc;
					} else {
						$wallets[$wallet] = $amount*$perc;
					}
					// UT::show($tn->message);
					// UT::show($id);
					// UT::show($wallets);
					// UT::show("//");
				}
				// UT::show($wallets);

				$amount = $tn->from->amount;
				$wallet = $tn->from->wallet;
				foreach ($tn->from->capitals as $elI => $info) {
					$id = $info->id;
					$group = CapAPI::get_group($id);
					// if ($group != "capitals") continue;
					if ($id != "company") continue;

					$perc = $info->percentage;
					if (array_key_exists($wallet, $wallets)) {
						$wallets[$wallet] -= $amount*$perc;
					} else {
						$wallets[$wallet] = (-$amount*$perc);
					}
					// UT::show($tn->message);
					// UT::show($id);
					// UT::show($wallets);
					// UT::show("//");
				}
			}

			return $wallets;
		}
		// static function wallets($tns=null) {
		// static function wallets($tns=null) {
		
		static function items($tns=null) {
			self::init();
			$tns = ($tns !== null) ? $tns : self::$tns;
			$items = [];


			foreach($tns as $i => $tn) {
				$amount = $tn->to->amount;
				foreach ($tn->to->capitals as $elI => $info) {
					$id = $info->id;
					$group = CapAPI::get_group($id);
					if ($group != "items") continue;

					$perc = $info->percentage;
					if (array_key_exists($id, $items)) {
						$items[$id][] = $amount*$perc;
					} else {
						$items[$id] = [$amount*$perc];
					}
				}
				// UT::show($wallets);

				$amount = $tn->from->amount;
				$wallet = $tn->from->wallet;
				foreach ($tn->from->capitals as $elI => $info) {
					$id = $info->id;
					$group = CapAPI::get_group($id);
					if ($group != "items") continue;

					$perc = $info->percentage;
					if (array_key_exists($id, $items)) {
						$items[$id][] = -$amount*$perc;
					} else {
						$items[$id] = [(-$amount*$perc)];
					}
				}
			}

			return $items;
		}
		static function get_all_transactions_from_date($date) {
			self::init();
			$tns_from_date = [];
			foreach(self::$tns as $i => $tn) {
				if ($tn->date == $date) continue;
				if (UT::compare_dates($tn->date,$date)) {
					array_push($tns_from_date, $tn);
				}
			}
			return $tns_from_date;
		}
		static function get_all_transactions_to_date($date) {
			self::init();
			$tns_to_date = [];
			foreach(self::$tns as $i => $tn) {
				if ($tn->date == $date) continue;
				if (UT::compare_dates($date, $tn->date)) {
					array_push($tns_to_date, $tn);
				}
			}
			if ($date == "27 Jul 2017 17:00:00") {
				UT::show($tns_to_date);
			}
			return $tns_to_date;
		}
		static function get_transaction_from($argid) {
			self::init();
			$from = [];

			foreach(self::$tns as $i => $tn) {
				foreach ($tn->from as $index => $info) {
					$id = $info->id;
					if ($id == $argid) {
						array_push($from, $tn);
					}
				}
			}

			return $from;
		}
		static function get_transaction_in_period($from,$to) {
			self::init();
			$tns_in_period = [];
			foreach(self::$tns as $i => $tn) {
				if (
					UT::compare_dates($tn->date,$from)
					&& UT::compare_dates($to,$tn->date)
				) {
					array_push($tns_in_period, $tn);
				}
			}
			return $tns_in_period;
		}
		static function sort_transactions($tns=null) {
			self::init();
			$tns = ($tns !== null) ? $tns : self::$tns;
			$tns = (array)$tns;
			usort($tns, function($a, $b) {
			    return strtotime($a->date) - strtotime($b->date);
			});
			return $tns;
		}
		
		static function get_youngest_transaction($tns=null) {
			self::init();
			$tns = ($tns !== null) ? $tns : self::$tns;
			$tns = self::sort_transactions($tns);
			return $tns[0];

		}
		static function get_oldest_transaction($tns=null) {
			self::init();
			$tns = ($tns !== null) ? $tns : self::$tns;
			$tns = self::sort_transactions($tns);
			return $tns[count($tns)-1];
		}
		
		static function investors_invest_from_tns($tns=null) {
			self::init();
			$tns = ($tns !== null) ? $tns : self::$tns;
			$investors = [];

			foreach($tns as $i => $tn) {
				// if ($tn->from_type == "capitals") {
					$amount = $tn->from->amount;
					foreach ($tn->from->capitals as $wI => $investors_info) {
						$w_id = $investors_info->id;
						$group = CapAPI::get_group($w_id);
						if ($w_id == "company" || $group != "capitals") continue;
						$w_perc = $investors_info->percentage;

						if (array_key_exists($w_id, $investors)) {
							$investors[$w_id]["balance"] += $amount*$w_perc;
						} else {
							$new_wallet = [
								"balance"=>$amount*$w_perc
							];
							$investors[$w_id] = $new_wallet;
						}
					}
				// }
			}

			return $investors;
		}
		static function percentages_of_investors_income_on_tn($tn) {
			self::init();
			$date = $tn->date;
			$tns = self::get_all_transactions_to_date($date);
			if (count($tns) == 0) {
				$invests = [];
			} else {
				$invests = self::investors_invest_from_tns($tns);
			}
			$sum = 0;
			$percentages = [];
			foreach($invests as $investor => $info) {
				$sum += $info["balance"];
			}
			foreach($invests as $investor => $info) {
				$percentages[$investor] = $info["balance"]/$sum;
			}
			
			// $balances = self::wallets($date);

			// foreach($tns as $i => $tn) {
			// 	if ($tn->from_type == "investors") {
			// 		$amount = $tn->amount_from;
			// 		foreach ($tn->from as $wI => $investors_info) {
			// 			$w_id = $investors_info->id;
			// 			$w_perc = $investors_info->percentage;

			// 			if (array_key_exists($w_id, $investors)) {
			// 				$investors[$w_id]["balance"] += $amount*$w_perc;
			// 			} else {
			// 				$new_wallet = [
			// 					"balance"=>$amount*$w_perc
			// 				];
			// 				$investors[$w_id] = $new_wallet;
			// 			}
			// 		}
			// 	}
			// }

			return $percentages;
		}
		static function investors_income() {
			$income = [];
			self::init();
			foreach (self::$tns as $i => $tn) {
				$percentage = self::percentages_of_investors_income_on_tn($tn);
				foreach ($percentage as $investor => $k) {
					if (!isset($income[$investor])) $income[$investor] = [];
					// foreach ($tn->from as $wallet => $info) {
					// 	$balance = $info["balance"];
					// 	if (isset($income[$investor][$wallet])) {
					// 		$income[$investor][$wallet] += $balance*$k;
					// 	} else {
					// 		$income[$investor][$wallet] = $balance*$k;
					// 	}
					// }

					// if ($tn->to_type == "capitals") {
						$amount = $tn->to->amount;
						$w_wallet = $tn->to->wallet;
						foreach ($tn->to->capitals as $wI => $wallets_info) {
							$w_id = $wallets_info->id;
							$group = CapAPI::get_group($w_id);
							if ($w_id == "company" || $group != "capitals") continue;
							$w_perc = $wallets_info->percentage;
							if (isset($income[$investor][$w_wallet])) {
								$income[$investor][$w_wallet] += $amount*$w_perc*$k;
							} else {
								$income[$investor][$w_wallet] = $amount*$w_perc*$k;
							}
						}
					// }
					// if ($tn->from_type == "capitals") {
					// 	$amount = $tn->amount_from;
					// 	foreach ($tn->from as $wI => $wallets_info) {
					// 		$w_id = $wallets_info->id;
					// 		$w_wallet = $wallets_info->wallet;
					// 		if ($w_id == "company") continue;
					// 		$w_perc = $wallets_info->percentage;

					// 		if (isset($income[$investor][$w_wallet])) {
					// 			$income[$investor][$w_wallet] -= $amount*$w_perc*$k;
					// 		} else {
					// 			$income[$investor][$w_wallet] = -$amount*$w_perc*$k;
					// 		}
					// 	}
					// }


				}
				// UT::show($tn->date);
				// UT::show($percentage);
			}
			// UT::show($income);
			return $income;
		}
		// static function investor_income($investor) {
		// 	self::init();
		// 	$first_investing = self::first_investing($investor);
		// 	$inv_tns = self::get_all_transactions_from_date($first_investing->date);
		// 	// $all_income
		// 	foreach($inv_tns as $i => $tn) {

		// 	}
			
		// }
		static function first_investing($investor) {
			self::init();
			$inv_tns = self::get_transaction_from($investor);
			$first_investing = array_pop($inv_tns);

			foreach($inv_tns as $i => $tn) {
				$date1 = $first_investing->date;
				$date2 = $tn->date;
				if (UT::compare_dates($date1,$date2)) {
					$first_investing = $tn;
				}
			}

			return $first_investing;
		}
		static function get_tn_by_id($id) {
			foreach (self::$tns as $key => $tn) {
				if ($tn->id == $id) {
					return $tn;
				}
			}
			return null;
		}
		static function get_tn_idlist_by_id($id) {
			foreach (self::$tns as $key => $tn) {
				if ($tn->id == $id) {
					return $key;
				}
			}
			return null;
		}
		
		static function add_transaction($post) {
			self::init();
			if ($post['id'] && !self::tns_exist($post['id'])) {
				$data = new stdClass();
				$data->from = new stdClass();
				$data->to = new stdClass();
				$data->id = floatval($post['id']);
				$data->message = $post['message'];
				$data->amount = floatval($post['amount_in_dollars']);
				$data->from->amount = floatval($post['amount_from']);
				$data->from->wallet = $post['from_wallet'];
				$data->to->amount = floatval($post['amount_to']);
				$data->to->wallet = $post['to_wallet'];
				$data->date = UT::date_to_format($post['date']);
				
				$froms = [];
				$tos = [];
				foreach ($post as $key => $value) {
					$queryFrom = "from_name_";
					$queryTo = "to_name_";
					if (substr($key, 0, strlen($queryFrom) ) === $queryFrom) {
						$from_el = new stdClass();
						$id = substr($key, strlen($queryFrom));
						$from_el->id = $post['from_name_'.$id];
						$from_el->percentage = floatval($post['from_perc_'.$id]);
						array_push($froms, $from_el);
					}
					if (substr($key, 0, strlen($queryTo) ) === $queryTo) {
						$to_el = new stdClass();
						$id = substr($key, strlen($queryTo));
						$to_el->id = $post['to_name_'.$id];
						$to_el->percentage = floatval($post['to_perc_'.$id]);
						array_push($tos, $to_el);
					}
				}
				$data->from->capitals = $froms;
				$data->to->capitals = $tos;
				$id = $data->id;

				self::$tns->$id = $data;
				$GLOBALS['MQ']->update_json_first_var('main_json', 'transactions', self::$tns);
				return true;
			}
			return false;
		}
		static function get_all_transactions() {
			self::init();
			return self::$tns;
		}
		// static function get_last_transactions() {
		// 	self::init();
		// 	return self::$tns[count(self::$tns)-1];
		// }
		static function get_transaction($id) {
			self::init();
			return self::get_tn_by_id($id);
		}
		static function edit_transaction($id, $value) {
			self::init();
			if (self::tns_exist($id)) {
				$idlist = self::get_tn_idlist_by_id($id);
				self::$tns->$idlist = $value;
				// JD::rewrite(self::$db_name, self::$tns);
				$GLOBALS['MQ']->update_json_first_var('main_json', 'transactions', self::$tns);
				return true;
			}
			return null;
		}
		static function delete_transaction($id) {
			self::init();
			if (self::tns_exist($id)) {
				$idlist = self::get_tn_idlist_by_id($id);
				unset(self::$tns->$idlist);
				// JD::rewrite(self::$db_name, self::$tns);
				$GLOBALS['MQ']->update_json_first_var('main_json', 'transactions', self::$tns);
				return true;
			}
			return null;
		}
		static function tns_exist($id) {
			self::init();
			foreach(self::$tns as $i => $tn) {
				if ($tn->id == $id) return true;
			}
			return false;
		}
	}


	$api = new API("tns_api");

	$api->set_get("wallets",function(){
		return json_encode(TnsAPI::wallets());
	}, "application/json");

	$api->set_get("tns_exist",function(){
		if (!isset($_GET["id"])) return '';
		return json_encode(TnsAPI::tns_exist($_GET["id"]));
	}, "application/json");

	$api->set_get("tn_get",function(){
		if (!isset($_GET["id"])) return '';
		return json_encode(TnsAPI::get_transaction($_GET["id"]));
	}, "application/json");

	$api->set_get("tn_delete",function(){
		if (!isset($_GET["id"])) return '';
		return json_encode(TnsAPI::delete_transaction($_GET["id"]));
	}, "application/json");

	// UT::show($_POST);
	// UT::show($_POST);

	$api->set_post("tn_add",function(){
		$answer = TnsAPI::add_transaction($_POST);
		if ($answer) {
			header("Location: /transactions");
		} else {
			$answer = "Error";
		}
		return json_encode($answer);
	});

	$api->set_post("tn_edit",function(){
		if (!isset($_POST["tn"])) return '';
		$value = json_decode($_POST["tn"]);
		$answer = TnsAPI::edit_transaction($_POST["id"],$value);
		return json_encode($answer);
	});

	$api->dispatch();
	

?>