    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->layout->placeholder("title"); ?></title>

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
        
    </head>
    <body style=".article .article-meta li:{color: <?php print_r($menuColor[0]->proviene); ?>!important}">
        <!-- Header -->
        <header id="header">
            <!-- Top Header -->
            <div id="top-header">
                <div class="container">
                    <div class="header-links">
                        <ul>
                            <li><?php print_r($fechaActual); ?></li>
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
                        <a href="<?= base_url() ?>" class="logo"><img src="<?php print_r($logo[0]->proviene);?>" alt=""></a>
                    </div>
                    <div class="header-ads">
                        <img src="https://www.meteored.com.ar/wimages/foto5e6b69604898650032923b629caac3c7.png">
                    </div>
                </div>
            </div>
            <!-- /Center Header -->

            <div id="nav-header" style="background:<?php print_r($menuColor[0]->proviene); ?>">
                <div class="container">
                    <nav id="main-nav" style="background:<?php print_r($menuColor[0]->proviene); ?>">
                        <div class="nav-logo">
                            <a href="#" class="logo"><img src="<?php print_r($logo[0]->proviene);?>" alt=""></a>
                        </div>
                        <ul class="main-nav nav navbar-nav">
                            <li><a href="<?= base_url() ?>">Portada</a></li>
                            <?php foreach ($menu as $item): ?>                  
                                <li><a href="<?= base_url() ?>index.php/portada/index/<?php print_r($item->idGasto); ?>"><?php print_r($item->nombre); ?></a></li>
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
            </div>

        </header>
        <br>
        <div class="visible-lg visible-md">
        <img class="center-block" src="<?php print_r($topBanner[0]->proviene);?>" alt="">
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
            <img class="center-block" src="<?php print_r($downBanner[0]->proviene);?>" alt="">
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
        
</body>
