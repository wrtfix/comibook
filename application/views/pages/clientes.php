<script>
cambios=[];
function buscarAFIP(){
    var elem= 'https://afip.tangofactura.com/Index/GetCuitsPorDocumento/?NumeroDocumento='+$("#numeroAFIP").val();
    $.ajax({
            type: "GET",
            url: elem,
            dataType:'json',
            success: function(response){
                    var url = 'https://afip.tangofactura.com/Index/GetContribuyente/?cuit='+response.data[0];
                    $("#numeroAFIP").val(response.data[0]);
                    $.ajax({
                            type: "GET",
                            url: url,
                            dataType:'json',
                            success: function(response){
                                    console.log(response.Contribuyente);
                                    $('#nombreAFIP').val(response.Contribuyente.nombre);
                                    $('#domicilioAFIP').val(response.Contribuyente.domicilioFiscal.direccion);
                                    $('#localidadAFIP').val(response.Contribuyente.domicilioFiscal.localidad);
                            }
                     });
            }
     });
    
}

$(document).ready(function(){
	$('#agregar').click(function(){
		var agrego = $("#tablaCliente").attr("xagregar");
		if (agrego=='false'){ 
			$('#tablaCliente').append("<tr><td></td><td> <select id='documento'> <option value='cuil'>CUIL/CUIT</option> <option value='dni' selected>DNI</option> </select> <input name='cuit' id='numeroAFIP' type='input' value=''> <button type='button' onclick='buscarAFIP()' class='btn btn-default'>Buscar</button>  </td><td><input name='numero' type='input' value=''></td><td><input name='nombre' id='nombreAFIP' type='input' value=''></td><td><input name='domicilio' id='domicilioAFIP' type='input' value=''></td><td><input name='telefono' type='input' value=''></td><td><input name='localidad' id='localidadAFIP' type='input' value=''></td></tr>");
			$("#tablaCliente").attr("xagregar","true");
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaCliente").attr("xagregar");
		if (agrego=='true'){ 
			$("form:first").submit();
		}else{
			for (i = 0; i < cambios.length; i++){
				var numero = $('#numero-'+cambios[i]).val();
				var nombre = $('#nombre-'+cambios[i]).val();
				var domicilio = $('#domicilio-'+cambios[i]).val();
				var localidad = $('#localidad-'+cambios[i]).val();
				var telefono = $('#telefono-'+cambios[i]).val();
				var cuit = $('#cuit-'+cambios[i]).val();
				$.ajax({
					   data: {numero:numero,nombre:nombre,domicilio:domicilio,localidad:localidad,telefono:telefono,cuit:cuit},
				       type: "POST",
				       url: "<?=base_url()?>index.php/clientes/updateCliente/"+cambios[i],
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
			       url: "<?=base_url()?>index.php/clientes/delCliente/"+elem
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
		var nombre = $('#busquedaNombre').val();
		var cuil = $('#busquedaCuil').val();
		var numero = $('#busquedaNumero').val();
		if (numero==''){
			numero = 'null';
		}
		if (cuil==''){
			cuil = 'null';
		}
		if (nombre==''){
			nombre = 'null';
		}
		nombre = nombre.replace(".", "");
		nombre = nombre.replace(")", "");
		$aux.attr('action',"<?=base_url()?>index.php/clientes/index/"+nombre+"/"+cuil+"/"+numero);
		$aux.submit();
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
	
	
});

</script>
<?php if (validation_errors()){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo validation_errors(); ?>
</div>
<?php }?>
<?php echo form_open('clientes/addCliente'); ?>
<div class='row'>


        <div class="page-header">
            <h2>Clientes</h2>
        </div>

	<div class='row'>
		<div class='col-lg-4'>
			<div class='checkbox'>
				<label> Nombre <input id='busquedaNombre' class='tab'> </label>
			</div>
		</div>
		<div class='col-lg-4'>
			<div class='checkbox'>
				<label> Cuit/Cuil <input id='busquedaCuil' class=''> </label>
			</div>
		</div>
		<div class='col-lg-4'>
			<div class='checkbox'>
				<label> Localidad <input id='busquedaNumero' class=''> </label>
			</div>
		</div>
	</div>
        <div class="btn-group">
            <button type='button' id='buscar' class='btn btn-default'>Buscar</button>
            <button type='button' id='agregar' class='btn btn-success'>Agregar</button>
            <button type='button' id="eliminar" class='btn btn-danger'>Eliminar</button>
            <button type='button' id='guardar' class='btn btn-primary'>Guardar</button>
        </div>
	
        <br> <br>
	<div class='table-responsive'>
		<table class='table table-bordered table-hover tablesorter' id='tablaCliente' xagregar="false">
			<thead>
				<tr>
					<th class='header'>Eliminar<i class=''></i></th>
                                        <th class='header'>Cuit/Cuil<i class=''></i></th>
					<th class='header'>Número<i class=''></i></th>
					<th class='header'>Nombre<i class=''></i></th>
					<th class='header headerSortDown'>Domicilio<i class=''></i></th>
					<th class='header'>Teléfono<i class=''></i></th>
					<th class='header'>Localidad<i class=''></i></th>
					
				</tr>
			</thead>
			<tbody>
				<?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>
				<tr>
					<td><input type="checkbox" id="<?php print_r($item->Id);?>" class="fila"></td>
					<td><input class="formulario" id="cuit-<?php print_r($item->Id);?>" style='width: 100%; border:none;' type='text' value='<?php echo $item->Cuit;?>'/></td>
                                        <td><input class="formulario" id="numero-<?php print_r($item->Id);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Numero);?>'/></td>
					<td><input class="formulario" id="nombre-<?php print_r($item->Id);?>" name=""style='width: 100%; border:none;' type='text' value='<?php echo $item->Nombre;?>'/></td>
					<td><input class="formulario" id="domicilio-<?php print_r($item->Id);?>" style='width: 100%; border:none;' type='text' value='<?php echo $item->Domicilio;?>'/></td>
					<td><input class="formulario" id="telefono-<?php print_r($item->Id);?>" style='width: 100%; border:none;' type='text' value='<?php echo $item->Telefono;?>'/></td>
					<td><input class="formulario" id="localidad-<?php print_r($item->Id);?>" style='width: 100%; border:none;' type='text' value='<?php echo $item->Localidad;?>'/></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

</div>
