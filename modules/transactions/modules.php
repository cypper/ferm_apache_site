<?php
	require_once 'modules/transactions/api.php';
	/**
	* Transactions
	*/
	class TnsModules
	{

		static function transactions_module($opt=[]) {
			require_once 'modules/capital/api.php';
			$tns = TnsAPI::get_all_transactions();

			$values = [];

			foreach ($tns as $key => $tn) {
				$from = '';
				foreach ($tn->from->capitals as $fi => $tn_f) {
					$from .= ($fi != 0 ? ", " : "") 
						. CapAPI::get_by_id($tn_f->id)->name 
						. ($tn_f->percentage != 1 ? (" - " . (100*$tn_f->percentage) . "%") : "") ;
				}
				$to = '';
				foreach ($tn->to->capitals as $fi => $tn_f) {
					$to .= ($fi != 0 ? ", " : "") 
						. CapAPI::get_by_id($tn_f->id)->name 
						. ($tn_f->percentage != 1 ? (" - " . (100*$tn_f->percentage) . "%") : "") ;
				}
				$newvalues = [
					$tn->date,
					$tn->id,
					$tn->message,
					$from,
					$to,
					$tn->amount,
					$tn->from->amount,
					$tn->to->amount,
				];

				array_push($values, $newvalues);
			}
			usort($values, function($a, $b) {
			    return strtotime($a[0]) - strtotime($b[0]);
			});
			$i=0;
			foreach ($values as $key => $value) {
				array_unshift($values[$key], $i++);
			}



			$module_vars = [
				"headers"=>["order", "date", "id", "message", "from", "to", "amount in dollars", "amount from", "amount to"],
				"values"=>$values,
				"title"=>"Transactions",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"table"
			];
		}
		static function add_transaction_module($opt=[]) {
			require_once 'modules/capital/api.php';
			$capitals_list = CapAPI::get_capitals_list();
			$wallets_list = CapAPI::get_wallets_list();

			$tm = new Tm('modules/transactions/assets/');

			$vars = [
				"id"=>mt_rand()*mt_rand(),
				"date"=>date(DATE_FORMAT),
				"ids"=>$capitals_list,
				"wallets"=>$wallets_list
			];

			$tm->set_smarty_vars(["vars"=>$vars]);

			$output = $tm->get_page('add_transaction.tpl');

			$module_vars = [
				"title"=>"Add transaction",
				"header"=>"",
				"subheader"=>$output,
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
		static function edit_transaction_module($opt=[]) {
			require_once 'modules/capital/api.php';
			$capitals_list = CapAPI::get_capitals_list();
			$wallets_list = CapAPI::get_wallets_list();

			$tm = new Tm('modules/transactions/assets/');

			$vars = [
				"ids"=>$capitals_list,
				"wallets"=>$wallets_list
			];

			$tm->set_smarty_vars(["vars"=>$vars]);

			$output = $tm->get_page('edit_transaction.tpl');

			$module_vars = [
				"title"=>"Edit transactions",
				"header"=>"",
				"subheader"=>$output,
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
		static function investors_module($opt=[]) {
			require_once 'modules/capital/api.php';
			require_once 'modules/prices/api.php';

			$investors_in = TnsAPI::investors_invest_from_tns();
			$wallets = TnsAPI::wallets();
			$usd_to_uah = PriAPI::price("USD","UAH");
			$income = TnsAPI::investors_income();


			$data = [];
			$table = [];
			$sum_of_all_invests = 0;

			$capital = 0;

			foreach ($wallets as $key => $value) {
				$in_usd = $value['balance'];
				if (CapAPI::get_group($key) == "wallets") {
					$price = PriAPI::price_in_usd($key)->$key->USD;
				} else {
					$price = PriAPI::stuff_price_in_usd($key);
				}
				$in_usd *= $price;
				$capital += $in_usd;
			}

			$income_in_dollars = [];
			foreach ($income as $investor => $inv_wallets) {
				if (!isset($income_in_dollars[$investor])) $income_in_dollars[$investor] = 0;
				foreach ($inv_wallets as $key => $value) {
					if (CapAPI::get_group($key) == "wallets") {
						$price = PriAPI::price_in_usd($key)->$key->USD;
					} else {
						$price = PriAPI::stuff_price_in_usd($key);
					}
					$in_usd = $value*$price;
					$sum_of_all_invests += $in_usd;

					$income_in_dollars[$investor] += $in_usd;
				}

			}
			if ($sum_of_all_invests == 0) $sum_of_all_invests = 1;

			foreach ($investors_in as $investor => $value) {
				if (!isset($income_in_dollars[$investor])) $income_in_dollars[$investor] = 0;
				$name = CapAPI::get_by_id($investor)->name;
				$newrow = [
					$name,
					$value['balance'],
					$value['balance']*$usd_to_uah,
					($income_in_dollars[$investor]/$sum_of_all_invests)*100 . "%",
					$income_in_dollars[$investor],
					$income_in_dollars[$investor]*$usd_to_uah,
				];
				array_push($table, $newrow);
			}

			$module_vars = [
				"headers"=>["Investor","Amount", "In uah", "Percent of income", "Pending income", "Pending income in uah"],
				"values"=>$table,
				"title"=>"Wallet",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"table"
			];

		}

	}
?>