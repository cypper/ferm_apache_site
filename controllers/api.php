<?php
	/**
	* API
	*/
	class API {
		function __construct($secret_key) {
			$this->sk = $secret_key;
			$this->getters = [];
			$this->postters = [];
		}
		function set_get($pk, $listener, $content_type="text/plain") {
			$this->getters[$pk] = [
				"listener"=>$listener,
				"content_type"=>$content_type
			];
		}
		function set_post($pk, $listener, $content_type="text/plain") {
			$this->postters[$pk] = [
				"listener"=>$listener,
				"content_type"=>$content_type
			];
		}
		function dispatch() {
			$result = null;
			$tter = null;
			if (isset($_GET[$this->sk])) {
				foreach ($this->getters as $pk => $value) {
					if (isset($_GET[$pk])) {
						$tter = $value;
						break;
					}
				}
			}
			if (!$tter && isset($_POST[$this->sk])) {
				foreach ($this->postters as $pk => $value) {
					if (isset($_POST[$pk])) {
						$tter = $value;
						break;
					}
				}
			}
			if ($tter) {
				header("Content-type:".$tter["content_type"]);
				echo $tter["listener"]();
			}
		}
	}
?>