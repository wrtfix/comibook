<script>
cambios=[];
$(document).ready(function(){
	$('#agregar').click(function(){
		var agrego = $("#tablaMenu").attr("xagregar");
		if (agrego=='false'){ 
			$('#tablaMenu').append("<tr><td></td><td><input name='nombre' type='input' value=''></td><td><input name='valor' type='input' value=''></td><td><input name='idioma' type='input' value=''></tr>");
			$("#tablaMenu").attr("xagregar","true");
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaMenu").attr("xagregar");
		if (agrego=='true'){ 
			$("form:first").submit();
		}else{
			for (i = 0; i < cambios.length; i++){
				var nombre = $('#nombre-'+cambios[i]).val();
				$.ajax({
					   data: {nombre:nombre},
				       type: "POST",
				       url: "<?=base_url()?>index.php/backoffice/literales/updateLiteral/"+cambios[i],
				       success: function(){
				    	   showInfo('Los cambios se guardaron con exito!','info');
				    	   cambios = [];
					   },
					   error: function(){
						   showInfo('ERROR : Verifique los campos ingresados','error');
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
			       url: "<?=base_url()?>index.php/backoffice/literales/delLiteral/"+elem,
                               success: function(){
                                   showInfo('El literal se elimino con exito','info');
                               }
			});
		});
 		$(":checked").parent().parent().remove();
	});

	$('.formulario').blur(function(){
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
<?php echo form_open('backoffice/literales/addLiteral'); ?>
<div class="page-header">
    <h2>Literales</h2>
</div>
<div class="row">
    <div class="btn-group">
        <button type="button" id="agregar" class="btn btn-success">Agregar</button>
        <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
        <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
    </div>
        
            
            
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" id="tablaMenu" xagregar="false">
                <thead>
                  <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Nombre<i class=""></i></th>
                    <th class="header">Valor<i class=""></i></th>
                    <th class="header">Idioma<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
				<?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>                  
                <tr>
                  <td><input type="checkbox" id="<?php print_r($item->idLiteral);?>" class="fila" ></td>
                  <td><input class="formulario" id="nombre-<?php print_r($item->idLiteral);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre);?>'/></td>
                  <td><input class="formulario" id="valor-<?php print_r($item->idLiteral);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->valor);?>'/></td>
                  <td><input class="formulario" id="valor-<?php print_r($item->idLiteral);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->idioma);?>'/></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          
        

        

        

      </div>