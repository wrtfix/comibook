
<script>
    cambios = [];
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaConsultorios").attr("xagregar");
            if (agrego == 'false') {
                $('#tablaConsultorios').append("<tr><td></td><td><input name='nombre' type='input' value=''></td><td><input name='especialidad' type='input' value=''></td><td><input name='direccion' type='input' value=''></td><td><input name='telefono' type='input' value=''></td><td><input name='horario' type='input' value=''><input name='provee' type='input' value=''></td><td><input name='imagen' type='input' value=''></td></tr>");
                $("#tablaConsultorios").attr("xagregar", "true");
                $("#fecha").datepicker({dateFormat: 'dd-mm-yy'});
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaConsultorios").attr("xagregar");

            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                for (i = 0; i < cambios.length; i++) {
                    var nombre = $('#nombre-' + cambios[i]).val();
                    var horario = $('#horario-' + cambios[i]).val();
                    var provee = $('#provee-' + cambios[i]).val();
                    var imagen = $('#imagen-' + cambios[i]).val();
                    var telefono = $('#telefono-' + cambios[i]).val();
                    var especialidad = $('#especialidad-' + cambios[i]).val();
                    var direccion = $('#direccion-' + cambios[i]).val();
                    $.ajax({
                        data: {nombre: nombre, horario: horario, telefono: telefono, especialidad: especialidad, direccion: direccion, imagen:imagen, provee:provee},
                        type: "POST",
                        url: "<?= base_url() ?>index.php/turnera/consultorio/updateConsultorio/" + cambios[i],
                        success: function () {
                            alert('Los cambios se guardaron con exito!');
                            cambios = [];
                        },
                        error: function () {
                            alert('ERROR : Verifique los campos ingresados');
                        }
                    });
                }
            }

        });

        $('#eliminar').click(function () {
            
            var elem = $("input[name='consultorio']:checked").val().split("-")[1];                
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/turnera/consultorio/delConsultorio/" + elem
            });

            $("input[name='consultorio']:checked").parent().parent().remove();
        });

        $('.formulario').blur(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });
        
        $(".fechaInput").datepicker({dateFormat: 'dd-mm-yy'});
        
        $('#permisos').click(function(){
            var idUsuario = $("input[name='consultorio']:checked").val().split("-")[1];
	    
            if (idUsuario != undefined){
                var $aux = $("form:first")
                $aux.attr('action',"<?=base_url()?>index.php/turnera/horario/index/"+idUsuario);
                $aux.submit();
            }else{
                alert("No es posible cargar el contenido de esta noticia sin haberla guardado previamente");
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        
        $("#whatsapp").click(function(){
            var elem = $("input[name='consultorio']:checked").val().split("-")[1];
            var tel = $("#telefono-"+elem).val();
            
            var $aux = $("form:first");
                $aux.append(jQuery('<input>', {
                    'name': 'phone',
                    'value': tel,
                    'type': 'hidden'
                }));
                $aux.attr("target","_blank");
                $aux.attr('action',"http://api.whatsapp.com/send");
                $aux.submit();

        });
        
        $('#agenda').click(function(){
            var idConsultorio = $("input[name='consultorio']:checked").val().split("-")[1];
	    
            if (idConsultorio != undefined){
                var $aux = $("form:first");
                $aux.append(jQuery('<input>', {
                    'name': 'idConsultorio',
                    'value': idConsultorio,
                    'type': 'hidden'
                }));
                $aux.attr('action',"<?=base_url()?>index.php/turnera/agenda/index/");
                $aux.submit();
            }else{
                showInfo("Debe seleccionar una agenda",'warning');
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        $('#productos').click(function(){
	    var idConsultorio = $("input[name='consultorio']:checked").val().split("-")[1];
            if (idConsultorio != undefined){
                var $aux = $("form:first");
                $aux.append(jQuery('<input>', {
                    'name': 'idConsultorio',
                    'value': idConsultorio,
                    'type': 'hidden'
                }));
                $aux.attr('action',"<?=base_url()?>index.php/turnera/agenda/index/");
                $aux.submit();
            }else{
                showInfo("Debe seleccionar una agenda",'warning');
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        
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
<?php echo form_open('turnera/consultorio/addConsultorio'); ?>
<div class="page-header">
    <h2>Locales</h2>
</div>
<div class="row">
    <div class="btn-group">
        <button type="button" id="agregar" class="btn btn-success">Agregar</button>
        <button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>
        <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
        <button type="button" id="permisos" class="btn btn-warning">Configurar Agenda</button>
        <button type="button" id="productos" class="btn btn-circle">Configurar Productos</button>
        <button type="button" id="agenda" class="btn btn-default">Ver Agenda</button>
        <button type="button" id="whatsapp" class="btn btn-success">Validar whatsapp</button>
    </div>
    

    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover tablesorter" id="tablaConsultorios" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Nombre<i class=""></i></th>
                    <th class="header">Especialidad<i class=""></i></th>
                    <th class="header">Direccion<i class=""></i></th>
                    <th class="header">Telefono<i class=""></i></th>
                    <th class="header">Horario de atencion<i class=""></i></th>
                    <th class="header">Provee?</th>
                    <th class="header">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>                  
                    <tr>
                        <td><input type="radio" name="consultorio" value="consultorio-<?php print_r($item->idConsultorio); ?>" class="fila" ></td>
                        <td><input class="formulario" name="nombre" id="nombre-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/></td>
                        <td><input class="formulario" name="especialidad" id="especialidad-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->especialidad); ?>'/></td>
                        <td><input class="formulario" name="direccion" id="direccion-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->direccion); ?>'/></td>
                        <td><input class="formulario" name="telefono" id="telefono-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->telefono); ?>'/> </td>
                        <td><input class="formulario" name="horario" id="horario-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->horario); ?>'/></td>
                        <td><input class="formulario" name="provee" id="provee-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->provee); ?>'/></td>
                        <td><input class="formulario" name="imagen" id="imagen-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->imagen); ?>'/></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

