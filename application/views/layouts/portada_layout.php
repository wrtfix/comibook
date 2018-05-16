<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="jorge carlos mendiola" >

	<!-- You can use Open Graph tags to customize link previews.
	Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
	<meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Your Website Title" />
	<meta property="og:description"   content="Your description" />
	<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>estilo/admin/css/table-responsive.css" rel="stylesheet">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CLato:300,400" rel="stylesheet"> 
	
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>estilo/home/css/bootstrap.min.css"/>

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>estilo/home/css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>estilo/home/css/owl.theme.default.css" />
	
	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?=base_url()?>estilo/home/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>estilo/home/css/style.css"/>
	

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
	
	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

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
							<li><? print_r($fechaActual); ?></li>
						</ul>
						
					</div>
					<div class="header-social">
						<ul>
							<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/intent/tweet?text=Salta Chequeado" data-size="large"><i class="fa fa-twitter"></i></a></li>
							<li><a href="http://instagram.com/wrtfix?ref=badge"><i class="fa fa-instagram"></i></a></li>
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
                                                    <li><a href="<?=base_url()?>">Portada</a></li>
						<?php foreach($menu as $item): ?>                  
							<li><a href="<?=base_url()?>index.php/portada/index/<?php print_r($item->idGasto);?>"><?php print_r($item->nombre);?></a></li>
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
								<span>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></span>
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

				<!-- jQuery Plugins -->
		<script src="<?=base_url()?>estilo/login/js/jquery.min.js"></script>
		<script src="<?=base_url()?>estilo/login/js/bootstrap.min.js"></script>
		<script src="<?=base_url()?>estilo/login/js/owl.carousel.min.js"></script>
		<script src="<?=base_url()?>estilo/login/js/main.js"></script>

</body>
</html>

