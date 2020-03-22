<script>
    function agregarProducto(precio, nombre, id){
        var data = {
            product_id: id,
            product_name:nombre,
            product_price:precio,
            quantity: $("#qtybutton").val()
        }
        
        $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/ecommerce/producto/agregarProducto",
                dataType: 'json',
                data: data,
                success: function (response) {
                    updateTotal();
                    $(".close").trigger('click')
                }
        });
        
    }
    $(document).ready(function(){
        $("#qtybutton").focus();
    });
</script>
<div class="qwick-view-left">
    <div class="quick-view-learg-img">
        <div class="quick-view-tab-content tab-content">
            <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                <?php if($detalle[0]->imagen != null){?>
                    <img src="<?php print_r($detalle[0]->imagen);?>" alt=""/>
                <?php }else { ?>
                    <img src="<?=base_url()?>estilo/ecommerce/assets/img/product/product-1.jpg" alt=""/>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<div class="qwick-view-right">
    <div class="qwick-view-content">
        <h3><?php print_r($detalle[0]->nombre);?></h3>
        <div class="price">
            <span class="new">$<?php print_r($detalle[0]->precio);?></span>

        </div>

        <p><?php print_r($detalle[0]->descripcion);?></p>

        <div class="select-option-part">
            <label>Cantidad: </label>
            <input  type="number" value="0" min="0" id="qtybutton">
        </div>
        <a class="btn-style" href="#" onclick="agregarProducto('<?php print_r($detalle[0]->precio);?>', '<?php print_r($detalle[0]->nombre);?>', '<?php print_r($detalle[0]->idProducto);?>' )">Agregar</a>
        
       
    </div>
</div>
