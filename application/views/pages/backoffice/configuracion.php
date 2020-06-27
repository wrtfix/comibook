<script>
    var cambios = [];
    var cambiosMobile = [];
    
    $(document).ready(function () {
        
        $('#agregar').click(function () {
            var agrego = $("#tablaConfiguracion").attr("xagregar");
            if (agrego == 'false') {
                if (mobileAndTabletcheck()){
                    loadContent("#panelConfiguracion", "index.php/backoffice/configuracion/loadCard");
                }else{
                    loadContent("#panelLineaConfiguracion", "index.php/backoffice/configuracion/loadTable");
                }
                $("#tablaConfiguracion").attr("xagregar", "true");
            }
        });
        
        var guardar = function guardar(){
            block_screen();
            var agrego = $("#tablaConfiguracion").attr("xagregar");
            if (agrego == 'true') {
                $("#tablaConfiguracion").attr("xagregar","false");
                $("form:first").submit();
            } else {
                var sendData = [];
                for (i = 0; i < cambios.length; i++) {
                    var atributo = $('#atributo-' + cambios[i]).val();
                    var valor = $('#valor-' + cambios[i]).val();
                    var propietario  = $('#propietario-' + cambios[i]).val();
                    var descripcion = $('#descripcion-' + cambios[i]).val();
                    sendData.push({id:cambios[i], atributo: atributo, valor: valor, descripcion: descripcion, propietario:propietario});
                }
                for (i = 0; i < cambiosMobile.length; i++) {
                    var atributo = $('#atributoMobile-' + cambiosMobile[i]).val();
                    var valor = $('#valorMobile-' + cambiosMobile[i]).val();
                    var propietario  = $('#propietarioMobile-' + cambios[i]).val();
                    var descripcion = $('#descripcionMobile-' + cambiosMobile[i]).val();
                    sendData.push({id:cambiosMobile[i], atributo: atributo, valor: valor, descripcion: descripcion, propietario:propietario});
                }
                $.ajax({
                    data: {updateData: sendData},
                    type: "POST",
                    url: "<?= base_url() ?>index.php/backoffice/configuracion/updateConfiguracion/",
                    success: function () {
                        showInfo('Los cambios se guardaron con exito!', 'info');
                        cambios = [];
                        cambiosMobile = [];
                    },
                    error: function () {
                        showInfo('Verifique los campos ingresados!', 'warning');
                    },
                    complete: function (jqXHR, textStatus) {
                        unblock_screen();
                    }
                });
            }
        }
        
        tasks.push(guardar);
        
        $('#guardar').click(function () {
            $("#msjConfirmacionModal").html("Esta seguro que desea guardar los cambios?");
            taskNumber = 1;
        });
        
        var eliminar = function eliminar(){
            $('input:checked').each(function () {
                var elem = $(this).attr('id');
                var id = $("#identificador").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/backoffice/configuracion/delConfiguracion/" + elem
                });
            });
            if (mobileAndTabletcheck()){
                $(":checked").parent().parent().parent().remove();
            }else{
                $(":checked").parent().parent().remove();
            }
            showInfo('Los elementos fueron eliminados correctamente', 'info');
        }
        
        tasks.push(eliminar);
        
        $("#eliminar").click(function(){
            $("#msjConfirmacionModal").html("Esta seguro que desea eliminar?");
            taskNumber = 2;
        });
        
        $('#sendEmail').click(function () {
            block_screen();
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/backoffice/configuracion/testSendEmail/",
                success: function (response) {
                    unblock_screen();
                    showInfo('El email se envio correctamente', 'info');
                },
                error: function () {
                    unblock_screen();
                    showInfo('Verifique los campos ingresados', 'danger');
                },

            });
        });

        $('.formulario').keydown(function (event) {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });
        
        $('.formularioMobile').keydown(function (event) {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambiosMobile) == -1) {
                cambiosMobile.push(($(this).attr('id').split('-')[1]));
            }
        });
        
        <?php if(!empty($result)) { ?> 
            showInfo('Los nuevos atributos se guardaron con exito!', 'info');
        <?php } ?>

    });


</script>

<?php echo form_open('backoffice/configuracion/addConfiguracion'); ?>
<div class="page-header">
    <h3>Configuracion</h3>
</div>
<div class="btn-group">
    <button type="button" id="agregar" class="btn btn-success">Agregar</button>
    <button type="button" data-target='#confirmationModal' data-toggle='modal' id="eliminar" class="btn btn-danger">Eliminar</button>
    <button type="button" data-target='#confirmationModal' data-toggle='modal' id="guardar" class="btn btn-primary">Guardar</button>
    <button type="button" id="sendEmail" class="btn btn-default">Test email</button>
</div>
<div class="row">

    <br>
    <br>

    <div class="table-responsive desktop">
        <table class="table table-bordered table-hover tablesorter" id="tablaConfiguracion" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Clave<i class=""></i></th>
                    <th class="header">Propietario<i class=""></i></th>
                    <th class="header">Valor<i class=""></i></th>
                    <th class="header">Descripcion<i class=""></i></th>
                </tr>
            </thead>
            <tbody id="panelLineaConfiguracion">
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->id); ?>" class="fila tab"></td>
                        <td><input class="formulario" id="atributo-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->atributo); ?>'/></td>
                        <td><input class="formulario" id="propietario-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->propietario); ?>'/></td>
                        <td><textarea class="formulario tab" id="valor-<?php print_r($item->id); ?>" style='width: 100%; border:none;'><?php print_r($item->valor); ?></textarea></td>
                        <td><textarea class="formulario tab" id="descripcion-<?php print_r($item->id); ?>" style='width: 100%; border:none;'><?php print_r($item->descripcion); ?></textarea></td>
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
                        <input  type="checkbox" id="<?php print_r($item->id); ?>" />
                        <label>Eliminar</label>
                        <!--<input class="form-control" id="atributo-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->atributo); ?>'/>-->
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Clave</label>
                        <input class="form-control formularioMobile" id="atributoMobile-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->atributo); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <textarea class="form-control formularioMobile tab" id="valorMobile-<?php print_r($item->id); ?>" style='width: 100%; border:none;'><?php print_r($item->valor); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control formularioMobile tab" id="descripcionMobile-<?php print_r($item->id); ?>" style='width: 100%; border:none;' ><?php print_r($item->descripcion); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Propietario</label>
                        <input class="form-control formularioMobile tab" id="propietarioMobile-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->propietario); ?>'/>
                        <p class="help-block"></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</form>