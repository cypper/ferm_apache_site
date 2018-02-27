<?php

	/**
	* Utilities
	*/
	class UT
	{
		static function exec_time() {
			$time_end = microtime(true);
			$execution_time = ($time_end - TIME_START);
			return $execution_time;
		}
		static function show($obj,$to_var=false) {
			$str = "<pre>".print_r($obj, true)."</pre>";
			if ($to_var) return $str;
			echo $str;
		}
		static function func_enabled($func) {
			if (!function_exists($func)) return false;
			$disabled = explode(',', ini_get('disable_functions'));
			return !in_array($func, $disabled);
		}
		static function curl($url,$params=null) {
			if (!self::func_enabled('curl_exec')) {
				return file_get_contents($url);
			}
			// $proxies = unserialize(PROXIES);
			// $proxy = $proxies[array_rand($proxies)];
			// $proxyauth = 'user1:user1';
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$url);
			// if ($proxy && $proxy_use) {
			// 	echo $proxy;
			// 	curl_setopt($curl_handle, CURLOPT_PROXY, $proxy);
			// 	curl_setopt($curl_handle, CURLOPT_PROXYUSERPWD, $proxyauth);
			// }
			if ($params) curl_setopt($curl_handle, CURLOPT_POSTFIELDS, ($params));
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle,CURLOPT_HEADER, false);
			 curl_setopt($curl_handle, CURLOPT_ENCODING , "UTF-8");
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);
			if (empty($buffer)){
				return null;
			}
			else{
				return $buffer;
			}
		}
		static function compare_dates($date1,$date2) {
			$time1 = strtotime($date1);
			$time2 = strtotime($date2);
			if($time1>=$time2){
				return true;
			}
			return false;
		}
		static function time_difference($date1, $date2) {
			$time1 = strtotime($date1);
			$time2 = strtotime($date2);
			return abs($time1-$time2);
		}
		static function date_to_format($date1) {
			$time = strtotime($date1);
			$date = date(DATE_FORMAT, $time);
			return $date;
		}
		static function send_mail($email, $sub, $msg) {
			$headers = 'From: ferm@ua';
			mail($email, $sub, $msg, $headers);
		}
		static function endsWith($haystack, $needle) {
			return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
		}
	}

?>