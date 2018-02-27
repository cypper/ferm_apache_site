<?php
	function func_enabled($func) {
		if (!function_exists($func)) return false;
		$disabled = explode(',', ini_get('disable_functions'));
		return !in_array($func, $disabled);
	}
	function curl($url,$params=null) {
		if (!func_enabled('curl_exec')) {
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

	echo curl("http://ferm.pp.ua/module/workers/api?wor_api&check_workers");
?>