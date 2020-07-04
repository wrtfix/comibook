<script>
    var cambios = [];
    var cambiosMobile = [];
    
    $(document).ready(function () {
        
        var procesar = function procesar(){
            $("form:first").submit();
        }
        
        tasks.push(procesar);
        
        $("#procesar").click(function(){
            $("#msjConfirmacionModal").html("Esta seguro que desea finalizar la solicitud?");
            taskNumber = 1;
        });
        
    });


</script>

<?php echo form_open('carrito/updateSolicitud'); ?>
<input type="hidden" name="idSolicitud" value="<?php print_r($idSolicitud)?>"/>
<div class="page-header">
    <h3>Productos solicitados</h3>
</div>
<div class="btn-group">
    <button type="button" data-target='#confirmationModal' data-toggle='modal' id="procesar" class="btn btn-danger">Finalizar</button>
</div>
<div class="row">

    <br>
    <br>

    <div class="table-responsive desktop">
        <table class="table table-bordered table-hover tablesorter" id="tablaConfiguracion" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Producto<i class=""></i></th>
                    <th class="header">Cantidad<i class=""></i></th>
                </tr>
            </thead>
            <tbody id="panelLineaConfiguracion">
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input class="formulario" id="atributo-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/></td>
                        <td><input class="formulario" id="propietario-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->cantidad); ?>'/></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-4 mobile" id="panelConfiguracion">
        <?php $cont = 0; foreach ($agregados as $item): $cont = $cont + 1; ?>
            <div  class="panel panel-green">
                <div class="col-lg-6 panel-body">
                    <div class="form-group">
                        <label>Producto</label>
                        <input class="form-control formularioMobile" id="atributoMobile-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <textarea class="form-control formularioMobile tab" id="valorMobile-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;'><?php print_r($item->cantidad); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</form>