<?php
/* Smarty version 3.1.30, created on 2018-02-07 21:48:44
  from "/home/cypper/Documents/localhost/templates/widgets/table.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a7b581c6f2211_45621499',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ecda6c209b4084dcdac365dea7bc1d3d0a1633d' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/widgets/table.tpl',
      1 => 1518032703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a7b581c6f2211_45621499 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('random', rand(1,2000));
?>
<div class="col-md-<?php if (isset($_smarty_tpl->tpl_vars['vars']->value['size'])) {
echo $_smarty_tpl->tpl_vars['vars']->value['size'];
} else { ?>12<?php }?> col-xs-12">
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
     <table id="datatable<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
" class="table table-striped table-bordered">
       <thead>
         <tr>
           <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['headers'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
             <th><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</th>
           <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

         </tr>
       </thead>


       <tbody>
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['values'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
           <tr>
             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
               <td><?php echo $_smarty_tpl->tpl_vars['data']->value;?>
</td>
             <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

           </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

       </tbody>
     </table>
   </div>
 </div>
</div>

<?php echo '<script'; ?>
>
  function init_DataTables(str) {
    
    console.log('run_datatables');
    
    if( typeof ($.fn.DataTable) === 'undefined'){ return; }
    console.log('init_DataTables');
    
    var handleDataTableButtons = function() {
      if ($("#datatable-buttons").length) {
      $("#datatable-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [
        {
          extend: "copy",
          className: "btn-sm"
        },
        {
          extend: "csv",
          className: "btn-sm"
        },
        {
          extend: "excel",
          className: "btn-sm"
        },
        {
          extend: "pdfHtml5",
          className: "btn-sm"
        },
        {
          extend: "print",
          className: "btn-sm"
        },
        ],
        responsive: true
      });
      }
    };

    TableManageButtons = function() {
      "use strict";
      return {
      init: function() {
        handleDataTableButtons();
      }
      };
    }();

    $('#'+str).dataTable();

    $('#datatable-keytable').DataTable({
      keys: true
    });

    $('#datatable-responsive').DataTable();

    $('#datatable-scroller').DataTable({
      ajax: "js/datatables/json/scroller-demo.json",
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
    });

    $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });

    var $datatable = $('#datatable-checkbox');

    $datatable.dataTable({
      'order': [[ 1, 'asc' ]],
      'columnDefs': [
      { orderable: false, targets: [0] }
      ]
    });
    $datatable.on('draw.dt', function() {
      $('checkbox input').iCheck({
      checkboxClass: 'icheckbox_flat-green'
      });
    });

    TableManageButtons.init();
    
  };
  
  $(document).ready(function() {
    init_DataTables("datatable<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
");

  })
<?php echo '</script'; ?>
>

<!-- Datatables -->

<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-buttons/js/buttons.flash.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-buttons/js/buttons.html5.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-buttons/js/buttons.print.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"><?php echo '</script'; ?>
>

<?php if (isset($_smarty_tpl->tpl_vars['vars']->value['raw_data'])) {
echo $_smarty_tpl->tpl_vars['vars']->value['raw_data'];
} else {
}
}
}
