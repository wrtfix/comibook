<script>
cambios=[];
$(document).ready(function(){
	$('#agregar').click(function(){
		var agrego = $("#tablaConfiguracion").attr("xagregar");
		if (agrego=='false'){
			$('#tablaConfiguracion').append("<tr><td></td><td><input name='atributo' type='input' value=''></td><td><input name='valor' id='valor' class='tab' type='input' value=''></td><td><input class='tab' id='descripcion' name='descripcion' type='input' value=''></td></tr>");
			$("#tablaConfiguracion").attr("xagregar","true");
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaConfiguracion").attr("xagregar");
		if (agrego=='true'){ 
			$("form:first").submit();
		}else{
			for (i = 0; i < cambios.length; i++){
				var atributo = $('#atributo-'+cambios[i]).val();
				var valor = $('#valor-'+cambios[i]).val();
				var descripcion = $('#descripcion-'+cambios[i]).val();
				$.ajax({
					   data: {atributo:atributo,valor:valor,descripcion:descripcion},
				       type: "POST",
				       url: "<?=base_url()?>index.php/backoffice/configuracion/updateConfiguracion/"+cambios[i],
					   success: function(){
				    	   alert('Los cambios se guardaron con exito!');
				    	   cambios = [];
					   },
					   error: function(){
						   alert('ERROR : Verifique los campos ingresados');
					   }
				});
			}
		}
			
	});

	$('#eliminar').click(function(){
		$('input:checked').each(function() {
		    var elem = $(this).attr('id');
		    var id = $("#identificador").val();
			$.ajax({
			       type: "POST",
			       url: "<?=base_url()?>index.php/backoffice/configuracion/delConfiguracion/"+elem
			});
		});
 		$(":checked").parent().parent().remove();
	});
        
        $('#sendEmail').click(function(){
                $.ajax({
                       type: "POST",
                       url: "<?=base_url()?>index.php/backoffice/configuracion/testSendEmail/",
                       success: function(){
                           console.log('hola');
                       }
                       
                });
        });

	

	$('.formulario').keydown(function(event){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
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

<?php echo form_open('backoffice/configuracion/addConfiguracion'); ?>
    <div class="page-header">
                 <h3>Configuracion</h3>
    </div>
<div class="row">

  
        </div>
            <button type="button" id="agregar" class="btn btn-success">Agregar</button>
            <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
            <button type="button" id="sendEmail" class="btn btn-default">Test email</button>
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" id="tablaConfiguracion" xagregar="false">
                <thead>
                  <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
  					<th class="header">Clave<i class=""></i></th>
                    <th class="header">Valor<i class=""></i></th>
  					<th class="header">Descripcion<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
				<?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>
                <tr>
                  <td><input type="checkbox" id="<?php print_r($item->id);?>" class="fila tab"></td>
                  <td><input class="formulario" id="atributo-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->atributo);?>'/></td>
                  <!--<td><input class="formulario tab" id="valor-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->valor);?>'/></td>-->
                  <td><textarea class="formulario tab" id="valor-<?php print_r($item->id);?>" style='width: 100%; border:none;'><?php print_r($item->valor);?></textarea></td>
                  <td><input class="formulario tab" id="descripcion-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->descripcion);?>'/></td>
                  </tr>
                  <?php endforeach; ?>
				</tbody>
              </table>
            </div>
          </div>
          

      </div>