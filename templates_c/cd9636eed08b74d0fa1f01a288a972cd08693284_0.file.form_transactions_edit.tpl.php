<?php
/* Smarty version 3.1.30, created on 2018-02-06 03:54:53
  from "/home/cypper/Documents/localhost/templates/widgets/form_transactions_edit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a790aed7822f9_43579536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd9636eed08b74d0fa1f01a288a972cd08693284' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/form_transactions_edit.tpl',
      1 => 1515411141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a790aed7822f9_43579536 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-8 col-xs-12">
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

    <div class="col-md-6 col-xs-12">
      <div class="x_content">
        <br />
        <div class="form-horizontal form-label-left" id="check_form" onsubmit="void();">
          <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
            <button type="button" class="btn btn-danger" id="edit_notify" style="width: 100%;transition: 5s all;display: none;opacity: 1;"></button>
          </div></div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Id to edit</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" step="0.000001" id="id_to_edit" class="form-control col-md-10" required  />
            </div>
          </div>
          <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
             <button type="button" class="btn btn-primary" id="edit_check">Check</button>
          </div></div>

          
          
          <div id="buttons" style="display: none;">
            <br>
            <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Choose action (tns <span>-</span>)</label><div class="col-md-9 col-sm-9 col-xs-12">
               <button type="button" class="btn btn-round btn-primary" id="edit_edit">Edit</button>
               <button type="button" class="btn btn-round btn-danger" id="edit_delete">Delete</button>
               <button type="button" class="btn btn-round btn-default" id="edit_cancel">Cancel</button>
               <button type="button" class="btn btn-round btn-success" id="edit_save" style="display: none;">Save</button>
            </div></div>
          </div>
          <!-- <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
            <button type="button" class="btn btn-round btn-danger">Danger</button>
          </div></div> -->

          


        </div>

      </div>
    </div>
    <div class="col-md-6 col-xs-12">
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left" method="POST" action="/transactions/add">
          <div id="disabler" style="width: 100%;position: absolute;height: 100%;z-index: 10;background: #dadada40;top: 0px;"></div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Id </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" readonly id="ef_id" value="-">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Message
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea class="form-control" rows="3" placeholder='message' id="ef_message"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" id="ef_date" class="form-control col-md-10" required value="00 Jul 2980 00:00:00" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount in dollars</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" step="0.000001" id="ef_amount_in_dollars" class="form-control col-md-10" required />
            </div>
          </div>
          
          

          <hr>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Wallet from</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control" id="ef_from_wallet">
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
              <input type="number" step="0.000001" id="ef_amount_from" class="form-control col-md-10" required/>
            </div>
          </div>

          <div id="ef_froms">
          </div>
          <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
             <button type="button" class="btn btn-primary" id="ef_from_add">Add more</button>
             <button type="button" class="btn btn-danger" id="ef_from_delete">Delete one</button>
          </div></div>



          <hr>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Wallet to</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control" id="ef_to_wallet">
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
              <input type="number" step="0.000001" id="ef_amount_to" class="form-control col-md-10" required/>
            </div>
          </div>

          <div id="ef_tos">
          </div>
          <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12"></label><div class="col-md-9 col-sm-9 col-xs-12">
            <button type="button" class="btn btn-primary" id="ef_to_add">Add more</button>
            <button type="button" class="btn btn-danger" id="ef_to_delete">Delete one</button>
          </div></div>



        </form>
      </div>

    </div>
  </div>
</div>



<?php echo '<script'; ?>
>
  (function(){


    var tn = null;
    var check_form = document.getElementById('check_form');
    var disabler = document.getElementById('disabler');
    var id_to_edit = document.getElementById('id_to_edit');
    var edit_check = document.getElementById('edit_check');
    var buttons = document.getElementById('buttons');
    var edit_edit = document.getElementById('edit_edit');
    var edit_delete = document.getElementById('edit_delete');
    var edit_cancel = document.getElementById('edit_cancel');

    var ef_id = document.getElementById('ef_id');
    var ef_message = document.getElementById('ef_message');
    var ef_date = document.getElementById('ef_date');
    var ef_amount_in_dollars = document.getElementById('ef_amount_in_dollars');
    var ef_from_wallet = document.getElementById('ef_from_wallet');
    var ef_to_wallet = document.getElementById('ef_to_wallet');
    var ef_amount_from = document.getElementById('ef_amount_from');
    var ef_amount_to = document.getElementById('ef_amount_to');
    function show_buttons(id) {
      buttons.style.display = "block";
      buttons.querySelector("div.form-group > label > span").innerHTML = id;
    }
    function hide_buttons() {
      buttons.style.display = "none";
      buttons.querySelector("div.form-group > label > span").innerHTML = "-";
    }
    function show_note(text,color="red") {
      if (color) edit_notify.style.background = color;
      if (color) edit_notify.style.borderColor = color;
      edit_notify.style.display = "block";
      edit_notify.innerHTML = text;
      setTimeout(function(){
        edit_notify.style.opacity = 0;
      },1000)
      setTimeout(function(){
        edit_notify.style.display = "none";
        edit_notify.style.opacity = 1;
      },5000)
    }

    var from_id = 0;
    var to_id = 0;
    var froms = document.getElementById('ef_froms');
    var tos = document.getElementById('ef_tos');
    var ef_from_add = document.getElementById('ef_from_add');
    var ef_to_add = document.getElementById('ef_to_add');
    var ef_from_delete = document.getElementById('ef_from_delete');
    var ef_to_delete = document.getElementById('ef_to_delete');
    
    var empty_tn = {
      id: "-",
      date: "00 Jul 2980 00:00:00",
      message: "",
      amount: "",
      from: {
        capitals: [{
          id: "-",
          percentage: 1,
        }],
        amount: "",
        wallet: "USD"
      },
      to: {
        capitals: [{
          id: "-",
          percentage: 1,
        }],
        amount: "",
        wallet: "USD"
      }
    };

    function get_form(id,type,data={id:"-",percentage:1}) {
      var s = `<div id="ef_{type}_form_{id}"><div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">{Type} id:</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" disabled="disabled" value="{id}" id="ef_{type}_id_{id}">
        </div> 
      </div>

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Id </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" id="ef_{type}_name_{id}">
          
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
          <input required type="number" step="0.000001" min="0" max="1" id="ef_{type}_perc_{id}" class="form-control col-md-10" />
        </div>
      </div></div>`;
      console.log(type);
      s = s.replace(/{id}/g,id);
      s = s.replace(/{type}/g,type);
      s = s.replace(/{Type}/g,type.charAt(0).toUpperCase() + type.slice(1));
      var div = document.createElement('div');
      div.innerHTML = s;
      div.querySelector("#ef_"+type+"_name_"+id).value = data.id;
      div.querySelector("#ef_"+type+"_perc_"+id).value = data.percentage;
      console.log(s);
      return div;
    }
    function clear_form(id,type) {
      var toDelete = document.querySelector("#ef_"+type+"_form_"+id);
      toDelete.remove();
    }
    function clear_forms() {
      froms.innerHTML = "";
      tos.innerHTML = "";
    }


    function set_data_to_edit(tn) {
      clear_forms();
      for (var i = 0; i < tn.from.capitals.length; i++) {
        var cap = tn.from.capitals[i];
        froms.appendChild(get_form(i,"from",cap));
        from_id = i+1;
      }
      for (var i = 0; i < tn.to.capitals.length; i++) {
        var cap = tn.to.capitals[i];
        tos.appendChild(get_form(i,"to",cap));
        to_id = i+1;
      }
      ef_id.value = tn.id;
      ef_message.value = tn.message;
      ef_date.value = tn.date;
      ef_amount_in_dollars.value = tn.amount;
      ef_amount_from.value = tn.from.amount;
      ef_amount_to.value = tn.to.amount;
      ef_from_wallet.value = tn.from.wallet;
      ef_to_wallet.value = tn.to.wallet;
    }
    function get_data_from_edit() {
      var ef_froms = froms.querySelectorAll('[id^="ef_from_name_"]');
      var ef_tos = tos.querySelectorAll('[id^="ef_to_name_"]');

      
      var new_tn = {};
      new_tn.id = +ef_id.value;
      new_tn.message = ef_message.value;
      new_tn.date = ef_date.value;
      new_tn.amount = +ef_amount_in_dollars.value;
      new_tn.from = {};
      new_tn.to = {};
      new_tn.from.capitals = [];
      new_tn.to.capitals = [];
      new_tn.from.amount = +ef_amount_from.value;
      new_tn.to.amount = +ef_amount_to.value;
      new_tn.from.wallet = ef_from_wallet.value;
      new_tn.to.wallet = ef_to_wallet.value;
      for (var i = 0; i < ef_froms.length; i++) {
        var id = froms.querySelector('#ef_from_name_'+i).value;
        var percentage = +froms.querySelector('#ef_from_perc_'+i).value;
        new_tn.from.capitals.push({
          id: id,
          percentage: percentage
        });
      }
      for (var i = 0; i < ef_tos.length; i++) {
        var id = tos.querySelector('#ef_to_name_'+i).value;
        var percentage = +tos.querySelector('#ef_to_perc_'+i).value;
        new_tn.to.capitals.push({
          id: id,
          percentage: percentage
        });
      }
      return new_tn;
    }
    function serialize(obj, prefix) {
      var str = [], p;
      for(p in obj) {
        if (obj.hasOwnProperty(p)) {
          var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
          str.push((v !== null && typeof v === "object") ?
            serialize(v, k) :
            encodeURIComponent(k) + "=" + encodeURIComponent(v));
        }
      }
      return str.join("&");
    }

    edit_cancel.addEventListener("click", function() {
      set_data_to_edit(empty_tn);
      disabler.style.width = '100%';
      id_to_edit.readOnly = false;
      hide_buttons();
    })
    edit_delete.addEventListener("click", function() {
      var jqxhr = $.ajax( "/module/transactions?tns_api&tn_delete&id="+tn.id )
        .done(function(msg) {
          if (msg) {
            show_note("Deleted", "green");
            location.reload();
          } else {
            show_note("Not deleted somewhy");
          }
        })
        .fail(function() {
          show_note("Failed to send reqest");
          id_to_edit.readOnly = false;
        })
    })
    edit_edit.addEventListener("click", function() {
      disabler.style.width = '0%';
      set_data_to_edit(tn);
      edit_save.style.display = "inline";
      console.log(tn);
    })
    edit_save.addEventListener("click", function() {
      // disabler.style.width = '100%';
      var new_tn = get_data_from_edit();
      console.log(new_tn);
      new_tn = JSON.stringify(new_tn);
      console.log(serialize({ type:"tn_edit", id: tn.id, tn: new_tn }));
      $.ajax({
        type: "POST",
        headers: {
          'Content-Type':'application/x-www-form-urlencoded'
        },
        url: "/module/transactions",
        data: serialize({ type:"tn_edit", id: tn.id, tn: new_tn }),
        processData: false,
      })
        .done(function(msg) {
          if (msg) {
            show_note("Edited", "green");
            console.log(msg);
            console.log(!!msg);
            // location.reload();
          } else {
            show_note("Not edited somewhy");
          }
        })
        .fail(function() {
          show_note("Failed to send reqest");
          id_to_edit.readOnly = false;
        })
    })
    edit_check.addEventListener("click", function() {
      var id = +id_to_edit.value;
      id_to_edit.readOnly = true;
      var jqxhr = $.ajax( "/module/transactions?tns_api&tn_get&id="+id )
        .done(function(msg) {
          console.log(msg);
          tn = msg;
          if (tn == null) {
            show_note("Transaction "+id+" doesn't exist");
            id_to_edit.readOnly = false;
          } else {
            show_buttons(id);
          }
        })
        .fail(function() {
          show_note("Failed to send reqest");
          id_to_edit.readOnly = false;
        })
    })
    




    ef_from_add.addEventListener('click', function() {
      console.log(from_id);
      var id_some = get_form(from_id,"from");
      froms.appendChild(id_some);
      from_id++;
    })
    ef_to_add.addEventListener('click', function() {
      var id_some = get_form(to_id,"to");
      tos.appendChild(id_some);
      to_id++;
    })
    ef_from_delete.addEventListener('click', function() {
      clear_form(from_id-1,"from");
      from_id--;
    })
    ef_to_delete.addEventListener('click', function() {
      clear_form(to_id-1,"to");
      to_id--;
    })
  })()


<?php echo '</script'; ?>
>
<?php }
}
