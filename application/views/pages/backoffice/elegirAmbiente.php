<?    echo form_open('backoffice/elegirAmbiente/update'); ?>

<div class="page-header">
	<h3> Seleccione Ambiente </h3>
</div>



<?php $cont = 0; while($cont < count($menu)) { ?>
<input type="radio" name="idAmbiente" value="<?php print_r($menu[$cont]->idAmbiente); ?>" <?php if ($this->session->userdata('logged_in')['idAmbiente'] == $menu[$cont]->idAmbiente) echo 'checked'; ?> > <?php print_r($menu[$cont]->nombre); ?><br>
<?php $cont++;}?>
        
<input type="hidden" name="idUsuario" value="<?php print_r($idUsuario); ?>" >
<hr>    
<button type="submit" id="guardar" class="btn btn-danger">Guardar</button>
</form>
