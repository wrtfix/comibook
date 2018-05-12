<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="jorge carlos mendiola" >

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>estilo/admin/css/table-responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>estilo/admin/css/bootstrap.css" rel="stylesheet">
    <!-- Add custom CSS here -->

    <link href="<?=base_url()?>estilo/login/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>estilo/admin/font-awesome/css/font-awesome.min.css">

    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <script src="<?=base_url()?>estilo/admin/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>estilo/admin/js/bootstrap.js"></script>
    
 	<link href="<?=base_url()?>estilo/admin/css/custom.css" rel="stylesheet">
	<link href="<?=base_url()?>estilo/admin/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="<?=base_url()?>estilo/admin/js/jquery-1.10.2.js"></script>
	<script src="<?=base_url()?>estilo/admin/js/jquery-ui-1.10.4.custom.js"></script>
	
	<!-- Tabla dinamica -->
	<script data-jsfiddle="common" src="<?=base_url()?>estilo/admin/js/handsontable/jquery.handsontable.full.js"></script>
  	<link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?=base_url()?>estilo/admin/js/handsontable/jquery.handsontable.full.css">
	<!-- Fin de Tabla dinamica -->
	<script type="text/javascript">


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
<br>
      <div id="page-wrapper">
            <?php echo $content_for_layout ?> 
      </div>
</body>
</html>

