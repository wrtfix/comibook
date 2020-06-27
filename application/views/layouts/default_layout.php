<html>
  <head>

    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

    <meta name="description" content="">
    <meta name="author" content="jorge carlos mendiola" >

        <title>CT20 - Admin</title>

        <!-- Bootstrap core CSS -->
        <link href="<?= base_url() ?>estilo/admin/css/table-responsive.css" rel="stylesheet">
        <link href="<?= base_url() ?>estilo/admin/css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->

        <link href="<?= base_url() ?>estilo/admin/css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>estilo/admin/font-awesome/css/font-awesome.min.css">
        <!-- Page Specific CSS -->

        <script src="<?= base_url() ?>estilo/admin/js/jquery-1.10.2.js"></script>
        <script src="<?= base_url() ?>estilo/admin/js/bootstrap.js"></script>

        <link href="<?= base_url() ?>estilo/admin/js/plugins/morris/morris.css" rel="stylesheet">
        <script src="<?= base_url() ?>estilo/admin/js/plugins/morris/raphael.min.js"></script>
        <script src="<?= base_url() ?>estilo/admin/js/plugins/morris/morris.min.js"></script>

<!--<link href="<?= base_url() ?>estilo/admin/css/lib/bootstrap-responsive.min.css" rel="stylesheet">-->
        <link href="<?= base_url() ?>estilo/admin/css/custom.css" rel="stylesheet">
        <link href="<?= base_url() ?>estilo/admin/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <script src="<?= base_url() ?>estilo/admin/js/jquery-1.10.2.js"></script>
        <script src="<?= base_url() ?>estilo/admin/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="<?= base_url() ?>estilo/admin/js/jquery.blockUI.js"></script>
        <link rel="stylesheet" href="<?=base_url()?>estilo/mapa/leaflet.css" />	
        <script src="<?=base_url()?>estilo/mapa/leaflet.js"></script>

        <!-- Tabla dinamica -->
        <script data-jsfiddle="common" src="<?= base_url() ?>estilo/admin/js/handsontable/jquery.handsontable.full.js"></script>
        <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?= base_url() ?>estilo/admin/js/handsontable/jquery.handsontable.full.css">
        <!-- Fin de Tabla dinamica -->

        <!-- Morris Charts JavaScript -->

        <script type="text/javascript">


            /**
             * This javascript file checks for the brower/browser tab action.
             * It is based on the file menstioned by Daniel Melo.
             * Reference: http://stackoverflow.com/questions/1921941/close-kill-the-session-when-the-browser-or-tab-is-closed
             */
            var validNavigation = false;
            var canExit = false;
            var tasks = [];
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
                        if (dont_confirm_leave !== 1) {
                            if (!e)
                                e = window.event;
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
                window.onbeforeunload = goodbye;

                // Attach the event keypress to exclude the F5 refresh
                $(document).bind('keypress', function (e) {
                    if (e.keyCode == 116) {
                        validNavigation = true;
                    }
                });

                // Attach the event click for all links in the page
                $("a").bind("click", function () {
                    validNavigation = true;
                });

                // Attach the event submit for all forms in the page
                $("form").bind("submit", function () {
                    validNavigation = true;
                });

                // Attach the event click for all inputs in the page
                $("input[type=submit]").bind("click", function () {
                    validNavigation = true;
                });

            }

            // Wire up the events as soon as the DOM tree is ready
            $(document).ready(function () {
                changeScreen();
                wireUpEvents();
            });


            function showInfo(msg, type) {
                $(".close").trigger( "click" );
                $("#resultadoOperacion").append('<div class="alert alert-dismissable alert-' + type + '"> <button type="button" class="close" data-dismiss="alert">×</button>' + msg + '</div>');
            }

           
            $(function () {
                $("a").not('#lnkLogOut').click(function () {
                    window.onbeforeunload = null;
                });
                $(".btn").click(function () {
                    window.onbeforeunload = null;
                });
            });

            $(function ($) {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '<Ant',
                    nextText: 'Sig>',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);
            });

            function mobileAndTabletcheck() {
                var check = false;
                (function (a) {
                    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                        check = true;
                })(navigator.userAgent || navigator.vendor || window.opera);
                if (navigator.userAgent.match(/Android/i)
                        || navigator.userAgent.match(/webOS/i)
                        || navigator.userAgent.match(/iPhone/i)
                        || navigator.userAgent.match(/iPad/i)
                        || navigator.userAgent.match(/iPod/i)
                        || navigator.userAgent.match(/BlackBerry/i)
                        || navigator.userAgent.match(/Windows Phone/i)
                        ) {
                    check = true;
                } else {
                    if (window.innerWidth <= 800 && window.innerHeight <= 600) {
                        check = true;
                    }
                }
                return check;
            }

            function changeScreen() {
                if (mobileAndTabletcheck()) {
                    $(".desktop").hide();
                    $(".mobile").show();
                } else {
                    $(".desktop").show();
                    $(".mobile").hide();
                }
            }

            $(window).resize(function () {
                changeScreen();
            });
            function block_screen() {
                $.blockUI({message: 'Estamos procesando su solicitud'});
            }

            function unblock_screen() {
                setTimeout($.unblockUI, 1000);
            }
            
            var taskNumber = 0;
            function exit(){
                $("#msjConfirmacionModal").html("Esta seguro que desea salir?");
                taskNumber = 0;
            }

            function loadContent(id, url) {
                var postUrl = "<?= base_url() ?>" + url;
                $.ajax({
                    type: "POST",
                    url: postUrl,
                    success: function (response) {
                        $(id).prepend(response)
                    }
                });
            }
            
            var salir = function salir(){
                var url = '<?=base_url()?>index.php/home/logout';
                window.location.href = url;
            }
            tasks.push(salir);
            
            function confirmationModalAceptar(){
                tasks[taskNumber].call();
            }

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
                                    <li><a href="<?php echo site_url('/backoffice/configuracion/index'); ?>"><i class="fa fa-fw fa-gear"></i> Configuracion </a></li>
                                    <li><a href="<?php echo site_url('/backoffice/literales/index'); ?>"><i class="fa fa-fw fa-flag"></i> Literales </a></li>
                                    <li><a href="<?php echo site_url('/backoffice/menu/index'); ?>"><i class="fa fa-wrench"></i> Menu </a></li>
                                    <li><a href="<?php echo site_url('/backoffice/ambiente/index'); ?>"><i class="fa fa-globe"></i> Ambiente </a></li>
                                    <li><a href="<?php echo site_url('/backoffice/usuario/index'); ?>"><i class="fa fa-user"></i> Usuarios </a></li>
                                    <li><a href="<?php echo site_url('/backoffice/backup/index'); ?>"><i class="fa fa-desktop"></i> Actualizaciones </a></li>
                                    <li><a href="<?php echo site_url('/backoffice/monitoreo/index'); ?>"><i class="fa fa-book"></i> Monitoreo </a></li>

                                </ul>
                            </li>
