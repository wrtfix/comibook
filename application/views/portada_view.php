<!-- SECTION -->
<div class="section">
    
    <!-- CONTAINER -->
    <div class="container">


        <!-- ROW -->
        <div class="row">
            <!-- Main Column -->
            <div class="col-md-12">
                <!-- section title -->
                <div class="section-title" >
                    <h2 class="title" style="background:<?php print_r($menuColor[0]->valor); ?>">Noticias recientes</h2>
                    <!-- tab nav -->
                    <ul class="tab-nav pull-right">
                    </ul>
                    <!-- /tab nav -->
                </div>
                <!-- /section title -->

                <!-- Tab content -->
                <div class="tab-content">
                    <!-- tab1 -->
                    <div id="tab1" class="tab-pane fade in active">
                        <!-- row -->
                        <div class="row">
                            <?php $cont = 0; 
                            while (!empty($noticiasPrincipales)  &&  $cont < 4 ) { if ($noticiasPrincipales[$cont]->idNoticia != ''){ ?>                  
                                <div class="col-md-3 col-sm-6">
                                    <!-- ARTICLE -->
                                    <article class="article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <?php if ($noticiasPrincipales[$cont]->urlImage!=''){ ?>
                                                    <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                                <?php }?>
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha), 'd-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>
                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->
                                </div>
                                <?php } $cont++; } ?>
                        </div>
                        <!-- /row -->

                        <!-- row -->

                        <div class="row">
                            <!-- Column 1 -->
                            <div class="col-md-4 col-sm-6">
                                <!-- ARTICLE -->
<?php  if (!empty($noticiasPrincipales) && $cont < count($noticiasPrincipales)) { ?>
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>
                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
<?php } ?>
                                <!-- /ARTICLE -->

                                <!-- ARTICLE -->
<?php $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
<?php } ?>
                                <!-- /ARTICLE -->
                            </div>
                            <!-- /Column 1 -->

                            <!-- Column 2 -->
                            <div class="col-md-4 col-sm-6">
                                <!-- ARTICLE -->
<?php $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->
<?php } $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <!-- ARTICLE -->
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->
                                </div>
                                <!-- /Column 2 -->

                                <!-- /Column 3 -->
<?php }$cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                <div class="col-md-4 hidden-sm">
                                    <!-- ARTICLE -->
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->

                                    <!-- ARTICLE -->
<?php } $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->urlImage); ?>" alt="<?php print_r($noticiasPrincipales[$cont]->titulo); ?>">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->idNoticia); ?>"><?php print_r($noticiasPrincipales[$cont]->titulo); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->visitas); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->likes); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->unLikes); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->resumen); ?></p>
                                        </div>
                                    </article>
<?php } ?>
                                <!-- /ARTICLE -->
                            </div>
                            <!-- /Column 3 -->
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /tab1 -->
                </div>
                <!-- /tab content -->
            </div>
            <!-- /Main Column -->
        <?php if (!empty($noticiasPrincipales) && $totalRecords > 8) {echo $links; }?>
        </div>
        <!-- /ROW -->
    

    </div>
    <!-- /CONTAINER -->
</div>

<!-- /SECTION -->
<!-- SECTION -->
<div class="section">
    <!-- CONTAINER -->
    <div class="container">
        <!-- ROW -->
        <div class="row">
            <!-- Main Column -->
            <div class="col-md-8">

                <!-- row -->
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="title"  style="background:<?php print_r($menuColor[0]->valor); ?>">Mas Populares</h2>
                        </div>
                    </div>
                    <!-- /section title -->
                    <div class="col-md-6 col-sm-6">
                        <!-- ARTICLE -->
<?php if (0 < count($resumenNoticias)) { ?>
                            <article class="article">
                                <div class="article-img">

                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[0]->idNoticia); ?>">
                                        <img src="<?php print_r($resumenNoticias[0]->urlImage); ?>" alt="<?php print_r($resumenNoticias[0]->titulo); ?>">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[0]->idNoticia); ?>"><?php print_r($resumenNoticias[0]->titulo); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[0]->fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[0]->visitas); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[0]->likes); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[0]->unLikes); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[0]->resumen); ?></p>
                                </div>
                            </article>
<?php } if (1 < count($resumenNoticias)) { ?>
                            <!-- /ARTICLE -->
                        </div>
                        <!-- /Column 2 -->
                        <div class="col-md-6 col-sm-6">
                            <!-- ARTICLE -->
                            <article class="article">
                                <div class="article-img">
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[1]->idNoticia); ?>">
                                        <img src="<?php print_r($resumenNoticias[1]->urlImage); ?>" alt="<?php print_r($resumenNoticias[1]->titulo); ?>">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[1]->idNoticia); ?>"><?php print_r($resumenNoticias[1]->titulo); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[1]->fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[1]->visitas); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[1]->likes); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[1]->unLikes); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[1]->resumen); ?></p>
                                </div>
                            </article>
                            <!-- /ARTICLE -->
                        </div>
                        <!-- /Column 2 -->
                    </div>
                    <!-- /row -->

                    <!-- row -->
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-4 col-sm-4">
                            <!-- ARTICLE -->
