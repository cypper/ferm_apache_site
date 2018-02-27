<div class="col-md-4 col-xs-12">
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
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left" method="POST" action="/transactions/add">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Id </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" readonly name="id" value="{$vars.id}">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Message
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea class="form-control" rows="3" placeholder='message' name="message"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" name="date" id="autocomplete-custom-append" class="form-control col-md-10" required value="00 Jul 2980 00:00:00" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount in dollars</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" step="0.000001" name="amount_in_dollars" id="autocomplete-custom-append" class="form-control col-md-10" required />
          </div>
        </div>
        
        

        <hr>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Wallet from</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="from_wallet">
              {foreach from=$vars.wallets key=key item=value}<option value="{$key}">{$value->name}</option>{/foreach}
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount from</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" step="0.000001" name="amount_from" id="autocomplete-custom-append" class="form-control col-md-10" required/>
          </div>
        </div>

        <div id="froms">
        </div>
        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
           <button type="button" class="btn btn-primary" id="from_add">Add more</button>
        </div></div>



        <hr>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Wallet to</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="to_wallet">
              {foreach from=$vars.wallets key=key item=value}<option value="{$key}">{$value->name}</option>{/foreach}
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount to</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" step="0.000001" name="amount_to" id="autocomplete-custom-append" class="form-control col-md-10" required/>
          </div>
        </div>

        <div id="tos">
        </div>
        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
          <button type="button" class="btn btn-primary" id="to_add">Add more</button>
        </div></div>
        
        

        {literal}
        <script>
          var from_id = 0;
          var to_id = 0;
          var froms = document.getElementById('froms');
          var from_add = document.getElementById('from_add');
          var tos = document.getElementById('tos');
          var to_add = document.getElementById('to_add');
          function get_form(id,type) {
            var s = `<div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">{Type} id:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" disabled="disabled" value="{id}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Id </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="{type}_name_{id}">
                {/literal}
                  {foreach from=$vars.ids key=key item=value}<option value="{$key}">{$value->name}</option>{/foreach}
                {literal}
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Percentage (0 - 1)</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input required type="number" step="0.000001" min="0" max="1" name="{type}_perc_{id}" class="form-control col-md-10" />
              </div>
            </div>`;
            console.log(type);
            s = s.replace(/{id}/g,id);
            s = s.replace(/{type}/g,type);
            s = s.replace(/{Type}/g,type.charAt(0).toUpperCase() + type.slice(1));
            var div = document.createElement('div');
            div.innerHTML = s;
            console.log(s);
            return div;
          }
          var id_0 = get_form(from_id,"from");
          froms.appendChild(id_0);
          from_id++;
          var id_0 = get_form(to_id,"to");
          tos.appendChild(id_0);
          to_id++;

          from_add.addEventListener('click', function() {
            var id_some = get_form(from_id,"from");
            froms.appendChild(id_some);
            from_id++;

          })
          to_add.addEventListener('click', function() {
            var id_some = get_form(to_id,"to");
            tos.appendChild(id_some);
            to_id++;

          })


        </script>
        {/literal}



        


        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>