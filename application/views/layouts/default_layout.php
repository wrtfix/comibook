<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="jorge carlos mendiola" >

    <title>CT20 - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>estilo/admin/css/table-responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>estilo/admin/css/bootstrap.css" rel="stylesheet">
    <!-- Add custom CSS here -->

    <link href="<?=base_url()?>estilo/admin/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>estilo/admin/font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    
    <script src="<?=base_url()?>estilo/admin/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>estilo/admin/js/bootstrap.js"></script>
    
            <link href="<?=base_url()?>estilo/admin/js/plugins/morris/morris.css" rel="stylesheet">
        <script src="<?=base_url()?>estilo/admin/js/plugins/morris/raphael.min.js"></script>
        <script src="<?=base_url()?>estilo/admin/js/plugins/morris/morris.min.js"></script>
    
    <!--<link href="<?=base_url()?>estilo/admin/css/lib/bootstrap-responsive.min.css" rel="stylesheet">-->
 <link href="<?=base_url()?>estilo/admin/css/custom.css" rel="stylesheet">
<link href="<?=base_url()?>estilo/admin/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="<?=base_url()?>estilo/admin/js/jquery-1.10.2.js"></script>
	<script src="<?=base_url()?>estilo/admin/js/jquery-ui-1.10.4.custom.js"></script>
	
	<!-- Tabla dinamica -->
	<script data-jsfiddle="common" src="<?=base_url()?>estilo/admin/js/handsontable/jquery.handsontable.full.js"></script>
  	<link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?=base_url()?>estilo/admin/js/handsontable/jquery.handsontable.full.css">
	<!-- Fin de Tabla dinamica -->
        
            <!-- Morris Charts JavaScript -->

        
	<script type="text/javascript">

/**
 * This javascript file checks for the brower/browser tab action.
 * It is based on the file menstioned by Daniel Melo.
 * Reference: http://stackoverflow.com/questions/1921941/close-kill-the-session-when-the-browser-or-tab-is-closed
 */
var validNavigation = false;
 
function wireUpEvents() {
  /**
   * For a list of events that triggers onbeforeunload on IE
   * check http://msdn.microsoft.com/en-us/library/ms536907(VS.85).aspx
   *
   * onbeforeunload for IE and chrome
   * check http://stackoverflow.com/questions/1802930/setting-onbeforeunload-on-body-element-in-chrome-and-ie-using-jquery
   */
  var dont_confirm_leave = 0; //set dont_confirm_leave to 1 when you want the user to be able to leave without confirmation
  var leave_message = 'You sure you want to leave?'
  function goodbye(e) {
    if (!validNavigation) {
      if (dont_confirm_leave!==1) {
        if(!e) e = window.event;
        //e.cancelBubble is supported by IE - this will kill the bubbling process.
        e.cancelBubble = true;
        e.returnValue = leave_message;
        //e.stopPropagation works in Firefox.
        if (e.stopPropagation) {
          e.stopPropagation();
          e.preventDefault();
        }
        //return works for Chrome and Safari
        return leave_message;
      }
    }
  }
  window.onbeforeunload=goodbye;
 
  // Attach the event keypress to exclude the F5 refresh
  $(document).bind('keypress', function(e) {
    if (e.keyCode == 116){
      validNavigation = true;
    }
  });
 
  // Attach the event click for all links in the page
  $("a").bind("click", function() {
    validNavigation = true;
  });
 
  // Attach the event submit for all forms in the page
  $("form").bind("submit", function() {
    validNavigation = true;
  });
 
  // Attach the event click for all inputs in the page
  $("input[type=submit]").bind("click", function() {
    validNavigation = true;
  });
 
}
 
