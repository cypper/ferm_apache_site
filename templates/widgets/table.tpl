{assign var='random' value=1|rand:2000}
<div class="col-md-{if isset($vars.size)}{$vars.size}{else}12{/if} col-xs-12">
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
     <table id="datatable{$random}" class="table table-striped table-bordered">
       <thead>
         <tr>
           {foreach from=$vars.headers item=value}
             <th>{$value}</th>
           {/foreach}
         </tr>
       </thead>


       <tbody>
         {foreach from=$vars.values item=value}
           <tr>
             {foreach from=$value item=data}
               <td>{$data}</td>
             {/foreach}
           </tr>
        {/foreach}
       </tbody>
     </table>
   </div>
 </div>
</div>

<script>
  function init_DataTables(str) {
    {literal}
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
  {/literal}
  $(document).ready(function() {
    init_DataTables("datatable{$random}");

  })
</script>

<!-- Datatables -->

<link href="{$assets}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<link href="{$assets}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

<link href="{$assets}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">

<link href="{$assets}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

<link href="{$assets}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<script src="{$assets}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="{$assets}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="{$assets}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script src="{$assets}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>

<script src="{$assets}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>

<script src="{$assets}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>

<script src="{$assets}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

<script src="{$assets}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>

<script src="{$assets}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>

<script src="{$assets}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

<script src="{$assets}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<script src="{$assets}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

{if isset($vars.raw_data)}{$vars.raw_data}{else}{/if}