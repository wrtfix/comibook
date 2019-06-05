<script>
cambios=[];
$(document).ready(function(){
	$('#agregar').click(function(){
		var agrego = $("#tablaCheques").attr("xagregar");
		if (agrego=='false'){
			$('#tablaCheques').append("<tr><td></td><td><input name='fecha' id='fecha' type='input' value=''></td><td><input name='banco' type='input' value=''></td><td><input name='origen' id='origen' class='tab' type='input' value=''></td><td><input name='importe' type='input' value=''></td><td><input name='vencimiento' id='fechavto' type='input' value=''></td><td><input class='tab' id='destino' name='destino' type='input' value=''></td></tr>");
			$("#tablaCheques").attr("xagregar","true");
			$("#fecha").datepicker({ dateFormat: 'dd-mm-yy' });
			$("#fechavto").datepicker({ dateFormat: 'dd-mm-yy' });
			$('.tab').focusout(function(){
				var elem = $("#"+$(this).attr('id')).val();
				var donde = "#"+$(this).attr('id');
				console.log(elem+" "+donde);
				$.ajax({
				       type: "POST",
				       url: "<?=base_url()?>index.php/cheques/getCliente/"+elem,
				       dataType:'json',
				       success: function(response){
				    		$(donde).val(response[0].Nombre);
				       }
				});
			});
					
			
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaCheques").attr("xagregar");
		
		if (agrego=='true'){ 
			$("form:first").submit();
		}else{
			for (i = 0; i < cambios.length; i++){
				var nombre = $('#banco-'+cambios[i]).val();
				var fecha = $('#fecha-'+cambios[i]).val();
				var importe = $('#importe-'+cambios[i]).val();
				var proviene = $('#proviene-'+cambios[i]).val();
				var fechavto = $('#fechavto-'+cambios[i]).val();
				var entregado = $('#entregado-'+cambios[i]).val();
				$.ajax({
					   data: {banco:nombre,fecha:fecha,importe:importe,proviene:proviene,fechavto:fechavto,entregado:entregado},
				       type: "POST",
				       url: "<?=base_url()?>index.php/cheques/updateCheque/"+cambios[i],
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
			       url: "<?=base_url()?>index.php/cheques/delCheque/"+elem
			});
		});
 		$(":checked").parent().parent().remove();
	});

	$('.formulario').keypress(function(event){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
	});

	$('.tab').focusout(function(){
		var elem = $("#"+$(this).attr('id')).val();
		var donde = "#"+$(this).attr('id');
		$.ajax({
		       type: "POST",
		       url: "<?=base_url()?>index.php/cheques/getCliente/"+elem,
		       dataType:'json',
		       success: function(response){
		    		$(donde).val(response[0].Nombre);
		       }
		});
	});
	
	$('#buscar').click(function(){
		var $aux = $("form:first");
		var nombre = $('#nombreBusqueda').val();
		var fechaDesde = $('#desde').val();
		var fechaHasta = $('#hasta').val();
		if (fechaDesde==''){
			fechaDesde = 'null';
		}
		if (fechaHasta==''){
			fechaHasta = 'null';
		}
		if (nombre==''){
			nombre = 'null';
		}
		$aux.attr('action',"<?=base_url()?>index.php/cheques/index/"+nombre+"/"+fechaDesde+"/"+fechaHasta);
		$aux.submit();
	});
	$(".fechaInput").datepicker({ dateFormat: 'dd-mm-yy' });
});

$(function() {
    $( "#desde" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#hasta" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
</script>

<?php if (validation_errors()){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo validation_errors(); ?>
</div>
<?php }?>

<?php echo form_open('cheques/addCheques'); ?>
<div class="row">
                 <h2>Cheques</h2>
  
  <div class="row">
          <div class="col-lg-4">
            <div class="checkbox">
                  <label>
                    Fecha desde <input id="desde" class="">
                  </label>
                </div>
</div>
<div class="col-lg-4">
  <div class="checkbox">
                  <label>
                    Fecha hasta <input id="hasta"class="">
                  </label>
                </div>
          </div>
  <div class="col-lg-4">
<div class="checkbox">
                  <label>
                    De donde proviene <input id="nombreBusqueda" class="">
                  </label>
              </div>
</div>
        </div>
            <button type="button" id="buscar" class="btn btn-default">Buscar</button>
            <button type="button" id="agregar" class="btn btn-success">Agregar</button>
            <button type="button" id="eliminar"class="btn btn-danger">Eliminar</button>
            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" id="tablaCheques" xagregar="false">
                <thead>
                  <tr>
                    <th class="header">Eliminar<i class=""></i></th>                    
                    <th class="header">Fecha<i class=""></i></th>
  					<th class="header">Banco<i class=""></i></th>
                    <th class="header headerSortDown">De donde proviene<i class=""></i></th>
                    <th class="header">Importe<i class=""></i></th>
                    <th class="header">Vencimiento<i class=""></i></th>
  					<th class="header">A quien fue entregado<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
				<?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>
                <tr>
                  <td><input type="checkbox" id="<?php print_r($item->id);?>" class="fila tab"></td>
                  <td><input class="formulario" id="fecha-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php list($dia, $mes, $ano) = explode("-", $item->fecha); echo $ano."-".$mes."-".$dia;?>'/></td>                  
  				  <td><input class="formulario" id="banco-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->banco);?>'/></td>
                  <td><input class="formulario tab" id="proviene-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->proviene);?>'/></td>
                  <td><input class="formulario" id="importe-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->importe);?>'/></td>
                  <td><input class="formulario" id="fechavto-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php list($dia, $mes, $ano) = explode("-", $item->fechavto); echo $ano."-".$mes."-".$dia;?>'/></td>
                  <td><input class="formulario tab" id="entregado-<?php print_r($item->id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->entregado);?>'/></td>
                  </tr>
                  <?php endforeach; ?>
				</tbody>
              </table>
            </div>
          </div>
          

      </div>