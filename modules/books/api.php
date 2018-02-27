<?php
	require_once 'modules/user/api.php';

	/**
	* Diary
	*/
	class BooksAPI
	{
		static $user_info;
		static $books;
		static $which;
		static function init() {
			$username = UserAPI::get_all_user_data()->username;
			if (!self::$user_info || !self::$books || !self::$which) {
				self::$which = "WHERE username='$username'";
				self::$user_info = $GLOBALS['MQ']->get_json_var("users","info",self::$which);
				if (!isset(self::$user_info->modules->books)) {
					self::$user_info->modules->books = new stdClass();
					self::$user_info->modules->books->bookmarks = [];
					self::save();
				}
				self::$books = self::$user_info->modules->books;
			}
		}
		static function save() {
			if (!self::$user_info || !self::$which) return;
			$GLOBALS['MQ']->update_json_var("users","info",self::$user_info,self::$which);
		}
		static function get_books() {
			self::init();
			return self::$books;
		}
		static function get_book_page($book) {
			self::init();
			$book = self::$books->bookmarks->$book;
			if (substr( $book->path, 0, 4 ) === "http") {
				return file_get_contents($book->path);
			} elseif (UT::endsWith($book->path, "pdf")) {
				header('Content-Type: application/pdf');
				return file_get_contents(__DIR__."/assets/books/".$book->path);
			} else {

				return file_get_contents(__DIR__."/assets/books/".$book->path);
			}

		}
		static function add_book_page($book,$path) {
			self::init();
			self::$books->bookmarks->$book = new stdClass();
			self::$books->bookmarks->$book->path = $path;
			self::$books->bookmarks->$book->scrollPos = 0;
			self::$books->bookmarks->$book->zoom = 1;
			self::$books->bookmarks->$book->page = 0;
			self::save();
			return "done";

		}
		static function set_book_conf($book,$pos,$zoom,$page) {
			self::init();
			self::$books->bookmarks->$book->scrollPos = $pos;
			self::$books->bookmarks->$book->zoom = $zoom;
			self::$books->bookmarks->$book->page = $page;
			self::save();
			return "done";
		}
		static function delete_book($book) {
			self::init();
			unset(self::$books->bookmarks->$book);
			self::save();
			return "done";
		}

	}
	$api = new API("books_api");

	$api->set_get("get_book_page",function(){
		return BooksAPI::get_book_page($_GET["get_book_page"]);
	},"as");

	$api->set_get("add_book_page",function(){
		if (!isset($_GET["path"])) return '';
		return BooksAPI::add_book_page($_GET["add_book_page"],$_GET["path"]);
	});

	$api->set_get("set_book_conf",function(){
		if (!(isset($_GET["pos"]) && isset($_GET["zoom"]) && isset($_GET["page"]))) return '';
		return BooksAPI::set_book_conf($_GET["set_book_conf"],$_GET["pos"],$_GET["zoom"],$_GET["page"]);
	});

	$api->set_get("delete_book",function(){
		return BooksAPI::delete_book($_GET["delete_book"]);
	});

	$api->dispatch();
?>