<?php
	/**
	* ACCESS
	*/
	class AccessController {
		static function access() {

			if (isset($_COOKIE['logged_in'])) {
				$logged_in = $_COOKIE['logged_in'];
				$logged_in = explode('|||', $logged_in);
				if (!isset($logged_in[0]) || !isset($logged_in[1])) return false;
				$username = $logged_in[0];
				$hash = $logged_in[1];
				$sql = "SELECT * FROM users WHERE username='$username'";
				$result = $GLOBALS['MQ']->query($sql);
				if ($result->num_rows <= 0) return false;
				$row = $result->fetch_object();
				if ($hash == substr($row->password, 3, 10)) {
					$_SESSION["user"] = $row;
					return true;
				} else {
					return false;
				}
			}

			return false;
		}
	}
?>