<?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '20' || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001') { ?>

                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-edit"></i> Diario <b class="caret"></b></a> 
                                <ul class="dropdown-menu multi-level">
                                    <li><a href="<?php echo site_url('/cms/noticias/index'); ?>"><i class="fa fa-fw fa-edit"></i> Noticias</a></li>
                                    <li><a href="<?php echo site_url('/cms/imagen/index'); ?>"><i class="fa fa-camera-retro"></i> Imagenes</a></li>
                                    <li><a href="<?php echo site_url('/cms/comentario/comentarios'); ?>"><i class="fa fa-comments"></i> Comentarios </a></li>
                                    <?php if ($this->session->userdata('logged_in')['menu'][0]->peso === '1000') { ?>
                                        <li><a href="<?php echo site_url('/cms/scrapping/index/clarin'); ?>"><i class="fa fa-code-fork"></i> Scrapping Clarin </a></li>
                                        <li><a href="<?php echo site_url('/cms/scrapping/index/quepasasalta'); ?>"><i class="fa fa-code-fork"></i> Scrapping Que Pasa Salata </a></li>
                                        <!--<li><a href="/index.php/cms/scrapping/index/eltribuno"><i class="fa fa-code-fork"></i> Scrapping El tribuno </a></li>--> 
    <?php } ?>
                                </ul>
                            </li>
