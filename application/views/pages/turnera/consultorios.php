<script>
    $(document).ready(function () {
        var consultorios = $(':radio[name="idConsultorio"]').length;
        if (consultorios == 1){
            $(':radio[name="idConsultorio"]').attr("checked","checked");
            $("form:first").submit();
        }
    });
</script>


<?php    echo form_open('turnera/agenda/index'); ?>

<div class="page-header">
	<h3> Seleccione un Local </h3>
</div>



<?php $cont = 0; while($cont < count($agregados)) { ?>
<input type="radio" name="idConsultorio" value="<?php print_r($agregados[$cont]->idConsultorio); ?>" > <?php print_r($agregados[$cont]->nombre); ?><br>
<?php $cont++;}?>
        
<hr>    
<button type="submit" id="guardar" class="btn btn-danger">Continuar</button>
</form>
