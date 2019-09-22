<html lang='es'>
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->layout->placeholder("title"); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $ogdescription; ?>">
        <meta name="author" content="jorge carlos mendiola" >

        <meta property="og:url"           content="<?= $ogurl; ?>" />
        <meta property="og:type"          content="<?= $ogtype; ?>" />
        <meta property="og:title"         content="<?= $ogtitle; ?>" />
        <meta property="og:description"   content="<?= $ogdescription; ?>" />
        <meta property="og:image"         content="<?= $ogimage; ?>" />
        <meta property="fb:app_id"        content="<?= $fbapp_id; ?>" />
        
        
        
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CLato:300,400" rel="stylesheet"> 

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>estilo/home/css/bootstrap.min.css"/>

        <!-- Owl Carousel -->
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>estilo/home/css/owl.carousel.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>estilo/home/css/owl.theme.default.css" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="<?= base_url() ?>estilo/home/css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>estilo/home/css/style.css"/>
        
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url() ?>estilo/home/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= base_url() ?>estilo/home/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>estilo/home/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>estilo/home/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>estilo/home/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() ?>estilo/home/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() ?>estilo/home/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() ?>estilo/home/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>estilo/home/img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url() ?>estilo/home/img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>estilo/home/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>estilo/home/img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>estilo/home/img/favicon-16x16.png">
	<link rel="manifest" href="<?= base_url() ?>estilo/home/img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?= base_url() ?>estilo/home/img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
        
        <!-- jQuery Plugins -->
        <script src="<?= base_url() ?>estilo/login/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>estilo/login/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>estilo/login/js/owl.carousel.min.js"></script>
        <script src="<?= base_url() ?>estilo/login/js/jquery.marquee.min.js"></script>
       
        <!-- Anuncios de google -->
        <?php print_r($googleAdsense[0]->valor); ?>
        
        <style>
        .marquee {
            width: 100%;
            overflow: hidden;
            background-color: white;
          }
          <?= $styleCustom[0]->valor?>
        </style>
        <script>
         <?php print_r($headerContent[0]->valor); ?>
        </script>
    </head>
    <body style=".article .article-meta li:{color: <?php print_r($menuColor[0]->valor); ?>!important}">

        <!-- Header -->
        <header id="header">
            <!-- Top Header -->
            <div class="container">
                    <div class="row ">
                        <!-- Column 1 -->
                        <div class="col-xs-8 col-sm-4 justify-content-center">
                            <?php print_r($fechaActual); ?>  <?php if ($login[0]->valor == 'true' ) { ?> 
                                | <a href="<?=base_url()?>index.php/login/"> Demo </a> 
                            <?php } if ($registrarse[0]->valor == 'true' ) { ?> 
                                | <a href="<?=base_url()?>index.php/registrarse/"> Registrarse </a> 
                            <?php } ?>
                        </div>

                        <div style="text-align: right;margin-right: 13px;">
                            <a target="_blank" href=" https://wa.me/<?php print_r($whatsappNumber[0]->valor);?>" class="instagram"><i class="fa fa-whatsapp"></i></a>
                            <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= $ogurl; ?>" class="fb-xfbml-parse-ignore" ><i class="fa fa-facebook"></i></a>
                            <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= $ogtitle; ?> <?= $ogurl; ?>" data-size="large"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="http://instagram.com/<?php print_r($instagramUser[0]->valor);?>?ref=badge" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a target="_blank" href="<?php print_r($githubURL[0]->valor);?>" class="instagram"><i class="fa fa-github"></i></a>
                        </div>    
                    </div>
            </div>
            
            <!-- /Top Header -->

            <!-- Center Header -->
            <div id="center-header">
                <div class="container">
                    <div class="header-logo">
                        <h2> <a href="<?= base_url() ?>" class="logo"><img src="<?php print_r($logo[0]->valor);?>" alt="<?= $this->layout->placeholder("title"); ?>"> <?= $this->layout->placeholder("title"); ?> </a> 
                        </h2> 
                    </div>
                    <div class="header-ads">
                       <?php print_r($showWeather[0]->valor);?>
                    </div>
                </div>
            </div>
            <!-- /Center Header -->

            <div id="nav-header" style="background:<?php print_r($menuColor[0]->valor); ?>">
                <div class="container">
                    <nav id="main-nav" style="background:<?php print_r($menuColor[0]->valor); ?>">
                        <div class="nav-logo">
                            <a href="<?= base_url() ?>" class="logo"><img style="width: 80%" src="<?php if(!empty($logoUpside[0]->valor)) print_r($logoUpside[0]->valor); else print_r($logo[0]->valor);?>" alt="logo"></a>
                        </div>
                        <ul class="main-nav nav navbar-nav">
                            <li><a href="<?= base_url() ?>">Portada</a></li>
                            <?php foreach ($menu as $item): ?>                  
                                <li><a href="<?= base_url() ?>index.php/portada/index/<?php print_r($item->idMenu); ?>"><?php print_r($item->nombre); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                    <div class="button-nav">
