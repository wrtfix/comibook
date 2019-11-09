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
                    $('#tablaConfiguracion').prepend("<tr><td></td><td><input name='atributo' type='input' value=''></td><td><input name='valor' id='valor' class='tab' type='input' value=''></td><td><input class='tab' id='descripcion' name='descripcion' type='input' value=''></td></tr>");
                }
                $("#tablaConfiguracion").attr("xagregar", "true");
            }
        });
        $('#guardar').click(function () {
            block_screen();
            var agrego = $("#tablaConfiguracion").attr("xagregar");
            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                var sendData = [];
                for (i = 0; i < cambios.length; i++) {
                    var atributo = $('#atributo-' + cambios[i]).val();
                    var valor = $('#valor-' + cambios[i]).val();
                    var descripcion = $('#descripcion-' + cambios[i]).val();
                    sendData.push({id:cambios[i], atributo: atributo, valor: valor, descripcion: descripcion});
                }
                for (i = 0; i < cambiosMobile.length; i++) {
                    var atributo = $('#atributoMobile-' + cambiosMobile[i]).val();
                    var valor = $('#valorMobile-' + cambiosMobile[i]).val();
                    var descripcion = $('#descripcionMobile-' + cambiosMobile[i]).val();
                    sendData.push({id:cambiosMobile[i], atributo: atributo, valor: valor, descripcion: descripcion});
                }
                $.ajax({
                    data: {updateData: sendData},
                    type: "POST",
                    url: "<?= base_url() ?>index.php/backoffice/configuracion/updateConfiguracion/",
                    success: function () {
                        showInfo('Los cambios se guardaron con exito!', 'info');
                        cambios = [];
                    },
                    error: function () {
                        alert('ERROR : Verifique los campos ingresados');
                    },
                    complete: function (jqXHR, textStatus) {
                        unblock_screen();
                    }
                });
            }


        });
        
        var elem = function eliminar(){
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
        
        tasks.push(elem);
        
        $("#eliminar").click(function(){
            $("#msjConfirmacionModal").html("Esta seguro que desea eliminar?");
            taskNumber = 1;
        });
        
        $('#sendEmail').click(function () {
            block_screen();
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/backoffice/configuracion/testSendEmail/",
                success: function () {
                    unblock_screen();
                    showInfo('El email se envio correctamente', 'info');
                },
                error: function () {
                    unblock_screen();
                    showInfo('Verifique los campos ingresados', 'error');
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
    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
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
                    <th class="header">Valor<i class=""></i></th>
                    <th class="header">Descripcion<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->id); ?>" class="fila tab"></td>
                        <td><input class="formulario" id="atributo-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->atributo); ?>'/></td>
                        <!--<td><input class="formulario tab" id="valor-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->valor); ?>'/></td>-->
                        <td><textarea class="formulario tab" id="valor-<?php print_r($item->id); ?>" style='width: 100%; border:none;'><?php print_r($item->valor); ?></textarea></td>
                        <td><input class="formulario tab" id="descripcion-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->descripcion); ?>'/></td>
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
                        <input class="form-control formularioMobile tab" id="descripcionMobile-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->descripcion); ?>'/>
                        <p class="help-block"></p>
                    </div>
                </div>
            </div>
<?php endforeach; ?>
    </div>
</div>


</form>