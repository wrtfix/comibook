<script>
cambios=[];
$(document).ready(function(){
	$('#agregar').click(function(){
		var agrego = $("#tablaGastos").attr("xagregar");
		if (agrego=='false'){ 
			$('#tablaGastos').append("<tr><td></td><td style='display: none'><input  name='fecha' id='fecha' type='input' value=''></td><td><input name='nombre' type='input' value=''></td><td><input name='importe' type='input' value=''></td></tr>");
			$("#tablaGastos").attr("xagregar","true");
			$("#fecha").datepicker({ dateFormat: 'dd-mm-yy' });
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaGastos").attr("xagregar");
		
		if (agrego=='true'){ 
			$("form:first").submit();
		}else{
			for (i = 0; i < cambios.length; i++){
				var nombre = $('#nombre-'+cambios[i]).val();
				var fecha = $('#fecha-'+cambios[i]).val();
				var importe = $('#importe-'+cambios[i]).val();
				$.ajax({
					   data: {nombre:nombre,fecha:fecha,importe:importe},
				       type: "POST",
				       url: "<?=base_url()?>index.php/gastos/updateGasto/"+cambios[i],
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
			       url: "<?=base_url()?>index.php/gastos/delGasto/"+elem
			});
		});
 		$(":checked").parent().parent().remove();
	});

	$('.formulario').keypress(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
	});
	$('#buscar').click(function(){
		var $aux = $("form:first");
		var nombre = $('#nombreBusqueda').val();
		var fechaDesde = $('#fechaDesde').val();
		var fechaHasta = $('#fechaDesde').val();
		if (fechaDesde==''){
			fechaDesde = '%20';
		}
		if (fechaHasta==''){
			fechaHasta = '%20';
		}
		if (nombre==''){
			nombre = '%20';
		}
		$aux.attr('action',"<?=base_url()?>index.php/gastos/index/"+nombre+"/"+fechaDesde+"/"+fechaHasta);
		$aux.submit();
	});
	$(".fechaInput").datepicker({ dateFormat: 'dd-mm-yy' });
});

  $(function() {
    $( "#fechaDesde" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#fechaHasta" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
</script>
<?php if (validation_errors()){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo validation_errors(); ?>
</div>
<?php }?>
<?php echo form_open('gastos/addGasto'); ?>
   <div class="row">
            
              
                 <h2>Menu</h2>
  
  <!--<div class="row">
          <div class="col-lg-4">
            <div class="checkbox">
                  <label>Fecha desde <input id="fechaDesde" class="">
                  </label>
                </div>
		</div>
		<div class="col-lg-4">
		  <div class="checkbox">
                  <label>Fecha hasta <input id="fechaHasta" class="">
                  </label>
                </div>
          </div>
		  <div class="col-lg-4">
		<div class="checkbox">
                  <label>Nombre <input id="nombreBusqueda" class="">
                  </label>
              </div>
</div>
        </div>-->

            
                
            <!--<button type="button" id="buscar" class="btn btn-default">Buscar</button>-->
            <button type="button" id="agregar" class="btn btn-success">Agregar</button>
            <button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>
            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
            
            
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" id="tablaGastos" xagregar="false">
                <thead>
                  <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header" style="display: none">Fecha<i class=""></i></th>
  <th class="header">Nombre<i class=""></i></th>
                    <th class="header headerSortDown">Peso<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
				<?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>                  
                <tr>
                  <td><input type="checkbox" id="<?php print_r($item->idGasto);?>" class="fila" ></td>
                  <td style="display: none"><input class="formulario" id="fecha-<?php print_r($item->idGasto);?>" style='width: 100%; border:none;' type='text' value='<?php list($dia, $mes, $ano) = explode("-", $item->fecha); echo $ano."-".$mes."-".$dia;?>'/></td>
                  <td><input class="formulario" id="nombre-<?php print_r($item->idGasto);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre);?>'/></td>
                  <td><input class="formulario" id="importe-<?php print_r($item->idGasto);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->importe);?>'/></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          
        

        

        

      </div>