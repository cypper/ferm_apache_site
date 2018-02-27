<div class="col-md-6">
  <div class="x_panel">
    <div class="x_title">
      <h2>{$vars.title}</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content bs-example-popovers">

    	{foreach from=$vars.data item=value}
	      <div class="alert alert-dismissible fade in" role="alert" style="color: #E9EDEF;background: {$value.color};">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: #E9EDEF;">×</span>
	        </button>
    			{$value.value}
	      </div>


    	{/foreach}

    </div>
  </div>
</div>