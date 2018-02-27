<?php
	require_once 'modules/books/api.php';
	
	/**
	* Books
	*/
	class BooksModules
	{
		static function json_books_module($opt=[]) {
			$books = BooksAPI::get_books();

			$module_vars = [
				"title"=>"Books",
				"header"=>"",
				"subheader"=>UT::show($books,true),
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
		static function books_module($opt=[]) {

			$books = BooksAPI::get_books();

			$books_json = json_encode($books);


			$tm = new Tm('modules/books/assets/');
			$tm->set_smarty_vars(["vars"=>[
				"books_json"=>$books_json
			]]);

			$output = $tm->get_page('books.tpl');

			$module_vars = [
				"title"=>"Books",
				"header"=>"",
				"subheader"=>$output,
				"size"=>isset($opt["size"]) ? $opt["size"] : 12
			];
			return [
				"vars"=>$module_vars,
				"widget"=>"plain_text"
			];
		}
		

	}
?>