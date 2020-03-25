<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $this->layout->placeholder("descripcion"); ?>">
    <meta name="author" content="jorge carlos mendiola" >
    

      <!-- css -->    
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/chosen.min.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/icofont.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/bundle.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>estilo/ecommerce/assets/css/responsive.css">
    <script src="<?=base_url()?>estilo/ecommerce/assets/js/vendor/modernizr-2.8.3.min.js"></script>

    
</head>
<body>
    <div class="wrapper">
            <!-- header start -->
            <header>
                <div class="header-area transparent-bar ptb-55">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-4 col-4">
                                <div class="logo-small-device">
                                    <a href="<?= base_url() ?>"><?php if(!empty($imageLogo)){ ?><img alt="<?= $this->layout->placeholder("title"); ?>" src="<?php print_r($imageLogo); ?>"><?php } ?> <h1><?php print_r($this->layout->placeholder("title")); ?></h1></a>
                                    <p><?= $this->layout->placeholder("descripcion"); ?></p>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-8 col-8">
                                <div class="header-contact-menu-wrapper pl-45">
                                    <div class="header-contact">
                                        <p></p>
                                    </div>
                                </div>
                                <?php if($type=="productos"){ ?>
                                <div class="header-cart cart-small-device">
                                    <button class="icon-cart" onclick="obtenerListado()">
                                        <i class="ti-shopping-cart"></i>
                                        <span class="count-style">0</span>
                                        <span class="count-price-add">$0.001</span>
                                    </button>
                                    <div class="shopping-cart-content">
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="header-cart-wrapper">
                        <?php if($type=="productos"){ ?>
                        <div class="header-cart">
                            <button class="icon-cart" onclick="obtenerListado()">
                                <i class="ti-shopping-cart"></i>
                                <span class="count-style">0</span>
                                <span class="count-price-add">$0.00</span>
                            </button>
                            <div class="shopping-cart-content">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </header>
            <div class="breadcrumb-area pb-170" style="background-image: url(<?php print_r($headerImage)?>)">
                <div class="container-fluid">
                    <div class="breadcrumb-content text-center">
                        <ul>
                            <li>
                                <a href="#">home</a>
                            </li>
                            <li>Shop page</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="shop-wrapper fluid-padding-2 pt-120 pb-150">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="product-sidebar-area pr-60">
                                <?php if($showSearchs=='true') { ?>
                                <div class="sidebar-widget pb-55">
                                    <h3 class="sidebar-widget">Busqueda</h3>
                                    <div class="sidebar-search">
                                        <form action="#">
                                            <input type="text" >
                                            <button><i class="ti-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="sidebar-widget pb-50">
                                    <h3 class="sidebar-widget">Categorias</h3>
                                    <div class="widget-categories">
                                        <ul>
                                            <li><a href="<?=base_url()?>index.php/turnera/busqueda/index/servicios">Locales</a></li>
<!--                                            <li><a href="<?=base_url()?>index.php/turnera/busqueda/index/productos">Productos</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                        <?php echo $content_for_layout ?> 
                    </div>
                </div>
            </div>
            
            <footer>
                <div class="footer-top pt-210 pb-98 theme-bg">
                    <div class="container">
                       <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-logo">
                                        <a href="index.html">
                                            <?php print_r($this->layout->placeholder("title")); ?>
                                        </a>
                                    </div>
                                    <div class="footer-about">
                                        <p><span>One more code</span> Sistema de gestion de emprendedores para emprendedores. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30 pl-60">
                                    <div class="footer-widget-title">
                                        <h3>Accesos rapidos</h3>
                                    </div>
                                    <div class="quick-links">
                                        <ul>
                                            <li><a href="about-us.html">Acerca de nosotros</a></li>
                                            <li><a href="<?=base_url() ?>/index.php/login/">Ingresar</a></li>
                                            <li><a href="<?=base_url() ?>/index.php/registrarse/index">Registrarse</a></li>
                                            <li><a href="shop.html">Noticias</a></li>
                                            <li><a href="<?=base_url() ?>/index.php/portada/detalle/7">Contactanos</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>Contactate</h3>
                                    </div>
                                    <div class="food-info-wrapper">
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Direccion</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>Maria Graciela Toncovich 657, Tandil, Buenos Aires, Argentina</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Telefono</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>+54 249 460 92 70</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Web</span>
                                            </div>
                                            <div class="food-info-content">
                                                <a href="#">admin@onemorecode.com</a>
                                                <a href="#">www.onemorecode.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom ptb-35 black-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="copyright">
                                    <p>©Copyright, 2018 All Rights Reserved by <a href="https://freethemescloud.com/">Free themes Cloud</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="icofont icofont-close" aria-hidden="true"></span>
                </button>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body" id="modalCompras">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- all js here -->
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/popper.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/isotope.pkgd.min.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/jquery.counterup.min.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/waypoints.min.js"></script>
        
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/owl.carousel.min.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/plugins.js"></script>
        <script src="<?=base_url()?>estilo/ecommerce/assets/js/main.js"></script>
        <script>
            
            
            $(document).ready(function(){
                updateTotal();
            });
            
            function updateTotal(){
                $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>index.php/ecommerce/producto/detalleCart",
                        dataType: 'json',
                        success: function (response) {
                            $(".count-price-add").text("$ "+response.total);
                            $(".count-style").text(response.list.length);
                        }
                });
            }
            function obtenerListado(){
                $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>index.php/ecommerce/producto/detalleCartView",
                        data: {tel: '<?php print_r($telefono); ?>'}
                        success: function (response) {
                            console.log(response);
                            $(".shopping-cart-content").html(response);
                        }
                });
                
            }
        </script>
    
</body>
</html>

