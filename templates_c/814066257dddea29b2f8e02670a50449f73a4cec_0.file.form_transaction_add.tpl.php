<?php
/* Smarty version 3.1.30, created on 2018-02-06 03:54:53
  from "/home/cypper/Documents/localhost/templates/widgets/form_transaction_add.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a790aed775019_49640953',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '814066257dddea29b2f8e02670a50449f73a4cec' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/form_transaction_add.tpl',
      1 => 1515411159,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a790aed775019_49640953 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-4 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><?php echo $_smarty_tpl->tpl_vars['vars']->value['title'];?>
</h2>
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
            <input type="text" class="form-control" readonly name="id" value="<?php echo $_smarty_tpl->tpl_vars['vars']->value['id'];?>
">
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
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['wallets'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?><option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['wallets'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?><option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
        
        

        
        <?php echo '<script'; ?>
>
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
                
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['ids'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?><option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                
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


        <?php echo '</script'; ?>
>
        



        


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
</div><?php }
}
