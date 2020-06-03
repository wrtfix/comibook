
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
                    $('#tablaConsultorios').append("<tr><td></td><td></td><td><input name='nombre' type='input' value=''></td><td><input name='email' type='input' value=''></td><td><input name='telefono' type='input' value=''></td></tr>");                    
                }
                $("#tablaConsultorios").attr("xagregar", "true");
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaConsultorios").attr("xagregar");

            if (agrego == 'true') {
                $("form:first").submit();
            } else {
		var dataPost = [];
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
                    });
                }
            

        });

        $('#eliminar').click(function () {
            
            var elem = $("input[name='consultorio']:checked").val().split("-")[1];                
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/turnera/consultorio/delConsultorio/" + elem
            });

            if (mobileAndTabletcheck()){
               $("input[name='consultorio']:checked").parent().parent().parent().remove();
            }else{
                $("input[name='consultorio']:checked").parent().parent().remove();
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
        
        $('#permisos').click(function(){
            var idUsuario = $("input[name='consultorio']:checked").val();
	    
            if (idUsuario != undefined){
                idUsuario = idUsuario.split("-")[1]
                var $aux = $("form:first")
                $aux.attr('action',"<?=base_url()?>index.php/turnera/horario/index/"+idUsuario);
                $aux.submit();
            }else{
                showInfo("Debe seleccionar un local para poder configurar su agenda",'warning');
                
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        
        $("#whatsapp").click(function(){
            
            var elem = $("input[name='consultorio']:checked").val();
            if (elem != undefined){
                elem = elem.split("-")[1];
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
            
            }else{
                showInfo("Debe seleccionar un local para validar el numero en whatsapp",'warning');
            }
            
           

        });
        
        $('#agenda').click(function(){
            var idConsultorio = $("input[name='consultorio']:checked").val();
	    
            if (idConsultorio != undefined){
                idConsultorio = idConsultorio.split("-")[1];
                var $aux = $("form:first");
                $aux.append(jQuery('<input>', {
                    'name': 'idConsultorio',
                    'value': idConsultorio,
                    'type': 'hidden'
                }));
                $aux.attr('action',"<?=base_url()?>index.php/turnera/agenda/index/");
                $aux.submit();
            }else{
                showInfo("Debe seleccionar un local",'warning');
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        $('#productos').click(function(){
	    var idLocal = $("input[name='solicitudes']:checked").val();
            if (idLocal != undefined){
                idLocal = idLocal.split("-")[1];
                var $aux = $("form:first");
                $aux.append(jQuery('<input>', {
                    'name': 'idLocal',
                    'value': idLocal,
                    'type': 'hidden'
                }));
                $aux.attr('action',"<?=base_url()?>index.php/producto/index");
                $aux.submit();
            }else{
                showInfo("Debe seleccionar un local",'warning');
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        
        $("#validarImagen").click(function(){
            var url =  $("#imageURL").val();
            $("#setImage").attr('src',url);
            
        });
        $('#selectImagen').click(function(){
		var idNoticia = $('input:checked:first').attr('id');
                var url =  $("#imageURL").val();
                if (url == ''){
                    $("#NewurlImage").val(idNoticia);
                }else{
                    $("#NewurlImage").val(url);
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
<?php echo form_open('solicitudes/addSolicitud'); ?>
<div class="page-header">
    <h2>Solicitudes</h2>
</div>
<div class="row">
    <div class="btn-group">
        <button type="button" id="agregar" class="btn btn-success">Agregar</button>
        <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
        <button type="button" id="productos" class="btn btn-circle">Productos</button>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
</div>


