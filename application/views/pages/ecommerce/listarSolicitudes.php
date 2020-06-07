
<script>
    var cambios = [];
    var cambiosMobile = [];
    
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaConsultorios").attr("xagregar");
            if (agrego == 'false') {
                if (mobileAndTabletcheck()){
                    loadContent("#panelConfiguracion", "index.php/turnera/consultorio/loadCard");
                }else{
                    $('#tablaConsultorios').append("<tr><td></td><td></td><td><input name='nombre' type='input' value=''></td><td><input name='email' type='input' value=''></td><td><input name='telefono' type='input' value=''></td><td><input name='domicilio' type='input' value=''></td><td><input name='formaPago' type='input' value=''> <input name='idLocal' type='hidden' value='<?php print_r($idLocal); ?>'> </td> </tr>");                    
                }
                $("#tablaConsultorios").attr("xagregar", "true");
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaConsultorios").attr("xagregar");

            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                //TODO REVISAR
		/*var dataPost = [];
                for (var i = 0; i < cambios.length; i++) {
                    var id = cambios[i];
                    var nombre = $('#nombre-' + cambios[i]).val();
                    var horario = $('#horario-' + cambios[i]).val();
                    var provee = $('#provee-' + cambios[i]).val();
                    var imagen = $('#imagen-' + cambios[i]).val();
                    var telefono = $('#telefono-' + cambios[i]).val();
                    var especialidad = $('#especialidad-' + cambios[i]).val();
                    var direccion = $('#direccion-' + cambios[i]).val();
                    dataPost.push({id:id,nombre:nombre,horario:horario,provee:provee,imagen:imagen,telefono:telefono,especialidad:especialidad, direccion:direccion});
		}
                for (var i = 0; i < cambiosMobile.length; i++) {
                    var id = cambios[i];
                    var nombre = $('#nombreMobile-' + cambiosMobile[i]).val();
                    var horario = $('#horarioMobile-' + cambiosMobile[i]).val();
                    var provee = $('#proveeMobile-' + cambiosMobile[i]).val();
                    var imagen = $('#imagenMobile-' + cambiosMobile[i]).val();
                    var telefono = $('#telefonoMobile-' + cambiosMobile[i]).val();
                    var especialidad = $('#especialidadMobile-' + cambiosMobile[i]).val();
                    var direccion = $('#direccionMobilete ao-' + cambiosMobile[i]).val();
                    dataPost.push({id:id, nombre:nombre,horario:horario,provee:provee,imagen:imagen,telefono:telefono,especialidad:especialidad, direccion:direccion});
		}
                
 		$.ajax({
                        data: {dataPost:dataPost},
                        type: "POST",
                        url: "<?= base_url() ?>index.php/turnera/consultorio/updateConsultorio" ,
                        success: function () {
                            showInfo("Los cambios se guardaron con exito!",'info');
                            cambios = [];
                            cambiosMobile = [];
                        },
                        error: function () {
                            showInfo("Verifique los campos ingresados",'error');
                            
                        }
                    });*/
                    showInfo("Actualmente esta funcionalidad no soporta modificaciones, estamos trabajando para usted",'danger');
                }
                
        });


        $('.formulario').blur(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });
        
        $('.formularioMobile').keydown(function (event) {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambiosMobile) == -1) {
                cambiosMobile.push(($(this).attr('id').split('-')[1]));
            }
        });
        
        $(".fechaInput").datepicker({dateFormat: 'dd-mm-yy'});
        
        
    });

    $(function () {
        $("#fechaDesde").datepicker({dateFormat: 'dd-mm-yy'});
        $("#fechaHasta").datepicker({dateFormat: 'dd-mm-yy'});
    });
    

</script>
<?php if (validation_errors()) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<?php echo form_open('solicitudes/addSolicitud'); ?>
<div class="page-header">
    <h2>Solicitudes</h2>
</div>
<div class="row">
    <div class="btn-group">
        <button type="button" id="agregar" class="btn btn-success">Agregar</button>
        <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
    </div>
    

    <br>
    <br>
    <div class="table-responsive desktop">
        <table class="table table-bordered table-hover tablesorter" id="tablaConsultorios" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Fecha<i class=""></i></th>
                    <th class="header">Usuario<i class=""></i></th>
                    <th class="header">Email<i class=""></i></th>
                    <th class="header">Telefono<i class=""></i></th>
                    <th class="header">Domicilio<i class=""></i></th>
                    <th class="header">Forma de pago<i class=""></i></th>
                    <th class="header">Acciones<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($solicitudes as $item): $cont = $cont + 1; ?>                  
                    <tr>
                        <td><input type="radio" name="solicitudes" value="solicitudes-<?php print_r($item->idSolicitud); ?>" class="fila" ></td>
                        <td><input class="formulario" name="fecha" id="nombre-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->fecha); ?>'/></td>
                        <td><input class="formulario" name="usuario" id="especialidad-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/></td>
                        <td><input class="formulario" name="email" id="direccion-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->email); ?>'/></td>
                        <td><input class="formulario" name="telefono" id="telefono-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->telefono); ?>'/> </td>
                        <td><input class="formulario" name="domicilio" id="domicilio-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->domicilio); ?>'/> </td>
                        <td><input class="formulario" name="formaPago" id="formaPago-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->formaPago); ?>'/> </td>
                        <td><button type="button" id="productos" class="btn btn-circle">Productos</button> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
</div>


