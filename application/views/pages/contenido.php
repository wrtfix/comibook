<script src="<?=base_url()?>estilo/admin/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#guardar').click(function(){
 			console.log(tinyMCE.activeEditor.getContent());
 		});

	});
</script>

<?php echo form_open('contenidos/addContenido'); ?>
<div class="page-header">
	<h3> Opcion de menu </h3>
</div>
<?php $cont = 0; while($cont < count($menu)) { ?>
	<input type="checkbox" name="<?php print_r($menu[$cont]->idGasto); ?>"> <?php print_r($menu[$cont]->nombre); ?><br>
<?php $cont++;}?>
<input type="hidden" name="idNoticia" value="<?php print_r($idNoticia); ?>" >

<div class="page-header">
<h3> Contenido </h3>
</div>

<textarea name="contenido" id="contenidoText"></textarea>
<br>
<button type="submit" id="guardar" class="btn btn-danger">Guardar</button>

</form>