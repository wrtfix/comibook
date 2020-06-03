<script>
    cambios = [];
    
     function getProveedores(elem, donde){
            $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/producto/getProveedor/" + elem,
                    dataType: 'json',
                    success: function (response) {
                        if (response != '') {
                            $(donde).val(response[0].Nombre);
                            $(donde+"-Hidden").val(elem);
                        }
                    }
            });
    }
    
    function setearProveedor(){
        getProveedores($("#proveedor").val(),"#proveedor");
    }
    
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaCliente").attr("xagregar");
            if (agrego == 'false') {
                $('#tablaCliente').append("<tr><td></td><td><input name='numero' type='input' value=''></td><td><input name='proveedor' id='proveedor' type='input' value='' onfocusout='setearProveedor();'> <input name='idProvedor' id='proveedor-Hidden' type='hidden' value='' > </td><td><input name='nombre' type='input' value=''></td><td><input name='peso' type='input' value=''></td><td><input name='precio' type='input' value=''></td><td><input name='imagen' type='input' value=''><input name='idLocal' type='hidden' value='<?php print_r($idLocal)?>'></td><td><textarea name='descripcion'></textarea></td></tr>");
                $("#tablaCliente").attr("xagregar", "true");
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaCliente").attr("xagregar");
            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                for (i = 0; i < cambios.length; i++) {
                    var numero = $('#numero-' + cambios[i]).val();
                    var nombre = $('#nombre-' + cambios[i]).val();
                    var peso = $('#peso-' + cambios[i]).val();
                    var precio = $('#precio-' + cambios[i]).val();
                    var imagen = $('#imagen-' + cambios[i]).val();
                    var descripcion = $('#descripcion-' + cambios[i]).val();
                    var idProvedor = $('#proveedor-' + cambios[i]+'-Hidden').val();
                    var idLocal = '<?php print_r($idLocal)?>';
                    $.ajax({
                        data: {numero: numero, nombre: nombre, peso: peso, precio: precio, imagen:imagen, descripcion:descripcion, idLocal:idLocal, idProvedor:idProvedor},
                        type: "POST",
                        url: "<?= base_url() ?>index.php/producto/updateProducto/" + cambios[i],
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
        
        $('.tabProveedor').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            getProveedores(elem, donde);
        });


        $('#eliminar').click(function () {
            $('input:checked').each(function () {
                var elem = $(this).attr('id');
                var id = $("#identificador").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/producto/delProducto/" + elem
                });
            });
            $(":checked").parent().parent().remove();
        });

        $('.formulario').keydown(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });


    });

</script>
<?php if (validation_errors()) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<?php echo form_open('producto/addProducto'); ?>
<div class='row'>



    <div class="page-header">
        <h3> Producto </h3>
    </div>
    <div class="btn-group">
        <button type='button' id='agregar' class='btn btn-success'>Agregar</button>
        <button type='button' id="eliminar" class='btn btn-danger'>Eliminar</button>
        <button type='button' id='guardar' class='btn btn-primary'>Guardar</button>
    </div>
    
    <br> <br>
    <div class='table-responsive'>
        <table class='table table-bordered table-hover tablesorter' id='tablaCliente' xagregar="false">
            <thead>
                <tr>
                    <th class='header'>Eliminar<i class=''></i></th>
                    <th class='header'>Número<i class=''></i></th>
                    <th class='header'>Proveedor<i class=''></i></th>
                    <th class='header'>Nombre<i class=''></i></th>
                    <th class='header'>Peso (gr)<i class=''></i></th>
                    <th class='header'>Precio unitario ($)<i class=''></i></th>
                    <th class='header'>Imagen</th>
                    <th class='header'>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->idProducto); ?>" class="fila"></td>
                        <td><input class="formulario" id="numero-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->numero); ?>'/></td>
                        <td>
                            <input class="formulario tabProveedor" id="proveedor-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Nombre); ?>'/>
                            <input class="formulario tabProveedor" id="proveedor-<?php print_r($item->idProducto); ?>-Hidden" type='hidden' value='<?php print_r($item->idProveedor); ?>'/>
                        </td>
                        <td><input class="formulario" id="nombre-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->nombre; ?>'/></td>
                        <td><input class="formulario" id="peso-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->peso; ?>'/></td>
                        <td><input class="formulario" id="precio-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->precio; ?>'/></td>
                        <td><input class="formulario" id="imagen-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->imagen; ?>'/></td>
                        <td><textarea class="formulario" id="descripcion-<?php print_r($item->idProducto); ?>" name="" style='width: 100%; border:none;' > <?php echo $item->descripcion; ?></textarea> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
