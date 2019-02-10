<script>
    cambios = [];
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaCliente").attr("xagregar");
            if (agrego == 'false') {
                $('#tablaCliente').append("<tr><td></td><td><input name='numero' type='input' value=''></td><td><input name='nombre' type='input' value=''></td><td><input name='peso' type='input' value=''></td><td><input name='precio' type='input' value=''></td></tr>");
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
                    $.ajax({
                        data: {numero: numero, nombre: nombre, peso: peso, precio: precio},
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

    <button type='button' id='agregar' class='btn btn-success'>Agregar</button>
    <button type='button' id="eliminar" class='btn btn-danger'>Eliminar</button>
    <button type='button' id='guardar' class='btn btn-primary'>Guardar</button>
    <br> <br>
    <div class='table-responsive'>
        <table class='table table-bordered table-hover tablesorter' id='tablaCliente' xagregar="false">
            <thead>
                <tr>
                    <th class='header'>Eliminar<i class=''></i></th>
                    <th class='header'>Número<i class=''></i></th>
                    <th class='header'>Nombre<i class=''></i></th>
                    <th class='header'>Peso (gr)<i class=''></i></th>
                    <th class='header'>Precio unitario ($)<i class=''></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->idProducto); ?>" class="fila"></td>
                        <td><input class="formulario" id="numero-<?php print_r($item->idProducto); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->numero); ?>'/></td>
                        <td><input class="formulario" id="nombre-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->nombre; ?>'/></td>
                        <td><input class="formulario" id="peso-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->peso; ?>'/></td>
                        <td><input class="formulario" id="precio-<?php print_r($item->idProducto); ?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->precio; ?>'/></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
