<?php
	require 'modules/workers/api.php';

	/**
	* Worital
	*/
	class WorkersModules
	{
		static function status_module($opt=[]) {
			$workers = WorAPI::get_workers();

			$values = [];
			foreach ($workers as $name => $info) {
				$watch_checkbox = '<input class="worker_checkbox" id="worker_'.$name.'" type="checkbox" '.($info->watch ? 'checked' : '').'>';

				$mode = (WorAPI::get_worker_mode($name)) ? "<span class='green'>Online</span>" : "<span class='red'>Offline</span>";
				$reported = $info->reported.' - <a href="" onclick="httpGetAsync(\'/module/workers/api?wor_api&reset_worker_reported&reset_worker_reported_name='.$name.'\')">reset value</a>';
				$new_value = [
					$name,
					$watch_checkbox,
					$mode,
					WorAPI::gpus_average_usage($info->history),
					$info->date,
					$reported,
				];
				array_push($values, $new_value);
			}

			$tm = new Tm();
			$script = $tm->get_template('modules/workers/assets/','workers_status_script.tpl');

			$module_vars = [
				"headers"=>["worker", "watch", "mode", "average usage", "last seen", "reported"],
				"values"=>$values,
				"title"=>"Workers",
				"raw_data"=>$script,
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"table"
			];
		}
		static function gpus_status_module($opt=[]) {
			$workers = WorAPI::get_workers();

			$gpus_values = [];

			$table_headers = ["name"];
			foreach ($workers as $name => $info) {
				if (!$info->watch) continue;

				$stats_worker = [];

				foreach ($info->gpus as $gpuI => $gpu_stats) {
					$gpu_values = [];
					$gpu_values[] = "<b>".$name."</b> - gpu <b>".$gpuI."</b>";
					foreach ((array)$gpu_stats as $iG => $value) {
						if (count($table_headers)-1 < count((array)$gpu_stats)) {
							$table_headers[] = $iG;
						}
						$gpu_values[] = $value;
					}
					$gpus_values[] = $gpu_values;
				}
			}

			$module_vars = [
				"headers"=>$table_headers,
				"values"=>$gpus_values,
				"title"=>"GPUS",
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];

			return [
				"vars"=>$module_vars,
				"widget"=>"table"
			];
		}
		static function dump_all_data_module($opt=[]) {
			$workers = WorAPI::get_workers();
			$output_workers = print_r($workers, true);

			$module_vars = [
				"title"=>"Workers all info",
				"header"=>"",
				"subheader"=>"<pre>".$output_workers."</pre>"
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
	}