<script>
    $(document).ready(function () {

        $('#ejecutar').click(function () {
            $('input:checked').each(function () {
                var elem = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/backup/ejecutar/" + elem
                });
            });
        });

        $('#generar').click(function () {
            var aux = $("form:first")
            aux.attr('action', "<?= base_url() ?>index.php/backup/generar");
            aux.submit();
        });

        $('#eliminar').click(function () {
            $('input:checked').each(function () {
                var elem = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/backup/eliminarDatabaseLog/" + elem
                });
            });
            $(":checked").parent().parent().remove();
        });

    });


</script>

<div class="page-header">
    <h2>Manejo de Actualizaciones</h2>	
</div>

<div class="alert alert-dismissable alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    En esta seccion usted podra realizar la gestion de base de datos del sistema. Considere que si desea subir un archivo de base de datos debe ser con extension txt.
</div>


<?php echo form_open_multipart('backup/do_upload'); ?>
<input type="file" name="userfile" size="20" />
<br /><br />
<div class="btn-group">
    <input type="submit" value="Subir script" class="btn btn-primary"/>
    <button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>
    <button type="button" id="generar" class="btn btn-warning">Generar</button>
    <button type="button" id="ejecutar" class="btn btn-info">Ejecutar</button>
</div>

</form>

<?php if (validation_errors()) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>



<?php if (!empty($error)) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo $error; ?>
    </div>
<?php } ?>

<?php if (!empty($results)) { ?>
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Exito</strong>
        <?php echo base_url() . 'database/';
        print_r($results['file_name']); ?>
    </div>
<?php } ?>





<div class="row">

    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover tablesorter" id="tablaGastos" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Nombre<i class=""></i></th>
                    <th class="header">Fecha<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($databaseLogs as $item): ?>                  
                    <tr>
                        <td><input type="checkbox" id="<?php print_r($item->nombre); ?>" class="fila" ></td>
                        <td><input class="formulario" id="nombre-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/></td>
                        <td><input class="formulario" id="nombre-<?php print_r($item->id); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->fecha); ?>'/></td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>