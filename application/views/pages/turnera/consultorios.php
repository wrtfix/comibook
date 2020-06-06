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
<?php $cont++;} if ($cont == 0) {?>
<p>Debe crear un local si desea visualizar la agenda. Si desea dar de alta un local haga clik <a href="<?php echo site_url('/turnera/consultorio/index'); ?>">aqui</a> </p>
<?php }else{ ?>
        
<hr>    
<button type="submit" id="guardar" class="btn btn-danger">Continuar</button>
<?php } ?>
</form>
