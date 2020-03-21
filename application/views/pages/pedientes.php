<script>
    $(document).ready(function () {
        $('#buscar').click(function () {
            var $aux = $("form:first");
            nombre = nombre.replace(".", "");
            $aux.submit();
        });

        $("#impresion").click(function () {
            var $aux = $("form:first")
            $aux.attr('action', "<?= base_url() ?>index.php/pedientes/generarPDF/");
            $aux.submit();
        });

        $('.tab').focusout(function () {
            var elem = $("#" + $(this).attr('id')).val();
            var donde = "#" + $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/cheques/getCliente/" + elem,
                dataType: 'json',
                success: function (response) {
                    $(donde).val(response[0].Nombre);
                }
            });
        });

    });
    $(function () {
        $("#desde").datepicker({dateFormat: 'dd-mm-yy'});
        $("#hasta").datepicker({dateFormat: 'dd-mm-yy'});
    });

</script>
<?php echo form_open('pedientes/index'); ?>
<div class="row">


    <h2>Liquidacion</h2>
    <hr/>
    <div class="row">
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label>Fecha desde </label>
                <input name="desde"  id="desde" class="form-control"/>
            </fieldset>
        </div>
        <div class="col-lg-3">

            <fieldset class="form-group">
                <label>Fecha hasta </label>
                <input name="hasta" id="hasta" class="form-control"/>

            </fieldset>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Pendiente</label>
                <select class="form-control" id="pendiente" name="pendiente">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label>Nombre </label>
                <input name="nombreBusqueda" id="nombreBusqueda" class="tab form-control"/>
            </fieldset>
        </div>
    </div>

    <button type="submit" class="btn btn-default" id="buscar">Buscar</button>
    <a href="#" id="impresion" class="btn btn-primary">Imprimir</a>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Fecha<i class=""></i></th>
                    <th class="header">Cliente origen<i class=""></i></th>
                    <th class="header">Cliente destino<i class=""></i></th>
                    <th class="header headerSortDown">Importe en $<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr>
                        <td><?php list($dia, $mes, $ano) = explode("-", $item->Fecha);
                    echo $ano . "-" . $mes . "-" . $dia; ?></td>                  
                        <td><?php print_r($item->ClienteOrignen); ?></td>
                        <td><?php print_r($item->ClienteDestino); ?></td>
                        <td><?php print_r($item->CostoFlete); ?></td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>Importe total: $ <?php print_r($totalImporte[0]->total); ?> </p>
    <p>Bultos: <?php print_r($cont); ?> </p>
</div>



</div>