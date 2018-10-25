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
                            while (!empty($noticiasPrincipales)  &&  $cont < 4 ) { ?>                  
                                <div class="col-md-3 col-sm-6">
                                    <!-- ARTICLE -->
                                    <article class="article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <?php if ($noticiasPrincipales[$cont]->Observaciones!=''){ ?>
                                                    <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                                <?php }?>
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha), 'd-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>
                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->
                                </div>
                                <?php $cont++; } ?>
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
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>
                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
                                        </div>
                                    </article>
<?php } ?>
                                <!-- /ARTICLE -->

                                <!-- ARTICLE -->
<?php $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
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
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->
<?php } $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <!-- ARTICLE -->
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
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
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
                                        </div>
                                    </article>
                                    <!-- /ARTICLE -->

                                    <!-- ARTICLE -->
<?php } $cont++; if (!empty($noticiasPrincipales) &&  $cont < count($noticiasPrincipales)) { ?>
                                    <article class="article widget-article">
                                        <div class="article-img">
                                            <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>">
                                                <img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasPrincipales[$cont]->Numero); ?>"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen); ?></a></h4>
                                            <ul class="article-meta">
                                                <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasPrincipales[$cont]->Fecha),'d-m-Y')); ?> </li>
                                                <li><i class="fa fa-fire"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos); ?></li>
                                                <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado); ?></li>
                                                <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete); ?></li>

                                            </ul>
                                            <p><?php print_r($noticiasPrincipales[$cont]->ClienteDestino); ?></p>
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
        <?php if ($totalRecords > 8) {echo $links; }?>
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

                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[0]->Numero); ?>">
                                        <img src="<?php print_r($resumenNoticias[0]->Observaciones); ?>" alt="">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[0]->Numero); ?>"><?php print_r($resumenNoticias[0]->ClienteOrignen); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[0]->Fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[0]->Bultos); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[0]->valorDeclarado); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[0]->CostoFlete); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[0]->ClienteDestino); ?></p>
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
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[1]->Numero); ?>">
                                        <img src="<?php print_r($resumenNoticias[1]->Observaciones); ?>" alt="">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[1]->Numero); ?>"><?php print_r($resumenNoticias[1]->ClienteOrignen); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[1]->Fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[1]->Bultos); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[1]->valorDeclarado); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[1]->CostoFlete); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[1]->ClienteDestino); ?></p>
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
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[2]->Numero); ?>">
                                        <img src="<?php print_r($resumenNoticias[2]->Observaciones); ?>" alt="">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[2]->Numero); ?>"><?php print_r($resumenNoticias[2]->ClienteOrignen); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[2]->Fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[2]->Bultos); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[2]->valorDeclarado); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[2]->CostoFlete); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[2]->ClienteDestino); ?></p>
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
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[3]->Numero); ?>">
                                        <img src="<?php print_r($resumenNoticias[3]->Observaciones); ?>" alt="">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[3]->Numero); ?>"><?php print_r($resumenNoticias[3]->ClienteOrignen); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[3]->Fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[3]->Bultos); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[3]->valorDeclarado); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[3]->CostoFlete); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[3]->ClienteDestino); ?></p>
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
                                    <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[4]->Numero); ?>">
                                        <img src="<?php print_r($resumenNoticias[4]->Observaciones); ?>" alt="">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <h3 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($resumenNoticias[4]->Numero); ?>"><?php print_r($resumenNoticias[4]->ClienteOrignen); ?></a></h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i><?php print_r(date_format(date_create($resumenNoticias[4]->Fecha),'d-m-Y')); ?></li>
                                        <li><i class="fa fa-fire"></i> <?php print_r($resumenNoticias[4]->Bultos); ?></li>
                                        <li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[4]->valorDeclarado); ?></li>
                                        <li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[4]->CostoFlete); ?></li>

                                    </ul>
                                    <p><?php print_r($resumenNoticias[4]->ClienteDestino); ?></p>
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
                                <a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasMasLeidas[$cont]->Numero); ?>">
                                    <img src="<?php print_r($noticiasMasLeidas[$cont]->Observaciones); ?>" alt="">
                                </a>
                            </div>
                            <div class="article-body">
                                <h4 class="article-title"><a href="<?= base_url() ?>index.php/portada/detalle/<?php print_r($noticiasMasLeidas[$cont]->Numero); ?>"><?php print_r($noticiasMasLeidas[$cont]->ClienteOrignen); ?></a></h4>
                                <ul class="article-meta">
                                    <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasMasLeidas[$cont]->Fecha),'d-m-Y')); ?> </li>
                                    <li><i class="fa fa-fire"></i> <?php print_r($noticiasMasLeidas[$cont]->Bultos); ?></li>
                                    <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasMasLeidas[$cont]->valorDeclarado); ?></li>
                                    <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasMasLeidas[$cont]->CostoFlete); ?></li>

                                </ul>
                            </div>
                        </article>
    <?php $cont++;
} ?>
                    <!-- /ARTICLE -->
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