<?php } if (2 < count($resumenNoticias)) { ?>
                            <article class="article">
                                <div class="article-img">
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[2]->idNoticia); ?>">
                                        <img src="<?php print_r($resumenNoticias[2]->urlImage); ?>" alt="<?php print_r($resumenNoticias[2]->titulo); ?>">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[2]->idNoticia); ?>"><?php print_r($resumenNoticias[2]->titulo); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[2]->fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[2]->visitas); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[2]->likes); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[2]->unLikes); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[2]->resumen); ?></p>
                                </div>
                            </article>
                            <!-- /ARTICLE -->
                        </div>
                        <!-- /Column 1 -->

                        <!-- Column 2 -->
<?php } if (3 < count($resumenNoticias)) { ?>
                        <div class="col-md-4 col-sm-4">
                            <!-- ARTICLE -->
                            <article class="article">
                                <div class="article-img">
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[3]->idNoticia); ?>">
                                        <img src="<?php print_r($resumenNoticias[3]->urlImage); ?>" alt="<?php print_r($resumenNoticias[3]->titulo); ?>">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[3]->idNoticia); ?>"><?php print_r($resumenNoticias[3]->titulo); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[3]->fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[3]->visitas); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[3]->likes); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[3]->unLikes); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[3]->resumen); ?></p>
                                </div>
                            </article>
                            <!-- /ARTICLE -->
                        </div>
                        <!-- /Column 2 -->

                        <!-- Column 3 -->
<?php } if (4 < count($resumenNoticias)) { ?>
                        <div class="col-md-4 col-sm-4">
                            <!-- ARTICLE -->
                            <article class="article">
                                <div class="article-img">
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[4]->idNoticia); ?>">
                                        <img src="<?php print_r($resumenNoticias[4]->urlImage); ?>" alt="<?php print_r($resumenNoticias[4]->titulo); ?>">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[4]->idNoticia); ?>"><?php print_r($resumenNoticias[4]->titulo); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[4]->fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[4]->visitas); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[4]->likes); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[4]->unLikes); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[4]->resumen); ?></p>
                                </div>
                            </article>
<?php } ?>
                        <!-- /ARTICLE -->
                    </div>
                    <!-- /Column 3 -->
                </div>

                <!-- /row -->
            </div>
            <!-- /Main Column -->

            <!-- Aside Column -->
            <div class="col-md-4">


                <!-- social widget -->
                <div class="widget social-widget">
                    <div class="widget-title">
                        <h2 class="title">Seguinos en:</h2>
                    </div>
                    <ul>
                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $ogurl; ?>" class="facebook"><i class="fa fa-facebook"></i><br><span>Facebook</span></a></li>
                        <li><a target="_blank" href="https://twitter.com/<?php print_r($twitterUser[0]->valor);?>" class="twitter"><i class="fa fa-twitter"></i><br><span>Twitter</span></a></li>
                        <li><a href="https://www.instagram.com/<?php print_r($instagramUser[0]->valor);?>" class="instagram"><i class="fa fa-instagram"></i><br><span>Instagram</span></a></li>
                    </ul>
                </div>
                <!-- /social widget -->

                <!-- article widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h2 class="title">Mas Leidos</h2>
                    </div>


                    <!-- /owl carousel 3 -->

                    <!-- ARTICLE -->
                    

<?php $cont = 0;
while ($cont < count($noticiasMasLeidas) && $cont < 4) { ?>          
                        <article class="article widget-article">
                            <div class="article-img">
                                <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasMasLeidas[$cont]->idNoticia); ?>">
                                    <img src="<?php print_r($noticiasMasLeidas[$cont]->urlImage); ?>" alt="<?php print_r($noticiasMasLeidas[$cont]->titulo); ?>">
                                </a>
                            </div>
                            <div class="article-body">
                                <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasMasLeidas[$cont]->idNoticia); ?>"><?php print_r($noticiasMasLeidas[$cont]->titulo); ?></a></h4>
                                <ul class="article-meta">
                                    <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasMasLeidas[$cont]->fecha),'d-m-Y')); ?> </li>
                                    <li><i class="fa fa-fire"></i> <?php print_r($noticiasMasLeidas[$cont]->visitas); ?></li>
                                    <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasMasLeidas[$cont]->likes); ?></li>
                                    <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasMasLeidas[$cont]->unLikes); ?></li>

                                </ul>
                            </div>
                        </article>
    <?php $cont++;
} ?>
                    <!-- /ARTICLE -->
                    <center>
                    <?php print_r($twitterNews[0]->valor);?>
                    <br/>
                    <?php print_r($dolarToday[0]->valor);?>    
                    
                    </center>
                </div>
<?php if (count($comentarios)>0) { ?>                        
                                <div class="widget">
                            
                    <div class="widget-title">
                        <h2 class="title">Comentarios</h2>
                    </div>


                    <!-- /owl carousel 3 -->

                    <!-- ARTICLE -->

<?php foreach ($comentarios as $comentario): ?>                         
                    <article class="article widget-article">
                            <div class="article-body">
                                <h4 class="article-title"><?php print_r($comentario->Nombre); ?></a></h4>
                                <p><?php print_r($comentario->Comentario); ?></p>
                                
                            </div>
                        </article>
<?php endforeach; ?>
                    <!-- /ARTICLE -->
                </div>
<?php } ?>
                <!-- /article widget -->
            </div>
            <!-- /Aside Column -->
        </div>
        <!-- /ROW -->
    </div>
    <!-- /CONTAINER -->
</div>
<!-- /SECTION -->

