<script>
    cambios = [];
    $(document).ready(function () {
        $('#agregar').click(function () {
            var agrego = $("#tablaCliente").attr("xagregar");
            if (agrego == 'false') {
                $('#tablaCliente').append("<tr><td></td><td><select name='dia'> <option value='MON'>Lunes</option> <option value='TUE'>Martes</option> <option value='WED'>Miercoles</option> <option value='THU'>Jueves</option> <option value='FRI'>Viernes</option> <option value='SAT'>Sabado</option> <option value='SUN'>Domingo</option> </select></td><td><input name='horaDesde' type='time' value=''></td><td><input name='horaHasta' type='time' value=''></td><td><input name='intervalo' type='number' value=''></td></tr>");
                $("#tablaCliente").attr("xagregar", "true");
            }
        });
        $('#guardar').click(function () {
            var agrego = $("#tablaCliente").attr("xagregar");
            if (agrego == 'true') {
                $("form:first").submit();
            } else {
                for (i = 0; i < cambios.length; i++) {
                    var dia = $('#dia-' + cambios[i]).val();
                    var horaDesde = $('#horaDesde-' + cambios[i]).val();
                    var horaHasta = $('#horaHasta-' + cambios[i]).val();
                    var intervalo = $('#intervalo-' + cambios[i]).val();
                    $.ajax({
                        data: {dia: dia, horaDesde: horaDesde, horaHasta: horaHasta, intervalo:intervalo},
                        type: "POST",
                        url: "<?= base_url() ?>index.php/turnera/horario/updateHorario/" + cambios[i],
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
                    url: "<?= base_url() ?>index.php/turnera/horario/delHorario/" + elem
                });
                $("#table-"+elem).remove();
            });
        });

        $('.formulario').change(function () {
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
<?php echo form_open('turnera/horario/addHorario'); ?>
<div class='row'>

    <div class="page-header">
        <h2>Horarios</h2>
    </div>

    <button type='button' id='agregar' class='btn btn-success'>Agregar</button>
    <button type='button' id="eliminar" class='btn btn-danger'>Eliminar</button>
    <button type='button' id='guardar' class='btn btn-primary'>Guardar</button>
    <br> <br>
    <input name="idConsultorio" id="desde" class="" autocomplete="off" value="<?php print_r($idConsultorio); ?>" type="hidden">  
    <div class='table-responsive'>
        <table class='table table-bordered table-hover tablesorter' id='tablaCliente' xagregar="false">
            <thead>
                <tr>
                    <th class='header'>Eliminar<i class=''></i></th>
                    <th class='header'>Dias laborales <i class=''></i></th>
                    <th class='header'>Hora desde<i class=''></i></th>
                    <th class='header'>Hora hasta<i class=''></i></th>
                    <th class='header'>Intervalos<i class=''></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>
                    <tr id="table-<?php print_r($item->idDia); ?>">
                        <td><input type="checkbox" id="<?php print_r($item->idDia); ?>" class="fila"></td>
                        <td>
                            <select class="formulario" id="dia-<?php print_r($item->idDia); ?>"> 
                                <option value="MON" <?php if ($item->nombre=='MON') echo "selected"; ?>>Lunes</option> 
                                <option value="TUE" <?php if ($item->nombre=='TUE') echo "selected"; ?>>Martes</option> 
                                <option value="WED" <?php if ($item->nombre=='WED') echo "selected"; ?>>Miercoles</option> 
                                <option value="THU" <?php if ($item->nombre=='THU') echo "selected"; ?>>Jueves</option> 
                                <option value="FRI" <?php if ($item->nombre=='FRI') echo "selected"; ?>>Viernes</option> 
                                <option value="SAT" <?php if ($item->nombre=='SAT') echo "selected"; ?>>Sabado</option> 
                                <option value="SUN" <?php if ($item->nombre=='SUN') echo "selected"; ?>>Domingo</option> 
                            </select> 
                        </td>
                        <td><input class="formulario" id="horaDesde-<?php print_r($item->idDia); ?>" name=""style='width: 100%; border:none;' type='time' value='<?php echo $item->horaDesde; ?>'/></td>
                        <td><input class="formulario" id="horaHasta-<?php print_r($item->idDia); ?>" style='width: 100%; border:none;' type='time' value='<?php echo $item->horaHasta; ?>'/></td>
                        <td><input class="formulario" id="intervalo-<?php print_r($item->idDia); ?>" style='width: 100%; border:none;' type='number' value='<?php echo $item->intervalo; ?>'/></td>                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
