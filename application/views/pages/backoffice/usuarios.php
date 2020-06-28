<script>
    cambios = [];
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaGastos").attr("xagregar");
            if (agrego == 'false') {
                $('#tablaGastos').append("<tr><td></td><td><input name='username' type='input' value=''></td><td><input name='password' type='input' value=''></td></tr>");
                $("#tablaGastos").attr("xagregar", "true");
                $("#fecha").datepicker({dateFormat: 'dd-mm-yy'});
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaGastos").attr("xagregar");

            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                for (i = 0; i < cambios.length; i++) {
                    var nombre = $('#nombre-' + cambios[i]).val();
                    var password = $('#password-' + cambios[i]).val();
                    $.ajax({
                        data: {nombre: nombre, password: password},
                        type: "POST",
                        url: "<?= base_url() ?>index.php/backoffice/usuario/updateUser/" + cambios[i],
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
        
        var eliminar = function eliminar(){
            $('input:checked').each(function () {
                var elem = $(this).attr('id');
                var id = $("#identificador").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/backoffice/usuario/delUser/" + elem
                });
            });
            $(":checked").parent().parent().remove();
        }
        
        tasks.push(eliminar);
        
        $('#eliminar').click(function () {
            $("#msjConfirmacionModal").html("Esta seguro que desea eliminar?");
            taskNumber = 1;
        });

        $('.formulario').blur(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });
        
        $(".fechaInput").datepicker({dateFormat: 'dd-mm-yy'});
        
        $('#permisos').click(function(){
	    var idUsuario = $('input:checked:first').attr('id');
            if (idUsuario != undefined){
                var $aux = $("form:first")
                $aux.attr('action',"<?=base_url()?>index.php/backoffice/rol/index/"+idUsuario);
                $aux.submit();
            }else{
                alert("No es posible cargar dar permisos a un usuario sin haberla seleccionado previamente");
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        
        $('#permisosAmbiente').click(function(){
	    var idUsuario = $('input:checked:first').attr('id');
            if (idUsuario != undefined){
                var $aux = $("form:first")
                $aux.attr('action',"<?=base_url()?>index.php/backoffice/usuarioAmbiente/index/"+idUsuario);
                $aux.submit();
            }else{
                alert("No es posible cargar dar permisos a un usuario sin haberla seleccionado previamente");
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
    function desencriptar(valor){
        $.ajax({
            type: "POST",
            contentType: 'application/json',
            accepts: 'application/json',
            
            url: "https://api.apitools.zone/crypto/md5/reverse",
            success: function (response) {
                    showInfo('La clave es:'+response.text, "info");
            }
        });
    }

</script>
<?php if (validation_errors()) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<?php echo form_open('backoffice/usuario/addUser'); ?>
<div class="page-header">
    <h2>Usuarios</h2>
</div>
<div class="row">
    <div class="btn-group">
        <button type="button" id="agregar" class="btn btn-success">Agregar</button>
        <button type="button"  data-target='#confirmationModal' data-toggle='modal' id="eliminar"class="btn btn-danger">Eliminar</button>
        <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
        <button type="button" id="permisos" class="btn btn-warning">Menus</button>
        <button type="button" id="permisosAmbiente" class="btn btn-secondary">Ambientes</button>
    </div>
    

    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover tablesorter" id="tablaGastos" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Usuario<i class=""></i></th>
                    <th class="header">Password<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>                  
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->id); ?>" class="fila" ></td>
                        <td><input class="formulario" name="username" id="nombre-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->username); ?>'/></td>
                        <td>
                            <input class="formulario" name="password" id="password-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='password' value='<?php print_r($item->password); ?>'/>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>