// Wire up the events as soon as the DOM tree is ready
$(document).ready(function() {
  wireUpEvents();
});
	
	
$(function () {
    $("a").not('#lnkLogOut').click(function () {
        window.onbeforeunload = null;
    });
    $(".btn").click(function () {
        window.onbeforeunload = null;
});
});

	$(function($){
	    $.datepicker.regional['es'] = {
	        closeText: 'Cerrar',
	        prevText: '<Ant',
	        nextText: 'Sig>',
	        currentText: 'Hoy',
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	        weekHeader: 'Sm',
	        dateFormat: 'dd/mm/yy',
	        firstDay: 1,
	        isRTL: false,
	        showMonthAfterYear: false,
	        yearSuffix: ''
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});
	</script>
</head>
<body>
<div class="modal"><!-- Place at bottom of page --></div>
<div id="">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <?php if ($this->session->userdata('logged_in')['menu'][0]->peso === '1000') { ?>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-gear"></i> Sistema<b class="caret"></b></a> 
                <ul class="dropdown-menu multi-level">
                   <li><a href="/saltaChequeado/index.php/backoffice/configuracion/index"><i class="fa fa-fw fa-gear"></i> Configuracion </a></li>
                   <li><a href="/saltaChequeado/index.php/backoffice/menu/index"><i class="fa fa-wrench"></i> Menu </a></li>
                   <li><a href="/saltaChequeado/index.php/backoffice/usuario/index"><i class="fa fa-globe"></i> Usuarios </a></li>
                   <li><a href="/saltaChequeado/index.php/backup/index"><i class="fa fa-desktop"></i> Copia de Seguridad </a></li>
                   <li> <a href="/saltaChequeado/index.php/estadistica/index"><i class="fa fa-bar-chart-o"></i> Estadisticas </a></li>
                </ul>
             </li>
            <?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '20' || $this->session->userdata('logged_in')['menu'][0]->peso === '1000') { ?>
             
             <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-edit"></i> CMS<b class="caret"></b></a> 
                <ul class="dropdown-menu multi-level">
                   <li><a href="/saltaChequeado/index.php/noticias/index"><i class="fa fa-fw fa-edit"></i> Noticias</a></li>
                   <li><a href="/saltaChequeado/index.php/imagen/index"><i class="fa fa-bar-chart-o"></i> Imagenes</a></li>
                </ul>
             </li>
            <?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000') { ?>
             <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-edit"></i> Turnos<b class="caret"></b></a> 
                <ul class="dropdown-menu multi-level">
                   <li><a href="/saltaChequeado/index.php/turno/agenda/index"><i class="fa fa-fw fa-edit"></i> Agenda</a></li>
                </ul>
             </li>
             <?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '40'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000') { ?>
             <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-gear"></i> Logistica<b class="caret"></b></a> 
                <ul class="dropdown-menu multi-level">
                   <li><a href="/saltaChequeado/index.php/pedidos/index"><i class="fa fa-fw fa-edit"></i> Pedidos</a></li>
                   <li><a href="/saltaChequeado/index.php/pedientes/index"><i class="fa fa-calendar"></i> Pedientes </a></li>
                   <li><a href="/saltaChequeado/index.php/cheques/index"><i class="fa fa-fw fa-gear"></i> Cheque </a></li>
                   <li><a href="/saltaChequeado/index.php/gastos/index"><i class="fa fa-wrench"></i> Gasto </a></li>
                   <li><a href="/saltaChequeado/index.php/imprimir/index"><i class="fa fa-file"></i> Imprimir</a></li>
                   <li><a href="/saltaChequeado/index.php/clientes/index"><i class="fa fa-user"></i> Clientes</a></li>
                </ul>
             </li>
             <?php } ?>
            <li><a href="<?=base_url()?>index.php/about/index"><i class="fa fa-info-circle"></i> Acerca de...</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-gear"></i> <?php print_r($this->session->userdata('logged_in')['username']);?> <b class="caret"></b></a> 
                <ul class="dropdown-menu multi-level">
                   <li><a href="<?=base_url()?>index.php/backoffice/usuario/perfil"><i class="fa fa-fw fa-user"></i> Perfil</a></li>
                   <li class="divider"></li>
                   <li><a onclick="return confirm('Realmente desea salir?')" href="<?=base_url()?>index.php/home/logout"><i class="fa fa-power-off"></i> Salir </a></li>
                </ul>
              </li>
               
          </ul>
        </div>
        
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <div class="span9 content"><?php echo $content_for_layout ?> </div>
          </div>
        </div>




</body></html>

