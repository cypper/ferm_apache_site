<?php
	require_once 'modules/diary/api.php';
	
	/**
	* Diary
	*/
	class DiaryModules
	{
		static function manage_ticket_module($opt=[]) {

			$diary = DiaryAPI::get_diary();

			$tickets_json = json_encode($diary->tickets);
			$history_json = json_encode($diary->history);


			$tm = new Tm('modules/diary/assets/');
			$tm->set_smarty_vars(["vars"=>[
				"tickets_json"=>$tickets_json,
				"history_json"=>$history_json
			]]);

			$output = $tm->get_page('manage_ticket.tpl');

			$module_vars = [
				"title"=>"Add ticket",
				"header"=>"",
				"subheader"=>$output,
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
		static function diary_data_module($opt=[]) {
			$diary = DiaryAPI::get_diary();
			$module_vars = [
				"title"=>"Diary data",
				"header"=>"",
				"subheader"=>UT::show($diary,true),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}

	}
?>