<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="jorge carlos mendiola" >
    
      <!-- css -->
    <!--<link href="<?=base_url()?>estilo/ecommerce/estilo/custom/style.css" rel="stylesheet" type="text/css">-->
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
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="logo-small-device">
                                    <h2> <a href="<?= base_url() ?>" class="logo"> <?= $this->layout->placeholder("title"); ?> </a> </h2>   
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
                                    <button class="icon-cart">
                                        <i class="ti-shopping-cart"></i>
                                        <span class="count-style">0</span>
                                        <span class="count-price-add">$0.00</span>
                                    </button>
                                    <div class="shopping-cart-content">
<!--                                        <ul>
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-1.jpg"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h3><a href="#">Gloriori GSX 250 R </a></h3>
                                                    <span>Price: $275</span>
                                                    <span>Qty: 01</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                                                </div>
                                            </li>
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-2.jpg"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h3><a href="#">Demonissi Gori</a></h3>
                                                    <span>Price: $275</span>
                                                    <span class="qty">Qty: 01</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                                                </div>
                                            </li>
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-3.jpg"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h3><a href="#">Demonissi Gori</a></h3>
                                                    <span>Price: $275</span>
                                                    <span class="qty">Qty: 01</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                                                </div>
                                            </li>
                                        </ul>-->
                                        <div class="shopping-cart-total">
                                            <h4>total: <span>$0.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn">
                                            <a class="btn-style cr-btn" href="#">checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="header-cart-wrapper">
                        <?php if($type=="productos"){ ?>
                        <div class="header-cart">
                            <button class="icon-cart">
                                <i class="ti-shopping-cart"></i>
                                <span class="count-style">0</span>
                                <span class="count-price-add">$0.00</span>
                            </button>
                            <div class="shopping-cart-content">
<!--                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-1.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h3><a href="#">Gloriori GSX 250 R </a></h3>
                                            <span>Price: $275</span>
                                            <span>Qty: 01</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-2.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h3><a href="#">Demonissi Gori</a></h3>
                                            <span>Price: $275</span>
                                            <span class="qty">Qty: 01</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-3.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h3><a href="#">Demonissi Gori</a></h3>
                                            <span>Price: $275</span>
                                            <span class="qty">Qty: 01</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                                        </div>
                                    </li>
                                </ul>-->
                                <div class="shopping-cart-total">
                                    <h4>total: <span>$0.00</span></h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a class="btn-style cr-btn" href="#">checkout</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </header>
            <div class="breadcrumb-area pt-255 pb-170" style="background-image: url(<?=base_url()?>estilo/ecommerce/assets/img/banner/banner-4.jpg)">
                <div class="container-fluid">
                    <div class="breadcrumb-content text-center">
                        <h2>&nbsp;</h2>
<!--                        <ul>
                            <li>
                                <a href="#">home</a>
                            </li>
                            <li>Shop page</li>
                        </ul>-->
                    </div>
                </div>
            </div>
            <div class="shop-wrapper fluid-padding-2 pt-120 pb-150">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="product-sidebar-area pr-60">
                                <div class="sidebar-widget pb-55">
                                    <h3 class="sidebar-widget">Busqueda</h3>
                                    <div class="sidebar-search">
                                        <form action="#">
                                            <input type="text" >
                                            <button><i class="ti-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="sidebar-widget pb-50">
                                    <h3 class="sidebar-widget">Categorias</h3>
                                    <div class="widget-categories">
                                        <ul>
                                            <li><a href="<?=base_url()?>index.php/turnera/busqueda/index/servicios">Servicios</a></li>
                                            <li><a href="<?=base_url()?>index.php/turnera/busqueda/index/productos">Productos</a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                
                                
<!--                                <div class="sidebar-widget">
                                    <h3 class="sidebar-widget">Busquedas mas populares</h3>
                                    <div class="best-seller">
                                        <div class="single-best-seller">
                                            <div class="best-seller-img">
                                                <a href="#"><img src="<?=base_url()?>estilo/ecommerce/assets/img/product/product-12.jpg" alt=""></a>
                                            </div>
                                            <div class="best-seller-text">
                                                <h3><a href="#">Minimal White Shoes</a></h3>
                                                <span>$39.9</span>
                                            </div>
                                        </div>
                                        <div class="single-best-seller">
                                            <div class="best-seller-img">
                                                <a href="#"><img src="<?=base_url()?>estilo/ecommerce/assets/img/product/product-13.jpg" alt=""></a>
                                            </div>
                                            <div class="best-seller-text">
                                                <h3><a href="#">Minimal White Shoes</a></h3>
                                                <span>$39.9</span>
                                            </div>
                                        </div>
                                        <div class="single-best-seller">
                                            <div class="best-seller-img">
                                                <a href="#"><img src="<?=base_url()?>estilo/ecommerce/assets/img/product/product-14.jpg" alt=""></a>
                                            </div>
                                            <div class="best-seller-text">
                                                <h3><a href="#">Minimal White Shoes</a></h3>
                                                <span>$39.9</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <?php echo $content_for_layout ?> 
                    </div>
                </div>
            </div>
            
            <footer>
<!--                <div class="footer-top pt-210 pb-98 theme-bg">
                    <div class="container">
                       <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-logo">
                                        <a href="index.html">
                                            <img src="<?=base_url()?>estilo/ecommerce/assets/img/logo/2.png" alt="">
                                        </a>
                                    </div>
                                    <div class="footer-about">
                                        <p><span>OSWAN</span> the most latgest bike store in the wold can serve you latest ulity of motorcycle soucan sell here your motorcycle it quo </p>
                                        <div class="footer-support">
                                            <h5>FOR SUPPORT</h5>
                                            <span> 01245 658 698 (Toll Free)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30 pl-60">
                                    <div class="footer-widget-title">
                                        <h3>QUICK LINK</h3>
                                    </div>
                                    <div class="quick-links">
                                        <ul>
                                            <li><a href="about-us.html">About us</a></li>
                                            <li><a href="#">Service</a></li>
                                            <li><a href="#">Inventory</a></li>
                                            <li><a href="shop.html">Shop</a></li>
                                            <li><a href="blog-sidebar.html">Blog</a></li>
                                            <li><a href="#">Conditions</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>LATEST TWEET</h3>
                                    </div>
                                    <div class="food-widget-content pr-30">
                                        <div class="single-tweet">
                                            <p><a href="#">@Smith,</a> the most latgest bike store in the wold can serve you 
10 min ago</p>
                                        </div>
                                        <div class="single-tweet">
                                            <p><a href="#">@Smith,</a> the most latgest bike store in the wold can serve you 
10 min ago</p>
                                        </div>
                                        <div class="single-tweet">
                                            <p><a href="#">@Smith,</a> the most latgest bike store in the wold can serve you 
10 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>CONTACT INFO</h3>
                                    </div>
                                    <div class="food-info-wrapper">
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Address</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>276 Jhilli Nogor, 4th folor, Momen Tower, Main Town, New Yourk</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Phone</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>+090 12568 369 987</p>
                                                <p>+090 12568 369 987</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Web</span>
                                            </div>
                                            <div class="food-info-content">
                                                <a href="#">info@oswanmega.com</a>
                                                <a href="#">www.oswanmega.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
<!--                <div class="footer-bottom ptb-35 black-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="copyright">
                                    <p>©Copyright, 2018 All Rights Reserved by <a href="https://freethemescloud.com/">Free themes Cloud</a></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="footer-payment-method">
                                    <a href="#"><img alt="" src="<?=base_url()?>estilo/ecommerce/assets/img/icon-img/payment.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </footer>
            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="icofont icofont-close" aria-hidden="true"></span>
                </button>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="qwick-view-left">
                                <div class="quick-view-learg-img">
                                    <div class="quick-view-tab-content tab-content">
                                        <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                            <img src="<?=base_url()?>estilo/ecommerce/assets/img/quick-view/l1.jpg" alt="">
                                        </div>
                                        <div class="tab-pane fade" id="modal2" role="tabpanel">
                                            <img src="<?=base_url()?>estilo/ecommerce/assets/img/quick-view/l2.jpg" alt="">
                                        </div>
                                        <div class="tab-pane fade" id="modal3" role="tabpanel">
                                            <img src="<?=base_url()?>estilo/ecommerce/assets/img/quick-view/l3.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="quick-view-list nav" role="tablist">
                                    <a class="active" href="#modal1" data-toggle="tab" role="tab">
                                        <img src="<?=base_url()?>estilo/ecommerce/assets/img/quick-view/s1.jpg" alt="">
                                    </a>
                                    <a href="#modal2" data-toggle="tab" role="tab">
                                        <img src="<?=base_url()?>estilo/ecommerce/assets/img/quick-view/s2.jpg" alt="">
                                    </a>
                                    <a href="#modal3" data-toggle="tab" role="tab">
                                        <img src="<?=base_url()?>estilo/ecommerce/assets/img/quick-view/s3.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="qwick-view-right">
                                <div class="qwick-view-content">
                                    <h3>Aeri Carbon Helmet</h3>
                                    <div class="price">
                                        <span class="new">$90.00</span>
                                        <span class="old">$120.00  </span>
                                    </div>
                                    <div class="rating-number">
                                        <div class="quick-view-rating">
                                            <i class="fa fa-star reting-color"></i>
                                            <i class="fa fa-star reting-color"></i>
                                            <i class="fa fa-star reting-color"></i>
                                            <i class="fa fa-star reting-color"></i>
                                            <i class="fa fa-star reting-color"></i>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do tempor incididun ut labore et dolore magna aliqua. Ut enim ad mi , quis nostrud veniam exercitation .</p>
                                    <div class="quick-view-select">
                                        <div class="select-option-part">
                                            <label>Size*</label>
                                            <select class="select">
                                                <option value="">- Please Select -</option>
                                                <option value="">900</option>
                                                <option value="">700</option>
                                            </select>
                                        </div>
                                        <div class="select-option-part">
                                            <label>Color*</label>
                                            <select class="select">
                                                <option value="">- Please Select -</option>
                                                <option value="">orange</option>
                                                <option value="">pink</option>
                                                <option value="">yellow</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="quickview-plus-minus">
                                        <div class="cart-plus-minus">
											<input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
										</div>
                                        <div class="quickview-btn-cart">
                                            <a class="btn-style" href="#">add to cart</a>
                                        </div>
                                        <div class="quickview-btn-wishlist">
                                            <a class="btn-hover" href="#"><i class="icofont icofont-heart-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    
</body>
</html>

