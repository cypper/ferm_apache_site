<?php
	/**
	* ACCESS
	*/
	class AccessAPI {
		static function check_permission($needed,$tm) {
			$perms = json_decode($_SESSION["user"]->info)->permission;
			if ($needed == "user" && isset($perms)) return true;
			if ($perms == "all") return true;
			if (is_array($perms)) {
				foreach ($perms as $i => $perm) {
					if ($perm == $needed) return true;
				}
			}
			$tm->display_page('permission_denied.tpl');
			exit();
		}
		static function username_exist($username) {
			$sql = "SELECT * FROM users WHERE username='$username'";
			if ($GLOBALS['MQ']->query($sql)->num_rows >= 1) {
				return "username";
			}
			return null;
		}
		static function email_exist($email) {
			$sql = "SELECT * FROM users WHERE email='$email'";
			if ($GLOBALS['MQ']->query($sql)->num_rows >= 1) {
				return "email";
			}
			return null;
		}
		static function sign_up() {
			$username = $GLOBALS['MQ']->mq->real_escape_string($_GET["username"]);
			$email = $GLOBALS['MQ']->mq->real_escape_string($_GET["email"]);

			if (self::username_exist($username)) return "username";
			if (self::email_exist($email)) return "email";
			

			$password = $_GET["password"];
			$created_at = date(DATE_FORMAT);
			$salt = ''.mt_rand();
			$hash = hash("sha256", $password.$salt);
			$permission = [];
			$info = json_encode([
				"permission"=>$permission,
				"modules"=>new stdClass()
			]);
			$sql = "INSERT INTO users (username, password, salt, created_at, email, info) VALUES ('$username', '$hash', '$salt', '$created_at', '$email', '$info');";

			$GLOBALS['MQ']->query($sql);

			return "done";
		}
		static function sign_in() {
			$login = $GLOBALS['MQ']->mq->real_escape_string($_GET["login"]);
			$password = $_GET["password"];

			$sql = "SELECT * FROM users WHERE username='$login' OR email='$login'";
			$result = $GLOBALS['MQ']->query($sql);
			// UT::show($sql);
			if ($result->num_rows <= 0) {
				return "login";
			} else {
				$row = $result->fetch_object();
				$salt = $row->salt;
				$hash = hash("sha256", $password.$salt);
				// UT::show($salt);
				// UT::show($hash);
				// UT::show($row->password);

				if ($hash == $row->password) {
					setcookie("logged_in", $row->username.'|||'.substr($hash, 3, 10), time()+3600*24*30*6, "/");
					return "done";
				} else {
					return "password";
				}
			}
		}
		static function logout() {
			setcookie("logged_in", "", time()-10, "/");
			exit(header("Location: /"));
		}
	}

	$api = new API("access_api");

	$api->set_get("logout",function(){
		return AccessAPI::logout();
	},"application/json");

	$api->set_get("sign_up",function(){
		return AccessAPI::sign_up();
	});

	$api->set_get("sign_in",function(){
		return AccessAPI::sign_in();
	});

	$api->dispatch();
?>