<?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '30' || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001') { ?>
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-check"></i> Servicio <b class="caret"></b></a> 
                                <ul class="dropdown-menu multi-level">
                                    <li><a href="<?php echo site_url('/turnera/consultorio/index'); ?>"><i class="fa fa-fw fa-gear"></i> Locales </a></li>
                                    <li><a href="<?php echo site_url('/provedores/index'); ?>"><i class="fa fa-ambulance"></i> Provedores</a></li>
                                    <li><a href="<?php echo site_url('/turnera/consultorio/selectConsultrio'); ?>"><i class="fa fa-fw fa-book"></i> Agenda</a></li>
                                    <li><a href="<?php echo site_url('/gastos/index'); ?>"><i class="fa fa-wrench"></i> Gastos </a></li>
                                    <li><a href="<?php echo site_url('/clientes/index'); ?>"><i class="fa fa-user"></i> Clientes </a></li>
                                    
                                    <li><a href="<?php echo site_url('/backoffice/monitoreo/index'); ?>"><i class="fa fa-book"></i> Monitoreo </a></li>
                                </ul>
                            </li>
<?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '40' || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001') { ?>
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-ambulance"></i> Logistica<b class="caret"></b></a> 
                                <ul class="dropdown-menu multi-level">
                                    <li><a href="<?php echo site_url('/pedidos/index'); ?>"><i class="fa fa-fw fa-book"></i> Pedidos</a></li>
                                    <li><a href="<?php echo site_url('/pedientes/index'); ?>"><i class="fa fa-calendar"></i> Pedientes </a></li>
                                    <li><a href="<?php echo site_url('/cheques/index'); ?>"><i class="fa fa-fw fa-money"></i> Cheques </a></li>
                                    <li><a href="<?php echo site_url('/gastos/index'); ?>"><i class="fa fa-wrench"></i> Gastos </a></li>
                                    <li><a href="<?php echo site_url('/imprimir/index'); ?>"><i class="fa fa-file"></i> Imprimir</a></li>
                                    <li><a href="<?php echo site_url('/clientes/index'); ?>"><i class="fa fa-user"></i> Clientes</a></li>
                                <?php if ($this->session->userdata('logged_in')['menu'][0]->peso === '1000') { ?>
                                        <li> <a href="<?php echo site_url('/estadistica/index'); ?>"><i class="fa fa-bar-chart-o"></i> Estadisticas </a></li>
    <?php } ?>
                                </ul>
<?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '41') { ?>
                            <li>
                            <li><a href="<?php echo site_url('/pedidos/index'); ?>"><i class="fa fa-fw fa-book"></i> Pedidos</a></li>
                            <li><a href="<?php echo site_url('/pedientes/index'); ?>"><i class="fa fa-calendar"></i> Pedientes </a></li>
                            <li><a href="<?php echo site_url('/cheques/index'); ?>"><i class="fa fa-fw fa-money"></i> Cheques </a></li>
                            <li><a href="<?php echo site_url('/gastos/index'); ?>"><i class="fa fa-wrench"></i> Gastos </a></li>
                            <li><a href="<?php echo site_url('/imprimir/index'); ?>"><i class="fa fa-file"></i> Imprimir</a></li>
                            <li><a href="<?php echo site_url('/clientes/index'); ?>"><i class="fa fa-user"></i> Clientes</a></li>
                            <li> <a href="<?php echo site_url('/estadistica/index'); ?>"><i class="fa fa-bar-chart-o"></i> Estadisticas </a></li>
                            </li>
<?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '50' || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001') { ?>
                            <li>
                                <li><a href="<?php echo site_url('/turnera/consultorio/index'); ?>"><i class="fa fa-fw fa-gear"></i> Locales </a></li>
                                <li><a href="<?php echo site_url('/producto/index'); ?>"><i class="fa fa-gift"></i> Productos</a></li>
                                <li><a href="<?php echo site_url('/cms/comentario/comentarios'); ?>"><i class="fa fa-comments"></i> Consultas </a></li>
                                <li><a href="<?php echo site_url('/solicitudes/index'); ?>"><i class="fa fa-edit"></i> Solicitudes</a></li>
                                <li> <a href="<?php echo site_url('/estadistica/index'); ?>"><i class="fa fa-bar-chart-o"></i> Estadisticas </a></li>
                                <li><a href="<?php echo site_url('/solicitudes/index'); ?>"><i class="fa fa-edit"></i> Configuracion </a></li>
                            </li>
<?php } if ($this->session->userdata('logged_in')['menu'][0]->peso === '51') { ?>
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-home"></i> Kiosko<b class="caret"></b></a> 
                                <ul class="dropdown-menu multi-level">
                                    <li><a href="<?php echo site_url('/ventas/index'); ?>"><i class="fa fa-fw fa-coffee"></i> Ventas</a></li>
                                    <li><a href="<?php echo site_url('/clientes/index'); ?>"><i class="fa fa-user"></i> Clientes</a></li>
                                    <li><a href="<?php echo site_url('/solicitudes/index'); ?>"><i class="fa fa-edit"></i> Generar Solicitudes</a></li>
                                </ul>
                            </li>
<?php } ?>
                        <li><a href="<?= base_url() ?>index.php/about/index'); ?>"><i class="fa fa-info-circle"></i> Acerca de...</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-gear"></i> <?php print_r($this->session->userdata('logged_in')['username']); ?> <b class="caret"></b></a> 
                            <ul class="dropdown-menu multi-level">
