

<style>
	#iframes > .wrapper {
		height: 90vh;
		overflow-y: scroll;
		width: 100%;
	}
	#iframes > .iframeWrapper {
	}
	#iframes > .htmlWrapper {
	}
	#iframes > .htmlWrapper > * {
		transform-origin: 0 0;
	}
	#iframes > .htmlWrapper * {
		z-index: 100;
	}
</style>

<div id="chooseBook">
	<select id="selectBook">
		<option value=""></option>
	</select>
	<button id="setPosBook">Save bookmark scrollPos</button>
	<button id="deleteBook">Delete bookmark</button>
	<form id="formSavePage" ">
		<input type="number" id="pageSavePage">
		<button id="setSavePage">Save pagenum if PDF</button>
	</form>
	<form id="formNewBook" ">
		<input id="addNewBookName" placeholder="New book name" required>
		<input id="addNewBookPath" placeholder="New book path" required>
		<button>Add new book</button>
	</form>
	<button id="zoomin">+</button>
	<button id="zoomout">-</button>
</div>
<div id="iframes"></div>
<script></script>
<script>
	function httpGetAsync(theUrl,callback)
	{
	    var xmlHttp = new XMLHttpRequest();
	    xmlHttp.onreadystatechange = function() { 
	        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
	         callback(xmlHttp.responseText);
	    }
	    xmlHttp.open('GET', theUrl, true); // true for asynchronous 
	    xmlHttp.send(null);
	}

	// var url = '/module/books/api?books_api&get_book_page=4d';
	// httpGetAsync(url,function(res){
	// 	// console.log(res);
	// });
	var iframes = document.getElementById('iframes');
	var selectBook = document.getElementById('selectBook');
	var deleteBook = document.getElementById('deleteBook');
	var setPosBook = document.getElementById('setPosBook');
	var formNewBook = document.getElementById('formNewBook');
	var formSavePage = document.getElementById('formSavePage');
	var zoomin = document.getElementById('zoomin');
	var zoomout = document.getElementById('zoomout');

	var BOOKS = JSON.parse('{$vars.books_json}');
	var BOOK = null;
	var choosenBook = '';
	var ZOOM = 1;
	console.log(BOOKS);

	function init() {
		selectBook.innerHTML = '';
		selectBook.appendChild(createOption("",""));
		for (var book in BOOKS.bookmarks) {
			var scrollPos = BOOKS.bookmarks[book].scrollPos || 0;
			var zoom = BOOKS.bookmarks[book].zoom || 1;
			var page = +BOOKS.bookmarks[book].page || 0;
			var str = '';
			if (scrollPos > 1) str += " pos="+scrollPos+" ";
			if (zoom != 1) str += " zoom="+zoom+" ";
			if (page > 0) str += " page="+page+" ";
			if (str) str = "("+str+")";
			selectBook.appendChild(createOption(book+" "+str,book));
		}
		selectBook.value = choosenBook;
	}
	init();

	zoomin.addEventListener('click', function(e) {
		ZOOM+=0.1;
		setBookZoom(ZOOM);
	})
	zoomout.addEventListener('click', function(e) {
		var elment = document.querySelector("#iframes > .wrapper > *");
		ZOOM-=0.1;
		setBookZoom(ZOOM);
	})
	function setBookZoom(zoom) {
		var elment = document.querySelector("#iframes > .wrapper > *");
		if (zoom > 0.95 && zoom < 1.05) {
			elment.style.transform = "";
			return;
		}
		elment.style.transform = "scale("+zoom+")";
		console.log(elment);
	}

	formSavePage.addEventListener('submit', function(e) {
		e.preventDefault();
		var page = document.getElementById('pageSavePage').value;

		var url = '/module/books/api?books_api&set_book_conf='+choosenBook+'&pos='+BOOK.scrollTop+"&zoom="+ZOOM+"&page="+page;
		console.log(url);
		httpGetAsync(url,function(res){
			if (res != "done") {
				console.log("ERROR "+res );
			} else {
				BOOKS.bookmarks[choosenBook].scrollPos = BOOK.scrollTop;
				BOOKS.bookmarks[choosenBook].zoom = ZOOM;
				BOOKS.bookmarks[choosenBook].page = page;
				init();
			}
		});

	})
	formNewBook.addEventListener('submit', function(e) {
		e.preventDefault();
		var name = document.getElementById('addNewBookName').value;
		var path = document.getElementById('addNewBookPath').value;

		var url = encodeURI('/module/books/api?books_api&add_book_page='+name+'&path='+path);
		console.log(url);
		httpGetAsync(url,function(res){
			if (res != "done") {
				console.log("ERROR "+res );
			} else {
				location.reload();
			}
		});
	})

	
	deleteBook.addEventListener('click', function() {
		choosenBook = selectBook.value;
		if (!choosenBook) return;
		var url = '/module/books/api?books_api&delete_book='+choosenBook;
		console.log(url);
		httpGetAsync(url,function(res){
			if (res != "done") {
				console.log("ERROR "+res );
			} else {
				location.reload();
			}
		});
	})

	setPosBook.addEventListener('click', function() {
		choosenBook = selectBook.value;
		if (!choosenBook) return;
		var page = +BOOKS.bookmarks[choosenBook].page || 0;
		var url = '/module/books/api?books_api&set_book_conf='+choosenBook+'&pos='+BOOK.scrollTop+"&zoom="+ZOOM+"&page="+page;
		console.log(url);
		httpGetAsync(url,function(res){
			if (res != "done") {
				console.log("ERROR "+res );
			} else {
				BOOKS.bookmarks[choosenBook].scrollPos = BOOK.scrollTop;
				BOOKS.bookmarks[choosenBook].zoom = ZOOM;
				init();
			}
		});
	})

	selectBook.addEventListener('change', function() {
		console.log("change");
		choosenBook = this.value;
		if (!choosenBook) return;
		var path = BOOKS.bookmarks[choosenBook].path;
		var scrollPos = +BOOKS.bookmarks[choosenBook].scrollPos || 0;
		ZOOM = +BOOKS.bookmarks[choosenBook].zoom || 1;
		if (path.startsWith('http')) {
			BOOK = prepareFrame(path, function(e) {
				BOOK.scrollTop = scrollPos;
				setBookZoom(ZOOM);
			});

			setBookData(BOOK);
			BOOK.scrollTop = scrollPos;
		} else if (path.endsWith('pdf')) {
			console.log(path);
			var page = +BOOKS.bookmarks[choosenBook].page || 0;
			var url = '/module/books/api?books_api&get_book_page='+choosenBook+'#page='+page;
			BOOK = preparePDF(url, function(e) {
				BOOK.scrollTop = scrollPos;
				setBookZoom(ZOOM);
			});

			setBookData(BOOK);
			BOOK.scrollTop = scrollPos;
		} else {
			var url = '/module/books/api?books_api&get_book_page='+choosenBook;
			console.log(url);
			httpGetAsync(url,function(res){
				BOOK = prepareHTML(res);
				setBookData(BOOK);
				setBookZoom(ZOOM);
				BOOK.scrollTo(0, scrollPos);
			});
		}

	})
	function iframeLoad() {
		// console.log("loadasased");
	}
	function setBookData(child) {
		iframes.innerHTML = '';
		iframes.appendChild(child);
	}



	function createOption(name,value) {
		var opt = document.createElement("option");
		opt.setAttribute("value", value);
		opt.innerHTML = name;
		return opt;
	}
	function prepareHTML(htmlData) {
	  var htmlWrapper = document.createElement("div");
	  htmlWrapper.setAttribute("class", "htmlWrapper wrapper");
	  var html = document.createElement("div");
	  html.style.width = "100%";
	  html.style.height = "auto";
	  html.innerHTML = htmlData;
	  htmlWrapper.appendChild(html);
	  return htmlWrapper;
	}
	function preparePDF(url,onload) {
		var embWrapper = document.createElement("div");
		embWrapper.setAttribute("class", "iframeWrapper wrapper");
		embWrapper.style.overflowY = "hidden";
		var emb = document.createElement("embed");
		emb.setAttribute("src", url);
		// emb.setAttribute("type", "application/pdf");
		// emb.setAttribute("page", "10");
		emb.setAttribute("onload", "iframeLoad()");
		emb.style.width = "100%";
		emb.style.height = "100%";
		// emb.style.height = "1000000px";
		emb.addEventListener("load", onload);
		embWrapper.appendChild(emb);
		return embWrapper;
	}
	function prepareFrame(url,onload) {
	  var ifrmWrapper = document.createElement("div");
	  ifrmWrapper.setAttribute("class", "iframeWrapper wrapper");
	  var ifrm = document.createElement("iframe");
	  ifrm.setAttribute("src", url);
	  ifrm.setAttribute("scrolling", "no");
	  ifrm.setAttribute("onload", "iframeLoad()");
	  ifrm.style.width = "100%";
	  ifrm.style.height = "1000000px";
	  ifrm.addEventListener("load", onload);
	  ifrmWrapper.appendChild(ifrm);
	  return ifrmWrapper;
	}

	// var book = prepareFrame("https://meyerweb.com/eric/tools/dencoder/", function(e) {});

	// setBookData(book);

	addEventListener("load", function() {
		// book.scrollTo(0s, 100);
	})
</script>