<!--                            <button class="search-collapse-btn"><i class="fa fa-search"></i></button>-->
                            <button class="nav-collapse-btn"><i class="fa fa-bars"></i></button>
                            <!--<div class="search-form">
                                    <form>
                                            <input class="input" type="text" name="search" placeholder="Buscar">
                                    </form>
                            </div>-->
                    </div>
                    
                </div>
                <?php if($marquetNews[0]->valor == 'true') { ?>
                <div style="display:none;"class="marquee"><?php foreach ($banner as $item): ?> <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($item->idNoticia); ?>"> <?php print_r($item->titulo); echo "&nbsp";?> | <?php endforeach;?> </a></div>
                <?php } ?>
                
            </div>
        </header>
        
        <?php if (!empty($imageCarrusel) && $imageCarrusel[0]->valor=='true'){ ?>
                <div id="owl-carousel-1" class="owl-carousel owl-theme center-owl-nav">
                    <!-- ARTICLE -->
                    <?php foreach ($banner as $item): ?>
                    <article class="article thumb-article">
                            <div class="article-img" >
                                <img src="<?php print_r($item->urlImage); ?>" alt="<?php print_r($item->titulo); ?>" style="width:100%; height: 30%">
                            </div>
                            <div class="article-body">
                                    <h2 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($item->idNoticia); ?>"><?php print_r($item->titulo); ?></a></h2>
                                    <ul class="article-meta">
                                            <li><i class="fa fa-clock-o"></i> <?php print_r($item->fecha); ?> </li>
                                            <li><i class="fa fa-fire"></i> <?php print_r($item->visitas); ?></li>
                                    </ul>
                            </div>
                    </article>
                    <?php endforeach; ?>
                    <!-- /ARTICLE -->

		</div>
        <?php } ?>
        <div class="container">
            <!-- ROW -->
            <?php if (!empty($topBanner[0]->valor)) { ?>
            <div class="row">
                <!-- Main Column -->
                <div class="col-md-12">
                    
                    <article class="article article-post">
                    <div class="article-main-img">
                        <img class="center-block" style="height: 25%;" src="<?php print_r($topBanner[0]->valor);?>" alt="bannerSuperior">
                    </article>
                    
                </div>
                        <?php } ?>
            </div>
            
        </div>
        
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

         <!-- AD SECTION -->
        <div class="visible-lg visible-md">
            <img class="center-block" src="<?php print_r($downBanner[0]->valor);?>" alt="bannerInferior">
        </div>
         <br>
        <!-- /AD SECTION -->

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
        
       
        
        <div id="back-to-top"></div>
        <script src="<?= base_url() ?>estilo/login/js/main.js"></script>
         <script>
         $(document).ready(function(){
             $('.marquee').show();
             $('.marquee').marquee({
		    //speed in milliseconds of the marquee
		    duration: 30000,
		    //gap in pixels between the tickers
		    gap: 250,
		    //time in milliseconds before the marquee will start animating
		    delayBeforeStart: 2000,
		    //'left' or 'right'
		    direction: 'left',
		    //true or false - should the marquee be duplicated to show an effect of continues flow
		    duplicated: true
		});
         });
        </script>
        
        
        
</body>

        </html>
