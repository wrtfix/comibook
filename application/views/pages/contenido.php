<script src="<?=base_url()?>estilo/admin/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript">
	$(document).ready(function(){
                $('#verComentarios').click(function(){
 			var $aux = $("form:first");
                        $aux.attr('action',"<?=base_url()?>index.php/comentario/index");
                        $aux.submit();
 		});
                

	});
</script>

<?php if (empty($noticia)) 
    echo form_open('contenidos/addContenido'); 
else 
    echo form_open('contenidos/update'); ?>
<div class="page-header">
    <h1><?php  print_r($noticiaSeleccionada[0]->ClienteOrignen); ?></h1>
    <p><?php  print_r($noticiaSeleccionada[0]->ClienteDestino); ?></p>
</div>

<div class="page-header">
	<h3> Opcion de menu </h3>
</div>
<?php $cont = 0; while($cont < count($menu)) { ?>
        <input type="checkbox" name="<?php print_r($menu[$cont]->idGasto); ?>" <?php if ($menu[$cont]->idRContenidoMenu != null) echo 'checked'; ?> > <?php print_r($menu[$cont]->nombre); ?><br>
<?php $cont++;}?>
        
<input type="hidden" name="idNoticia" value="<?php print_r($idNoticia); ?>" >
<?php if (!empty($noticia)) { ?>
    <input type="hidden" name="idContenido" value="<?php  print_r($noticia[0]->idContenido); ?>" >
<?php } ?>
<div class="page-header">
<h3> Contenido </h3>
</div>

    



    <textarea name="contenido" id="contenidoText"><?php if (!empty($noticia)) print_r($noticia[0]->Contenido); ?></textarea>
<br>
<button type="submit" id="guardar" class="btn btn-danger">Guardar</button>
<button type="button" id="verComentarios" class="btn btn-warning">Comentarios</button>
</form>