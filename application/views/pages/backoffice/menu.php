<script>
cambios=[];
$(document).ready(function(){
	$('#agregar').click(function(){
		var agrego = $("#tablaMenu").attr("xagregar");
		if (agrego=='false'){ 
			$('#tablaMenu').append("<tr><td></td><td><input  name='grupo' id='grupo' type='input' value=''></td><td><input name='nombre' type='input' value=''></td><td><input name='peso' type='input' value=''></td></tr>");
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
				var grupo = $('#grupo-'+cambios[i]).val();
				var peso = $('#peso-'+cambios[i]).val();
				$.ajax({
					   data: {nombre:nombre,grupo:grupo,peso:peso},
				       type: "POST",
				       url: "<?=base_url()?>index.php/backoffice/menu/updateMenu/"+cambios[i],
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
			       url: "<?=base_url()?>index.php/backoffice/menu/delMenu/"+elem
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
<?php echo form_open('backoffice/menu/addMenu'); ?>
<div class="page-header">
    <h2>Menu</h2>
</div>
<div class="row">
                
            <button type="button" id="agregar" class="btn btn-success">Agregar</button>
            <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
            
            
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" id="tablaMenu" xagregar="false">
                <thead>
                  <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Grupo<i class=""></i></th>
  					<th class="header">Nombre<i class=""></i></th>
                    <th class="header headerSortDown">Peso<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
				<?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>                  
                <tr>
                  <td><input type="checkbox" id="<?php print_r($item->idMenu);?>" class="fila" ></td>
                  <td><input class="formulario" id="grupo-<?php print_r($item->idMenu);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->grupo);?>'/></td>
                  <td><input class="formulario" id="nombre-<?php print_r($item->idMenu);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre);?>'/></td>
                  <td><input class="formulario" id="peso-<?php print_r($item->idMenu);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->peso);?>'/></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          
        

        

        

      </div>