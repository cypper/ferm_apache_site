<?php
	require 'modules/telegram/api.php';

	/**
	* Worital
	*/
	class WorAPI
	{
		static $wor = null;
		static $db = "./databases/workers.json";
		static function init() {
			if (!self::$wor) {
				// self::$wor = JD::get_vars(self::$db);
				self::$wor = $GLOBALS['MQ']->get_json_first_var("main_json","workers");
			}
		}
		static function get_workers() {
			self::init();
			return self::$wor;
		}
		static function gpus_average_usage($history) {
			self::init();
			$total = 0;
			$hist_count = count($history);
			$last_reported_history = 0;

			foreach ($history as $i_h => $stat) {
				$lowest = 100;
				foreach ($stat->gpus as $i => $gpu) {
					if ($gpu->usage < $lowest) $lowest = (int)$gpu->usage;
				}
				$total += $lowest;
			}
			$result = $total/$hist_count;
			return $result;
		}
		static function get_worker_mode($name) {
			self::init();
			// UT::show(self::$wor);
			$worker = self::$wor->$name;
			$gpus_average_usage = self::gpus_average_usage($worker->history);
			if ($gpus_average_usage < 50) $gpus_status = false;
			else $gpus_status =  true;
			$worker_out = UT::time_difference($worker->date,date(DATE_FORMAT));
			if ($worker_out/60 > 1 || !$gpus_status)
				return false;
			else
				return true;
		}
		static function reset_worker_reported($name) {
			self::init();
			self::$wor->$name->reported = date(DATE_FORMAT,10);
			foreach (self::$wor->$name->reported_warnings as $id => $date) {
				self::$wor->$name->reported_warnings->$id = date(DATE_FORMAT,10);
			}
			// JD::put_var(self::$db, $name, self::$wor->$name);
			$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
		}
		static function set_worker_watch($name,$status) {
			self::init();
			self::$wor->$name->watch = !!$status;
			// JD::put_var(self::$db, $name, self::$wor->$name);
			$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
		}
		static function check_workers() {
			self::init();
			$datat = 1;
			foreach (self::$wor as $name => $info) {
				if (!$info->watch) continue;


				$mode = self::get_worker_mode($name);
				$last_reported = UT::time_difference($info->reported,date(DATE_FORMAT));

				//CRITICALLL

				if (!$mode && $last_reported/60 > 120) {
					$link = "http://".$_SERVER['HTTP_HOST']."/workers";
					TelAPI::sendMessage("CRITICAL!\nWorker is out - `$name`\nLast seen: *".self::$wor->$name->date."*\n\nGo here for more info [$link]($link)");
					self::$wor->$name->reported = date(DATE_FORMAT);
					// JD::put_var(self::$db, $name, self::$wor->$name);
					$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
				}

				//WARNINGS
				

				$temperature_reported = UT::time_difference($info->reported_warnings->temperature,date(DATE_FORMAT));


				foreach ($info->gpus as $id => $gpu) {

					if ($gpu->temperature > 80 && $temperature_reported/60 > 60) {
						$link = "http://".$_SERVER['HTTP_HOST']."/workers";
						TelAPI::sendMessage("WARNING!\nWorkers `$name` gpu `$gpu->id` temperature is high - `$gpu->temperature`\n\nGo here for more info [$link]($link)");
						// JD::put_var(self::$db, $name, $info);
						$info->reported_warnings->temperature = date(DATE_FORMAT);
						$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
					}
				}

			}
			return $datat;
		}
		static function add_history($name, $history) {
			self::init();
			if (!$history) return;
			if (self::$wor->$name->history == null) self::$wor->$name->history = [];
			if (count(self::$wor->$name->history) > 10) {
				array_shift(self::$wor->$name->history);
			}
			array_push(self::$wor->$name->history, $history);
			// JD::put_var(self::$db, $name, self::$wor->$name);
			$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
		}
		static function update_database() {
			self::init();
			UT::show(self::$wor);
			foreach (self::$wor as $name => $info) {
				if (!isset($info->reported_warnings)) {
					$info->reported_warnings = new stdClass();
					$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
				}
				if (!isset($info->reported_warnings->temperature)) {
					$info->reported_warnings->temperature = date(DATE_FORMAT,10);
					$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
				}
			}
			return 'done';
		}
		static function recieve_gpu_status($object) {
			self::init();
			if (!$object || !$object->name) return false;
			$name = $object->name;
			$history = new stdClass();
			if (!isset(self::$wor->$name)) {
				self::$wor->$name = new stdClass();
				self::$wor->$name->reported = date(DATE_FORMAT);
				self::$wor->$name->watch = false;
				self::$wor->$name->history = [];
				self::$wor->$name->reported_warnings = new stdClass();
				self::$wor->$name->reported_warnings->temperature = date(DATE_FORMAT,10);
			}
			self::$wor->$name->date = date(DATE_FORMAT,$object->date/1000);
			$history->date = self::$wor->$name->date;
			$history->gpusCount = $object->gpus_count;
			self::$wor->$name->gpusCount = $object->gpus_count;
			self::$wor->$name->gpus = [];
			$history->gpus = [];

			for ($i=0; $i < self::$wor->$name->gpusCount; $i++) { 
				$gpu = new stdClass();
				$gpu->id = $object->gpus[$i]->id;
				$gpu->name = $object->gpus[$i]->name;
				$gpu->driverVersion = $object->gpus[$i]->driverVersion;
				$gpu->temperature = $object->gpus[$i]->temperature;
				$gpu->usage = $object->gpus[$i]->usage;
				$gpu->memoryUsage = $object->gpus[$i]->memoryUsage;
				$gpu->coreClock = $object->gpus[$i]->coreClock;
				$gpu->memoryClock = $object->gpus[$i]->memoryClock;
				$gpu->memoryUsed = $object->gpus[$i]->memoryUsed;
				self::$wor->$name->gpus[$i] = $gpu;
				$history->gpus[$i] = $gpu;
			}
			// JD::put_var(self::$db, $name, self::$wor->$name);
			$GLOBALS['MQ']->update_json_first_var('main_json', 'workers', self::$wor);
			self::add_history($name,$history);
			return "ok";
		}
		
	}

	$api = new API("wor_api");

	$api->set_get("check_workers",function(){
		return json_encode(WorAPI::check_workers());
	}, "application/json");

	$api->set_get("update_database",function(){
		return json_encode(WorAPI::update_database());
	}, "application/json");

	$api->set_get("set_worker_watch",function(){
		if (!(isset($_GET["set_worker_watch_name"]) && isset($_GET["set_worker_watch_status"]))) return '';
		return json_encode(WorAPI::set_worker_watch($_GET["set_worker_watch_name"],$_GET["set_worker_watch_status"]));
	}, "application/json");

	$api->set_get("reset_worker_reported",function(){
		if (!isset($_GET["reset_worker_reported_name"])) return '';
		return json_encode(WorAPI::reset_worker_reported($_GET["reset_worker_reported_name"]));
	}, "application/json");


	$api->set_post("workers_status",function(){
		if (!isset($_POST["data"])) return '';
		$value = json_decode($_POST["data"]);
		$answer = WorAPI::recieve_gpu_status($value);
		return json_encode($answer);
	}, "application/json");


	$api->dispatch();

	// if (isset($_GET["wor_api"]) || isset($_POST["wor_type"])) {
	// 	$answer = null;

	// 	// if (isset($_GET["check_workers"])) {
	// 	// 	$answer = WorAPI::check_workers();
	// 	// }
	// 	// if (isset($_GET["update_database"])) {
	// 	// 	$answer = WorAPI::update_database();
	// 	// }
	// 	// if (isset($_GET["set_worker_watch"]) && isset($_GET["set_worker_watch_name"]) && isset($_GET["set_worker_watch_status"])) {
	// 	// 	$answer = WorAPI::set_worker_watch($_GET["set_worker_watch_name"],$_GET["set_worker_watch_status"]);
	// 	// }
	// 	// if (isset($_GET["reset_worker_reported"]) && isset($_GET["reset_worker_reported_name"])) {
	// 	// 	$answer = WorAPI::reset_worker_reported($_GET["reset_worker_reported_name"]);
	// 	// }

	// 	//POST

	// 	if (isset($_POST["wor_type"]) && $_POST["wor_type"] == "workers_status") {
	// 		$value = json_decode($_POST["data"]);

	// 		// $answer = $value->date;
	// 		$answer = WorAPI::recieve_gpu_status($value);
	// 		// UT::show($_GET["id"]);
	// 	}


	// 	header("Content-type:application/json");
	// 	echo json_encode($answer);
	// }

?>