<?php if (empty($items)) 
    echo form_open('backoffice/rol/addMenu'); 
else 
    echo form_open('backoffice/rol/update'); ?>

<div class="page-header">
    <h1> Usuario nombre: <?php  print_r($usuarioSeleccionado[0]->username); ?></h1>    
</div>

<div class="page-header">
	<h3> Opciones de menu </h3>
</div>

<?php $cont = 0; while($cont < count($menu)) { ?>
        <input type="checkbox" name="<?php print_r($menu[$cont]->idMenu); ?>" <?php if ($menu[$cont]->idRUsuarioMenu != null) echo 'checked'; ?> > <?php print_r($menu[$cont]->grupo); ?><br>
<?php $cont++;}?>
        
<input type="hidden" name="idUsuario" value="<?php print_r($idUsuario); ?>" >
    
<button type="submit" id="guardar" class="btn btn-danger">Guardar</button>
</form>