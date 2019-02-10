<script>
    cambios = [];
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaCheques").attr("xagregar");
            if (agrego == 'false') {
                $('#tablaCheques').append("<tr><td></td><td><input name='fecha' id='fecha' type='input' value=''></td><td><input id='producto' name='producto' type='input' value='' class='tab'> <input id='idProducto' name='idProducto' type='hidden' value='' class=''></td><td><input name='stockEntrada' id='stockEntrada' type='input' value=''></td><td><input name='stockSalida' type='input' value=''></td><td><input name='minimo' id='minimo' type='input' value=''></td><td><input class='tab' id='destino' name='destino' type='input' value=''></td><td><input class='tab' id='destino' name='destino' type='input' value=''></td></tr>");
                $("#tablaCheques").attr("xagregar", "true");
                $("#fecha").datepicker({dateFormat: 'dd-mm-yy'});
                $('.tab').focusout(function () {
                    var elem = $("#" + $(this).attr('id')).val();
                    var donde = "#" + $(this).attr('id');
                    console.log(elem + " " + donde);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>index.php/stock/getProducto/" + elem,
                        dataType: 'json',
                        success: function (response) {
                            $(donde).val(response[0].nombre);
                            $("#idProducto").val(elem);
                        }
                    });
                });


            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaCheques").attr("xagregar");

            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                for (i = 0; i < cambios.length; i++) {
                    var nombre = $('#nombre-' + cambios[i]).val();
                    var idProducto = $('#idProducto-' + cambios[i]).val();
                    var fecha = $('#fecha-' + cambios[i]).val();
                    var stockEntrada = $('#stockEntrada-' + cambios[i]).val();
                    var stockSalida = $('#stockSalida-' + cambios[i]).val();
                    var minimo = $('#minimo-' + cambios[i]).val();
                    $.ajax({
                        data: {nombre: nombre, fecha: fecha, idProducto: idProducto, stockEntrada: stockEntrada, stockSalida: stockSalida, minimo: minimo},
                        type: "POST",
                        url: "<?= base_url() ?>index.php/stock/updateStock/" + cambios[i],
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
                    url: "<?= base_url() ?>index.php/stock/delStock/" + elem
                });
            });
            $(":checked").parent().parent().remove();
        });

        $('.formulario').keyup(function (event) {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });

        $('.tab').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/stock/getProducto/" + elem,
                dataType: 'json',
                success: function (response) {
                    $(donde).val(response[0].nombre);
                    var newIdProducto = "#idProducto-"+donde.split("-")[1];
                    $(newIdProducto).val(elem);
                }
            });
        });

        $('#buscar').click(function () {
            var $aux = $("form:first");
            var nombre = $('#nombreBusqueda').val();
            var fechaDesde = $('#desde').val();
            var fechaHasta = $('#hasta').val();
            if (fechaDesde == '') {
                fechaDesde = 'null';
            }
            if (fechaHasta == '') {
                fechaHasta = 'null';
            }
            if (nombre == '') {
                nombre = 'null';
            }
            $aux.attr('action', "<?= base_url() ?>index.php/cheques/index/" + nombre + "/" + fechaDesde + "/" + fechaHasta);
            $aux.submit();
        });
        $(".fechaInput").datepicker({dateFormat: 'dd-mm-yy'});
    });

    $(function () {
        $("#desde").datepicker({dateFormat: 'dd-mm-yy'});
        $("#hasta").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>

<?php if (validation_errors()) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>

<?php echo form_open('stock/addStock'); ?>
<div class="row">
    <h2>Stock</h2>

    <div class="row">
        <div class="col-lg-4">
            <div class="checkbox">
                <label>
                    Fecha desde <input id="desde" class="">
                </label>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="checkbox">
                <label>
                    Fecha hasta <input id="hasta"class="">
                </label>
            </div>
        </div>
    </div>
    <button type="button" id="buscar" class="btn btn-default">Buscar</button>
    <button type="button" id="agregar" class="btn btn-success">Agregar</button>
    <button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>
    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover tablesorter" id="tablaCheques" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Fecha<i class=""></i></th>
                    <th class="header headerSortDown">Producto<i class=""></i></th>
                    <th class="header headerSortDown">Compra<i class=""></i></th>
                    <th class="header">Ventas<i class=""></i></th>
                    <th class="header">Minimo<i class=""></i></th>
                    <th class="header">Stock<i class=""></i></th>
                    <th class="header">Compras a fabrica<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0; 
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->idStock); ?>" class="fila tab"></td>
                        <td><input class="formulario" id="fecha-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php list($dia, $mes, $ano) = explode("-", $item->fecha);
                    echo $ano . "-" . $mes . "-" . $dia; ?>'/></td>                  
                        <td><input class="formulario tab" id="nombre-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/> <input class="formulario" id="idProducto-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='hidden' value='<?php print_r($item->idProducto); ?>'/> </td>
                        <td><input class="formulario" id="stockEntrada-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->stockEntrada); ?>'/></td>
                        <td><input class="formulario" id="stockSalida-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->stockSalida); ?>'/></td>
                        <td><input class="formulario" id="minimo-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->minimo); ?>'/></td>
                        <td><input class="formulario" id="stock-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->stockEntrada-$item->stockSalida); ?>'/></td>
                        <td><input class="formulario tab" id="comprasFabrica-<?php print_r($item->idStock); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->stockSalida-$item->stockEntrada+$item->minimo); ?>'/></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


</div>