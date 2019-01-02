<script>
$(document).ready(function(){
        $('#restaurar').click(function(){
                $.ajax({
                       type: "POST",
                       url: "<?=base_url()?>index.php/backup/restaurar/",
                       success: function(){
                           console.log('hola');
                       }
                       
                });
        });

});


</script>



<div class="page-header">
	<h2>Copia de seguridad</h2>	
</div>
<p> Realice una copia de seguridad a traves del siguiente boton</p>

<?php echo form_open('backup/generar'); ?>

<button type="submit" id="guardar" class="btn btn-danger">Generar</button>
<button id="restaurar" class="btn btn-warning">Restaurar</button>
</form>
