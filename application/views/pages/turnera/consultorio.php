
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
                    $('#tablaConsultorios').append("<tr><td></td><td><input name='nombre' type='input' value=''></td><td><input name='especialidad' type='input' value=''></td><td><input name='direccion' type='input' value=''></td><td><input name='telefono' type='input' value=''></td><td><input name='horario' type='input' value=''></td><td><input name='provee' type='input' value=''></td><td><input id='NewurlImage' name='imagem' type='hidden' value=''><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#imageModal' >Imagen</button></tr>");
                    $("#fecha").datepicker({dateFormat: 'dd-mm-yy'});
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
	    var idLocal = $("input[name='consultorio']:checked").val();
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
        
        $('#solicitudes').click(function(){
	    var idLocal = $("input[name='consultorio']:checked").val();
            if (idLocal != undefined){
                idLocal = idLocal.split("-")[1];
                var $aux = $("form:first");
                $aux.attr('action',"<?=base_url()?>index.php/solicitudes/index/"+idLocal);
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
<?php echo form_open('turnera/consultorio/addConsultorio'); ?>
<div class="page-header">
    <h2>Locales</h2>
</div>
<div class="row">
    <div class="btn-group">
        <?php if ($this->session->userdata('logged_in')['menu'][0]->peso === '1000' || empty($agregados)) { ?>
        <button type="button" id="agregar" class="btn btn-success">Agregar</button>        
        <?php } ?>
        <button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>
        <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
        <button type="button" id="permisos" class="btn btn-warning">Agenda</button>
        <button type="button" id="productos" class="btn btn-circle">Productos</button>
        <button type="button" id="agenda" class="btn btn-default">Ver Agenda</button>
        <!--<button type="button" id="whatsapp" class="btn btn-success">Validar whatsapp</button>-->
        <button type="button" id="solicitudes" class="btn btn-success">Solicitudes</button>
    </div>
    

    <br>
    <br>
    <div class="table-responsive desktop">
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
    <div class="col-sm-4 mobile" id="panelConfiguracion">
        <?php $cont = 0; foreach ($agregados as $item): $cont = $cont + 1; ?>                  
            <div  class="panel panel-green">
                <div class="col-lg-6 panel-body">
                    <div class="form-group">
                        <input  type="radio" name="consultorio" value="consultorio-<?php print_r($item->idConsultorio); ?>" />
                        <label>Eliminar</label>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control formularioMobile" id="nombreMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Especialidad</label>
                        <input class="form-control formularioMobile" id="especialidadMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->especialidad); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input class="form-control formularioMobile" id="direccionMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->direccion); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input class="form-control formularioMobile" id="telefonoMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->telefono); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Horario</label>
                        <input class="form-control formularioMobile" id="horarioMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->horario); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Provee</label>
                        <input class="form-control formularioMobile" id="proveeMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->provee); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input class="form-control formularioMobile" id="imagenMobile-<?php print_r($item->idConsultorio); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->imagen); ?>'/>
                        <p class="help-block"></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>

