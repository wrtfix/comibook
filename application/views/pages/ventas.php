<script>
    cambios = [];
    guardar = [];
    remitos = [];




    $(function () {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy', onSelect: function (dateText, inst) {
                var dateAsString = dateText; //the first parameter of this function
                var dateAsObject = $(this).datepicker('getDate'); //the getDate method
                var $aux = $("form:first")
                $aux.attr('action', "<?= base_url() ?>index.php/ventas/index/" + dateAsString);
                $aux.submit();
            }});

    });
    $body = $("body");
    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        }
    });



    $(document).ready(function () {
        var fecha = '<?php if ($fechaSeleccionada != null) echo $fechaSeleccionada ?>';
        if (fecha == '') {
            fecha = $("#datepicker").val();
        }

        $("#titulo").append("Ventas del " + fecha);

        $('.formulario').keypress(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });

        $('.guardar').keypress(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), guardar) == -1) {
                guardar.push(($(this).attr('id').split('-')[1]));
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaCliente").attr("xagregar");
            for (i = 0; i < guardar.length; i++)
            {
                var producto = $('#saveProductoId-' + guardar[i]).val();
                var cantidad = $('#saveCantidad-' + guardar[i]).val();
                var cliente = $('#saveClienteId-' + guardar[i]).val();
                var precio = $('#savePrecio-' + guardar[i]).val();
                var total = $('#saveTotal-' + guardar[i]).val();
                var entregado = $('#saveEntregado-' + guardar[i]).val();
                var cobrado = $('#saveCobrado-' + guardar[i]).val();
                var rendido = $('#saveRendido-' + guardar[i]).val();

                $.ajax({
                    data: {fecha: fecha, producto: producto, cantidad: cantidad, cliente: cliente, precio: precio, total: total, entregado: entregado, cobrado: cobrado, rendido: rendido},
                    type: "POST",
                    url: "<?= base_url() ?>index.php/ventas/addVenta/",
                    success: function () {
                        $("#resultado").html("Los cambios se guardaron con exito");
                    },
                    error: function () {
                        console.log('ERROR : Verifique los campos ingresados');
                    }

                });
            }
            guardar = [];
            for (i = 0; i < cambios.length; i++)
            {
                var producto = $('#productoId-' + cambios[i]).val();
                var cantidad = $('#cantidad-' + cambios[i]).val();
                var cliente = $('#clienteId-' + cambios[i]).val();
                var precio = $('#precio-' + cambios[i]).val();
                var total = $('#total-' + cambios[i]).val();
                var entregado = $('#entregado-' + cambios[i]).val();
                var cobrado = $('#cobrado-' + cambios[i]).val();
                var rendido = $('#rendido-' + cambios[i]).val();
                
                $.ajax({
                    data: {fecha: fecha, producto: producto, cantidad: cantidad, cliente: cliente, precio: precio, total: total, entregado: entregado, cobrado: cobrado, rendido: rendido},
                    type: "POST",
                    url: "<?= base_url() ?>index.php/ventas/updateVenta/" + cambios[i],
                    success: function () {
                        cambios = [];
                    },
                    error: function () {
                        alert('ERROR : Verifique los campos ingresados');
                    }

                });
            }
            alert('Los cambios se guardaron satisfactoriamente');
            cambios = [];
        });
        $('.pago').click(function () {
            if (jQuery.inArray(($(this).attr('id').split('-')[1]), cambios) == -1) {
                cambios.push(($(this).attr('id').split('-')[1]));
            }
        });

        $('.tab').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/stock/getProductoStock/" + elem,
                dataType: 'json',
                success: function (response) {
                    if (response != '') {
                        $(donde).val(response[0].nombre);
                        var precio = "#precio-" + donde.split("-")[1];
                        
                        var substring = "save";
                        var productoId = "";
                        if (donde.indexOf(substring) !== -1){
                            productoId = "#saveProductoId-" + donde.split("-")[1];
                        }else{
                            productoId = "#productoId-" + donde.split("-")[1];
                        }
                        $(productoId).val(response[0].idProducto);
                        $(precio).val(response[0].precio);
                    }
                }
            });
        });

        $('.tabTotal').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            var elemPrecio = "#precio-" + donde.split("-")[1];
            var valPrecio = $(elemPrecio).val();
            var total = valPrecio * elem;
            var elemTotal = "#total-" + donde.split("-")[1];
            $(elemTotal).val(total);

        });

        $('.tabCliente').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/cheques/getCliente/" + elem,
                dataType: 'json',
                success: function (response) {
                    if (response != ''){
                        $(donde).val(response[0].Nombre);
                        
                        var substring = "save";
                        var clienteId = "";
                        if (donde.indexOf(substring) !== -1){
                            clienteId = "#saveClienteId-" + donde.split("-")[1];
                        }else{
                            clienteId = "#clienteId-" + donde.split("-")[1];
                        }
                        
                        $(clienteId).val(response[0].Id);
                    }
                }
            });
        });

        $('.suma').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            $("#calcularTotal").val(parseFloat($("#calcularTotal").val()) + parseFloat(elem));

        });

        $('#eliminar').click(function () {
            $('input:checked').each(function () {
                var elem = $(this).attr('id');
                var id = $("#identificador").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/ventas/delVenta/" + elem
                });
            });
            $("input:checkbox:checked").parent().parent().remove();
            location.reload();
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
<?php echo form_open('ventas/addVenta'); ?>
<div class="row">
    <h2><div id="titulo"></div></h2>
    <div id="datepicker"></div>
    <br>
    <div id="row" class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4"></div>

    </div>

    <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>

    <dir id="pedidos"></dir>
    <div class="table-responsive" id="pedidos">
        <table class="table table-bordered table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Selec.<i class=""></i></th>
                    <th class="header">Producto<i class=""></i></th>
                    <th class="header headerSortDown" width="50px">Cantidad<i class=""></i></th>
                    <th class="header">Cliente<i class=""></i></th>
                    <th class="header"  width="50px">Precio<i class=""></i></th>
                    <th class="header">Total<i class=""></i></th>
                    <th class="header">Entregado<i class=""></i></th>
                    <th class="header">Cobrado<i class=""></i></th>
                    <th class="header">Rendido<i class=""></i></th>
                </tr>
            </thead>
            <tbody>

                <?php $cont = 0;
                $total = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><input type="checkbox" class="selec" id="<?php print_r($item->idVenta); ?>" value=""></td>
                        <td><input class="formulario tab" id="producto-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ProductoNombre); ?>'/> <input id="productoId-<?php print_r($item->idVenta); ?>" type='hidden' value='<?php print_r($item->idProducto); ?>'/> <div id="listarProducto-<?php print_r($item->Numero); ?>"></div></td>
                        <td width="50px"><input class="formulario suma" id="cantidad-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->cantidad); ?>'/></td>
                        <td><input class="formulario tabCliente" id="cliente-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ClienteNombre); ?>'/> <input id="clienteId-<?php print_r($item->idVenta); ?>" type='hidden' value='<?php print_r($item->idCliente); ?>'/></td>
                        <td width="50px"><input class="formulario" id="precio-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->precio); ?>'/></td>
                        <td><input class="formulario" id="total-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->total); ?>'/></td>
                        <td>
                            <select class="pago" id="entregado-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' >
                                <option value="0" <?php if ($item->entregado == 0) echo "selected"; ?>>No</option>
                                <option value="1" <?php if ($item->entregado == 1) echo "selected"; ?>>Si</option>
                            </select>
                        </td>
                        <td>
                            <select class="pago" id="cobrado-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' >
                                <option value="0" <?php if ($item->cobrado == 0) echo "selected"; ?>>No</option>
                                <option value="1" <?php if ($item->cobrado == 1) echo "selected"; ?>>Si</option>
                            </select>
                        </td>
                        <td>
                            <select class="pago" id="rendido-<?php print_r($item->idVenta); ?>" style='width: 100%; border:none;' >
                                <option value="0" <?php if ($item->rendido == 0) echo "selected"; ?>>No</option>
                                <option value="1" <?php if ($item->rendido == 1) echo "selected"; ?>>Si</option>
                            </select>
                        </td>


                    </tr>
