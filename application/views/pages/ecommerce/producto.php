<script>
    function agregarProducto(precio, nombre, id){
        var data = {
            product_id: id,
            product_name:nombre,
            product_price:precio,
            quantity: $("#qtybutton").val()
        }
        
        
    }
    $(document).ready(function(){
        $("#qtybutton").focus();
    });
</script>
<div class="qwick-view-left">
    <div class="quick-view-learg-img">
        <div class="quick-view-tab-content tab-content">
            <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                <img src="<?php print_r($detalle[0]->imagen);?>" alt="">
            </div>
<!--            <div class="tab-pane fade" id="modal2" role="tabpanel">
                <img src="assets/img/quick-view/l2.jpg" alt="">
            </div>
            <div class="tab-pane fade" id="modal3" role="tabpanel">
                <img src="assets/img/quick-view/l3.jpg" alt="">
            </div>-->
        </div>
    </div>
<!--    <div class="quick-view-list nav" role="tablist">
        <a class="active" href="#modal1" data-toggle="tab" role="tab">
            <img src="<?php print_r($detalle[0]->imagen);?>" alt="">
        </a>-->
<!--        <a href="#modal2" data-toggle="tab" role="tab">
            <img src="assets/img/quick-view/s2.jpg" alt="">
        </a>
        <a href="#modal3" data-toggle="tab" role="tab">
            <img src="assets/img/quick-view/s3.jpg" alt="">
        </a>-->
    <!--</div>-->
</div>
<div class="qwick-view-right">
    <div class="qwick-view-content">
        <h3><?php print_r($detalle[0]->nombre);?></h3>
        <div class="price">
            <span class="new">$<?php print_r($detalle[0]->precio);?></span>
            <!--<span class="old">$120.00  </span>-->
        </div>
<!--        <div class="rating-number">
            <div class="quick-view-rating">
                <i class="fa fa-star reting-color"></i>
                <i class="fa fa-star reting-color"></i>
                <i class="fa fa-star reting-color"></i>
                <i class="fa fa-star reting-color"></i>
                <i class="fa fa-star reting-color"></i>
            </div>
        </div>-->
        <p><?php print_r($detalle[0]->descripcion);?></p>
<!--        <div class="quick-view-select">
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
        </div>-->
        <div class="select-option-part">
            <label>Cantidad: </label>
            <input  type="number" value="0" min="0" id="qtybutton">
        </div>
        <a class="btn-style" href="#" onclick="agregarProducto('<?php print_r($detalle[0]->precio);?>', '<?php print_r($detalle[0]->nombre);?>', '<?php print_r($detalle[0]->idProducto);?>' )">Agregar</a>
        
       
    </div>
</div>
