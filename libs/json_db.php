<?php
	
	/**
	* JSON_DB
	*/
	class JD
	{
		static function get_vars($file) {
			$json = file_get_contents($file);
			$json = json_decode($json);
			return $json;
		}
		static function get_var($file,$name) {
			$data = self::get_vars($file);
			if ($data == null
				|| $data->$name == null) return 0;
			return $data->$name;
		}
		static function put_var($file,$name,$value) {
			$data = self::get_vars($file);
			if ($data == null) return 0;
			$data->$name = $value;
			$data = json_encode($data);
			$data = file_put_contents($file, $data);
			return 1;
		}
		static function rewrite($file,$value) {
			$data = json_encode($value);
			$data = file_put_contents($file, $data);
			return 1;
		}
		static function push_var($file,$value) {
			$data = self::get_vars($file);
			if ($data == null) return 0;
			array_push($data, $value);
			$data = json_encode($data);
			$data = file_put_contents($file, $data);
			return 1;
		}
	}

?>