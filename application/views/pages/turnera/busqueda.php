<script>
    function obtenerDetalle(id){
        $.ajax({
            data: {idProducto: id},
            type: "POST",
            url: "<?= base_url() ?>index.php/ecommerce/producto",
            success: function (response) {
                $("#modalCompras").html(response)
            }
        });
    }
</script>


<div class="col-lg-9">
    
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
                        <div class="product-action">
                            <?php if($type == 'servicios'){ ?>
                            <a class="action-plus-2 p-action-none" title="Reservar" href="<?=base_url()?>index.php/turnera/reserva/index/<?php print_r($item->idConsultorio); ?>">
                                <i class=" ti-calendar"></i>
                            </a>
                            <?php } else { ?>
                            <a class="action-plus-2 p-action-none" title="Comprar" href="#">
                                <i class=" ti-shopping-cart"></i>
                            </a>
                            <?php }?>
                        </div>
                        <div class="product-content-wrapper">
                            <div class="product-title-spreed">
                                <h4><a href="product/<?php print_r($item->idConsultorio); ?>"><?php print_r($item->nombre); ?></a></h4>
                            </div>
                            <div class="product-price">
                                <span><?php if(!empty($item->especialidad)){ print_r($item->especialidad); } if(!empty($item->precio)) { echo '$'; print_r($item->precio); } ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="product-list-details">
                        <h2><a href="product/<?php print_r($item->idConsultorio); ?>"><?php print_r($item->nombre); ?> <?php if(!empty($item->especialidad)){ ?> - <?php print_r($item->especialidad)?> <?php } ?></a></h2>
                        <div class="quick-view-rating">
                        </div>
                        <?php if(!empty($item->precio)){ ?>
                        <div class="product-price">
                            <span>$ <?php print_r($item->precio); ?></span>
                        </div>
                        <?php } if(!empty($item->peso)){ ?>
                        <div class="product-price">
                            <span>Peso: <?php print_r($item->peso); ?> </span>
                        </div>
                        <?php } if(!empty($item->horario)){ ?>
                        <div class="product-price">
                            <span>Horario: <?php print_r($item->horario); ?></span>
                        </div>
                        <?php } if(!empty($item->horario)){ ?>
                        <div class="product-price">
                            <span>Telefono: <?php print_r($item->telefono);?> </span>
                        </div>
                        <?php } if(!empty($item->direccion)){ ?>
                        <div class="product-price">
                            <span>Direccion: <?php print_r($item->direccion);?> </span>
                        </div>
                        <?php } if(!empty($item->comments)){ ?>
                        <div class="product-price">
                            <span>Comentarios: </span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipic it, sed do eiusmod tempor incididunt ut labore et dolore mag aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo it. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <?php } if(!empty($item->descripcion)){ ?>
                        <p><?php print_r($item->descripcion); ?></p>
                        <?php } if($type == 'servicios' &&  !$item->provee = 'producto'){ ?>
                        <p></p>
                        <div class="shop-list-cart">
                            <a href="<?=base_url()?>index.php/turnera/reserva/index/<?php print_r($item->idConsultorio); ?>"><i class="ti-calendar"></i> Reservar</a>
                        </div>
                        <?php } else if ($type == 'servicios' && $item->provee = 'producto'){ ?>
                        <p></p>
                        <div class="shop-list-cart">
                            <a href="<?=base_url()?>index.php/turnera/busqueda/index/producto/<?php print_r($item->idConsultorio); ?>"><i class="ti-shopping-cart"></i> Productos </a>
                        </div>
                        <?php } else { ?>
                        <p></p>
                        <div class="shop-list-cart">
                            <a class="action-reload" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#" onclick="obtenerDetalle(<?php print_r($item->idProducto); ?>)">
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
<?php if($pageShow=='true'){ ?>
    <div class="paginations text-center mt-20">
    <ul>
        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li class="active"><a href="#"><i class="fa fa-angle-right"></i></a></li>
    </ul>
</div>
<?php } ?>
</div>

