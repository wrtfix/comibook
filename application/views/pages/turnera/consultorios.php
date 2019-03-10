<?    echo form_open('turnera/agenda/index'); ?>

<div class="page-header">
	<h3> Seleccione Consultorio </h3>
</div>



<?php $cont = 0; while($cont < count($agregados)) { ?>
<input type="radio" name="idConsultorio" value="<?php print_r($agregados[$cont]->idConsultorio); ?>" > <?php print_r($agregados[$cont]->nombre); ?><br>
<?php $cont++;}?>
        
<hr>    
<button type="submit" id="guardar" class="btn btn-danger">Continuar</button>
</form>
