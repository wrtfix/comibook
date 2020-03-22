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
</script>

<ul>                          
<?php $cont = 0; foreach ($agregados as $item): $cont = $cont + 1; ?>                  
    <li class='single-shopping-cart' id="item-<?php print_r($item->rowid); ?>">
        <div class='shopping-cart-img'>
            <a href='#'><img alt='' src='<?=base_url()?>estilo/ecommerce/assets/img/cart/cart-1.jpg'></a>
        </div>
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
    <a class="btn-style cr-btn" href="#" >Comprar</a>
</div>