<div class="col-lg-9">
<div class="shop-topbar-wrapper">
    <div class="grid-list-options">
        <ul class="view-mode">
            <li><a href="#product-grid" data-view="product-grid"><i class="ti-layout-grid2"></i></a></li>
            <li class="active"><a href="#product-list" data-view="product-list"><i class="ti-view-list"></i></a></li>
        </ul>
    </div>

</div>
<div class="grid-list-product-wrapper tab-content">
    <div id="new-product" class="product-list product-view tab-pane active">
        <div class="row">
            <?php $cont = 0; foreach ($agregados as $item): $cont = $cont + 1; ?>
            <div class="product-width col-md-6 col-xl-4 col-lg-6">
                <div class="product-wrapper mb-35">
                    <div class="product-img">
                        <a href="product-details.html">
                            <?php if(empty($item->imagen)){ ?>
                            <img src="<?=base_url()?>estilo/ecommerce/assets/img/product/product-1.jpg" alt="">
                            <?php } else { ?>
                            <img src="<?php print_r($item->imagen);?>" alt="">
                            <?php } ?>
                        </a>
<!--                        <div class="product-item-dec">
                            <ul>
                                <li><?php print_r($item->telefono);?></li>
                                <li><?php print_r($item->horario); ?></li>
                            </ul>
                        </div>-->
                        <div class="product-action">
                            <a class="action-plus-2 p-action-none" title="Add To Cart" href="#">
                                <i class=" ti-shopping-cart"></i>
                            </a>
<!--                            <a class="action-cart-2" title="Wishlist" href="#">
                                <i class=" ti-heart"></i>
                            </a>-->
<!--                            <a class="action-reload" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class=" ti-zoom-in"></i>
                            </a>-->
                        </div>
                        <div class="product-content-wrapper">
                            <div class="product-title-spreed">
                                <h4><a href="product-details.html">Gloriori GSX 250 R</a></h4>
                                <span>6600 RPM</span>
                            </div>
                            <div class="product-price">
                                <span>$2549</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-list-details">
                        <h2><a href="product-details.html"><?php print_r($item->nombre); ?> <?php if(!empty($item->especialidad)){ ?> - <?php print_r($item->especialidad)?> <?php } ?></a></h2>
                        <div class="quick-view-rating">
                            <i class="fa fa-star reting-color"></i>
                            <i class="fa fa-star reting-color"></i>
                            <i class="fa fa-star reting-color"></i>
                            <i class="fa fa-star reting-color"></i>
                            <i class="fa fa-star reting-color"></i>
                        </div>
                        <?php if(!empty($item->precio)){ ?>
                        <div class="product-price">
                            <span>$ <?php print_r($item->precio); ?></span>
                        </div>
                        <?php } if(!empty($item->horario)){ ?>
                        <div class="product-price">
                            <span>Horario: <?php print_r($item->horario); ?></span>
                        </div>
                        <?php } if(!empty($item->horario)){ ?>
                        <div class="product-price">
                            <span>Telefono: <?php print_r($item->telefono);?> </span>
                        </div>
                        <?php } if(!empty($item->comments)){ ?>
                        <div class="product-price">
                            <span>Comentarios: </span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipic it, sed do eiusmod tempor incididunt ut labore et dolore mag aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo it. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <?php } if(!empty($item->description)){ ?>
                        <div class="product-price">
                            <span>Descripcion: </span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipic it, sed do eiusmod tempor incididunt ut labore et dolore mag aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo it. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <?php } if($type == 'servicios'){ ?>
                        <p></p>
                        <div class="shop-list-cart">
                            <a href="cart.html"><i class="ti-calendar"></i> Reservar</a>
                        </div>
                        <?php } else { ?>
                        <p></p>
                        <div class="shop-list-cart">
                            <a class="action-reload" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
<!--                            <a  href="cart.html">-->
                                <i class="ti-shopping-cart"></i> Comprar
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<!--                            <div class="paginations text-center mt-20">
    <ul>
        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li class="active"><a href="#"><i class="fa fa-angle-right"></i></a></li>
    </ul>
</div>-->
</div>




<!--<div class="contenedor">
    <?php $cont = 0; foreach ($agregados as $item): $cont = $cont + 1; ?>
        <div class="gridItem">
            <div class="gridContent">
                <img src="https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-1.png"/>
                <ul>
                    <li>
                        Nombre: 
                    </li>
                    <li>
                        <?php if ($item->direccion !=null ) { ?>
                        Ubicacion: <?php print_r($item->direccion); ?>
                        <?php } ?>
                    </li>
                    <li>
                        Telefono: <?php print_r($item->telefono); ?>
                    </li>
                    <li>
                        Ranking: 
                    </li>
                    <li>
                        Horario: <?php print_r($item->horario); ?>
                    </li>
                </ul>

            </div>
        </div>
    
<?php endforeach; ?>
        <tr>
            <td><input class="formulario" name="nombre" id="nombre-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/></td>
            <td><input class="formulario" name="especialidad" id="especialidad-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->especialidad); ?>'/></td>
            <td><input class="formulario" name="direccion" id="direccion-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->direccion); ?>'/></td>
            <td><input class="formulario" name="telefono" id="telefono-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->telefono); ?>'/></td>
            <td><input class="formulario" name="horario" id="horario-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->horario); ?>'/></td>
        </tr>
</div>-->
