<script>
cambios=[];
guardar=[];
remitos=[];




$(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy', onSelect: function(dateText, inst) { 
        var dateAsString = dateText; //the first parameter of this function
        var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
        var $aux = $("form:first")
        $aux.attr('action',"<?=base_url()?>index.php/solicitudes/index/"+dateAsString);
        $aux.submit();
     } });
    
  });
$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }    
});

 

$(document).ready(function(){
	var fecha= '<?php if ($fechaSeleccionada!=null)echo $fechaSeleccionada?>';
	if (fecha==''){
		fecha = $("#datepicker").val();
	}
	
	$("#titulo").append("Solicitudes para " + fecha);

	$('.formulario').keypress(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
	});
	
	$('.guardar').keypress(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), guardar )==-1){
			guardar.push(($(this).attr('id').split('-')[1]));
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaCliente").attr("xagregar");
		for (i = 0; i < guardar.length; i++)
		{
			var cantidad = $('#cantidad-'+guardar[i]).val();
			var producto = $('#producto-'+guardar[i]).val();
			$.ajax({
				   data: {fecha:fecha,cantidad:cantidad, idProducto:producto},
			       type: "POST",
			       url: "<?=base_url()?>index.php/solicitud/addSolicitud/",
			       success: function(){
			    	   $("#resultado").html("Los cambios se guardaron con exito");
				   },
				   error: function(){
						console.log('ERROR : Verifique los campos ingresados');
				   }
				       
			});
		}
		guardar=[];
		for (i = 0; i < cambios.length; i++)
		{
			var cantidad = $('#cantidad-'+cambios[i]).val();
			var producto = $('#producto-'+cambios[i]).val();
			$.ajax({
				   data: {fecha:fecha,cantidad:cantidad, idProducto:producto},
			       type: "POST",
			       url: "<?=base_url()?>index.php/solicitud/updateSolicitud/"+cambios[i],
			       success: function(){
			    	   cambios = [];
				   },
				   error: function(){
					   alert('ERROR : Verifique los campos ingresados');
				   }
			       
			});
		}
		alert('Los cambios se guardaron satisfactoriamente');
		cambios=[];
	});
	$('.pago').click(function(){
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
<?php echo form_open('solicitud/addSolicitud'); ?>
<input name="remitosIds" id="remitosIds" value="" style='width: 100%; border:none;' type='hidden' />
<div class="row">
	<h2><div id="titulo"></div></h2>
	<div id="datepicker"></div>
	<br>
	<div id="row" class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4"></div>

	</div>
	
	<button type="button" id="guardar" class="btn btn-primary">Guardar</button>
	
	<dir id="pedidos"></dir>
	<div class="table-responsive" id="pedidos">
		<table class="table table-bordered table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Producto<i class=""></i></th>
					<th class="header headerSortDown" width="50px">Cantidad Requerida<i class=""></i></th>
					<th class="header">Precio unitario<i class=""></i></th>
                                        <th class="header">Peso<i class=""></i></th>
				</tr>
			</thead>
			<tbody>

				<?php $cont=0; $total=0; foreach($productos as $item): $cont=$cont+1;?>
				<tr>
                                    <td><input class="formulario" id="producto-<?php print_r($item->idProducto);?>" type='hidden' value='<?php print_r($item->idProducto);?>' /> <input class="formulario" id="nombre-<?php print_r($item->numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre);?>' disabled="true"/></td>
					<td width="50px"><input class="formulario" id="cantidad-<?php print_r($item->numero);?>" style='width: 100%; border:none;' type='text' value='0'/></td>
					<td width="50px"><input class="formulario" id="precio-<?php print_r($item->numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->precio);?>' disabled="true"/></td>	
                                        <td width="50px"><input class="formulario" id="peso-<?php print_r($item->numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->peso);?>' disabled="true"/></td>	
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
        
</div>
