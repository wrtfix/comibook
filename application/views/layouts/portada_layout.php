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
		<!-- Header -->
		<header id="header">
			<!-- Top Header -->
			<div id="top-header">
				<div class="container">
					<div class="header-links">
						<ul>
							<li><a href="#">Martes 17 de Abril</a></li>
						</ul>
						
					</div>
					<div class="header-social">
						<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Top Header -->
			
			<!-- Center Header -->
			<div id="center-header">
				<div class="container">
					<div class="header-logo">
						<a href="#" class="logo"><img src="<?=base_url()?>estilo/login/img/logo.png" alt=""></a>
					</div>
					<div class="header-ads">
						<img src="https://www.meteored.com.ar/wimages/foto5e6b69604898650032923b629caac3c7.png">
					</div>
				</div>
			</div>
			<!-- /Center Header -->
			
			<div id="nav-header">
				<div class="container">
					<nav id="main-nav">
						<div class="nav-logo">
							<a href="#" class="logo"><img src="<?=base_url()?>estilo/login/img/logo-alt.png" alt=""></a>
						</div>
						<ul class="main-nav nav navbar-nav">
						<?php $cont=0; foreach($menu as $item): $cont=$cont+1;?>                  
							<li class="active"><a href="#"><?php print_r($item->nombre);?></a></li>
						<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /Nav Header -->
		</header>

		<?php echo $content_for_layout ?> 

		
		

		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /SECTION -->
		
		
		
		<!-- FOOTER -->
		<footer id="footer">
			<!-- Bottom Footer -->
			<div id="bottom-footer" class="section">
				<!-- CONTAINER -->
				<div class="container">
					<!-- ROW -->
					<div class="row">
						<!-- footer links -->
						<div class="col-md-6 col-md-push-6">
							<ul class="footer-links">
							</ul>
						</div>
						<!-- /footer links -->
						
						<!-- footer copyright -->
						<div class="col-md-6 col-md-pull-6">
							<div class="footer-copyright">
								<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
						<!-- /footer copyright -->
					</div>
					<!-- /ROW -->
				</div>
				<!-- /CONTAINER -->
			</div>
			<!-- /Bottom Footer -->
		</footer>
		<!-- /FOOTER -->
</body>
</html>

