<div class="page-header">
	<h2>Imagenes</h2>	
</div>

<script>
$(document).ready(function(){
	$('#eliminar').click(function(){
		$('input:checked').each(function() {
		    var elem = $(this).attr('id');
			$.ajax({
			       type: "POST",
			       url: "<?=base_url()?>index.php/imprimir/eliminarImagen/"+elem
			});
		});
 		$(":checked").parent().parent().remove();
	});

});

</script>
<?php if (validation_errors()){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo validation_errors(); ?>
</div>
<?php }?>



<?php if (!empty($error)){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo $error; ?>
</div>
<?php }?>

<?php if (!empty($results)){?>
<div class="alert alert-dismissable alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Exito</strong>
	<?php echo base_url().'uploads/'; print_r($results['file_name']);?>
</div>
<?php }?>



<?php echo form_open_multipart('imprimir/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="Subir" class="btn btn-primary"/>
<button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>

</form>

   <div class="row">
            
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" id="tablaGastos" xagregar="false">
                <thead>
                  <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Nombre<i class=""></i></th>
                    <th class="header">Imagen<i class=""></i></th>
                    <th class="header">Url<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($imagenes as $item): ?>                  
                <tr>
                  <td><input type="checkbox" id="<?php print_r($item->nombre);?>" class="fila" ></td>
                  <td><input class="formulario" id="nombre-<?php print_r($item->idImagen);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre);?>'/></td>
                  <td><img src="<?php echo base_url().'uploads/'; print_r($item->nombre);?>"/></td>
                  <td><?php echo base_url().'uploads/'; print_r($item->nombre);?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>