<?php if (count($this->session->userdata('logged_in')['cantAmbientes']) > 1) { ?>
                                    <li><a href="<?= base_url() ?>index.php/backoffice/elegirAmbiente/index/<?php print_r($this->session->userdata('logged_in')['id']); ?>"><i class="fa fa-fw fa-home"></i> Ambiente </a></li>
<?php } ?>
                                <li><a href="<?= base_url() ?>index.php/backoffice/usuario/perfil"><i class="fa fa-fw fa-user"></i> Perfil</a></li>
                                <li><a href="https://wa.me/5492494609270"><i class="fa fa-fw fa-question"></i> Ayuda</a></li>
                                <li class="divider"></li>
                                <li><a data-target='#confirmationModal' data-toggle='modal' onclick="exit();" ><i class="fa fa-power-off"></i> Salir </a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </nav>

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="span9 content">
                            <?php if (!empty($exito)) { ?>
                                <div class="alert alert-dismissable alert-info">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Se guardaron los datos correctamente
                                </div>
<?php } ?>
                            <div id="resultadoOperacion"></div>
<?php echo $content_for_layout ?> 
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="confirmationModalBody">
                        <div class="modal-body" >
                            <div id="msjConfirmacionModal">Esta seguro que desea salir?</div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="confirmationModalCancelar()">Cancelar</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirmationModalAceptar()">Aceptar</button>
                        </div>
                    </div>
                    
              </div>
            </div>
            
            <!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <ul class="nav nav-tabs">
            <li id="tab1" class="active"><a href="#">Imagen desde URL</a></li>
            <li id="tab2"><a href="#">Seleccionar Imagen</a></li>
        </ul>
        <div class="modal-body" >
            <div id="screenSelImagen" style="display:none;">
            <table class="table table-bordered table-hover tablesorter" id="tablaGastos" xagregar="false">
            <thead>
              <tr>
                <th class="header">Seleccionar<i class=""></i></th>                    
                <th class="header">Imagen<i class=""></i></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($imagenes as $item): ?>                  
            <tr>
              <td><input type="checkbox" id="<?php echo base_url().'uploads/'; print_r($item->nombre);?>" class="fila" ></td>
              <td><img width="50%" height="50%" src="<?php echo base_url().'uploads/'; print_r($item->nombre);?>"/></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        <div id="screenUrlImagen">
            URL: <input type="text" id="imageURL" > <button type="button" class="btn btn-primary" id="validarImagen">Validar</button><br><br>
            <div id="imagenResult"><center><img width="50%" height="50%" src="" id="setImage"/></center></div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="selectImagen">Seleccionar</button>
      </div>
    </div>
  </div>
</div>
</div>
            
          </div>
            
    </body>
</html>

