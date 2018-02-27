<script>
	function httpGetAsync(theUrl)
	{
	    var xmlHttp = new XMLHttpRequest();
	    xmlHttp.onreadystatechange = function() { 
	        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
	            console.log('changed');
	    }
	    xmlHttp.open('GET', theUrl, true); // true for asynchronous 
	    xmlHttp.send(null);
	}
	var workers = document.querySelectorAll('input.worker_checkbox');
	for(var i = 0; i<workers.length; i++) {
		var worker = workers[i];

		worker.addEventListener('change', function(){
			var watch = this.checked ? 1 : 0;
			var name = this.id.slice(7);
			var url = '/module/workers/api?wor_api&set_worker_watch&set_worker_watch_name='+name+'&set_worker_watch_status='+watch;
			httpGetAsync(url);
		});
	}
</script>