<?php endforeach; ?>
<?php for ($i = 0; $i < 100; $i++) { ?>
                    <tr>
                        <td><input type="checkbox" class="selec" value=""></td>
                        <td><input class="guardar tab" id="saveProducto-<?php echo $i; ?>" style='width: 100%; border:none;' type='text' /> <input id="saveProductoId-<?php echo $i; ?>" type='hidden' />  <div id="listarProducto-<?php echo $i; ?>"></div></td>
                        <td width="50px" ><input class="guardar tabTotal" id="saveCantidad-<?php echo $i; ?>" style='width: 50px; border:none;' type='text' /></td>
                        <td><input class="guardar tabCliente" id="saveCliente-<?php echo $i; ?>" style='width: 100%; border:none;' type='text' />  <input id="saveClienteId-<?php echo $i; ?>" type='hidden' /> </td>
                        <td width="50px" ><input class="guardar" id="savePrecio-<?php echo $i; ?>" style='width: 50px; border:none;' type='text' /></td>
                        <td width="50px"><input class="guardar suma" id="saveTotal-<?php echo $i; ?>" style='width: 50px; border:none;' type='text' /></td>
                        <td>
                            <select class="guardar" id="saveEntregado-<?php echo $i; ?>" style='width: 100%; border:none;' >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </td>
                        <td>
                            <select class="guardar" id="saveCobrado-<?php echo $i; ?>" style='width: 100%; border:none;' >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </td>
                        <td>
                            <select class="guardar" id="saveRendido-<?php echo $i; ?>" style='width: 100%; border:none;' >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </td>
                    </tr>

<?php } ?>
            </tbody>
        </table>
    </div>
</div>
