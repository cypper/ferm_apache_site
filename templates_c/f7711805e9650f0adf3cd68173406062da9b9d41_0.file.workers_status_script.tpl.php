<?php
/* Smarty version 3.1.30, created on 2018-02-26 00:19:33
  from "/home/cypper/Documents/localhost/modules/workers/assets/workers_status_script.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a933675dd8b76_06600615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7711805e9650f0adf3cd68173406062da9b9d41' => 
    array (
      0 => '/home/cypper/Documents/localhost/modules/workers/assets/workers_status_script.tpl',
      1 => 1519597172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a933675dd8b76_06600615 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
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
<?php echo '</script'; ?>
><?php }
}
