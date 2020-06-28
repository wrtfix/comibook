<script>
    function borrarItem(id){
        $("#item-"+id).remove();
         $.ajax({
            data: {row_id: id},
            type: "POST",
            url: "<?= base_url() ?>index.php/ecommerce/producto/borrarItem",
            success: function (response) {
                $("#item-"+id).remove();
                updateTotal();
            }
        });
    }
    
    function finalizarCompra(){
        
    }
</script>

<ul>                          
<?php $cont = 0; foreach ($agregados as $item): $cont = $cont + 1; ?>                  
    <li class='single-shopping-cart' id="item-<?php print_r($item->rowid); ?>">
        <div class='shopping-cart-title'>
            <h3><a href='#'><?php print_r($item->name); ?> </a></h3>
            <span>Precio:  <?php print_r($item->price); ?></span>
            <span>Cantidad: <?php print_r($item->qty); ?></span>
        </div>
        <div class='shopping-cart-delete'>
            <a href='#' onclick="borrarItem('<?php print_r($item->rowid); ?>');"><i class='icofont icofont-ui-delete'></i></a>
        </div>
    </li>
<?php endforeach; ?>
</ul>

<div class="shopping-cart-total">
    <h4>total: <span class="count-price-add"><?php print_r($total) ?> </span></h4>
</div>
<div class="shopping-cart-btn">
    <form id="contact-form" action="<?=base_url()?>ecommerce/producto/realizarCompra" method="post">
        <input type="hidden" value="<?php print_r($idLocal)?>" name="idLocal"/>
        <input type="hidden" value="<?php print_r($telefono)?>" name="tel"/>
        <input type="submit" class="btn-style cr-btn" value="Comprar">
    </form>
<!--    <a class="" href="#" onclick="finalizarCompra()" >Comprar</a>-->
</div>

