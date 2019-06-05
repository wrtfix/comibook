<script>
cambios=[];
guardar=[];
remitos=[];




$(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy', onSelect: function(dateText, inst) { 
        var dateAsString = dateText; //the first parameter of this function
        var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
        var $aux = $("form:first")
        $aux.attr('action',"<?=base_url()?>index.php/pedidos/index/"+dateAsString);
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
	
	$("#titulo").append("Pedidos del " + fecha);

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
                var sendData = [];
		for (i = 0; i < guardar.length; i++)
		{
			var ClienteOrigen = $('#saveClienteOrigen-'+guardar[i]).val();
			var Bultos = $('#saveBultos-'+guardar[i]).val();
			var ClienteDestino = $('#saveClienteDestino-'+guardar[i]).val();
			var valorDeclarado = $('#savevalorDeclarado-'+guardar[i]).val();
			var Contrareembolso = $('#saveContrareembolso-'+guardar[i]).val();
			var CostoFlete = $('#saveCostoFlete-'+guardar[i]).val();
			var Pago = $('#savePago-'+guardar[i]).val();
			var Observaciones = $('#saveObservaciones-'+guardar[i]).val();
			sendData.push({fecha:fecha,ClienteOrigen:ClienteOrigen,Bultos:Bultos,ClienteDestino:ClienteDestino,valorDeclarado:valorDeclarado,Contrareembolso:Contrareembolso,CostoFlete:CostoFlete,Pago:Pago,Observaciones:Observaciones});
		}
                if (sendData.length>0){
                $.ajax({
                               data: {newData: sendData},
			       type: "POST",
			       url: "<?=base_url()?>index.php/pedidos/addPedido/",
			       success: function(){
			    	   alert('Los nuevos elementos se guardaron satisfactoriamente');
                                   guardar=[];
				},
				error: function(){
                                    console.log('ERROR : Verifique los campos ingresados');
				}
				       
			});
                        }
		
                
		for (i = 0; i < cambios.length; i++)
		{
			var ClienteOrigen = $('#ClienteOrigen-'+cambios[i]).val();
			var Bultos = $('#Bultos-'+cambios[i]).val();
			var ClienteDestino = $('#ClienteDestino-'+cambios[i]).val();
			var valorDeclarado = $('#valorDeclarado-'+cambios[i]).val();
			var Contrareembolso = $('#Contrareembolso-'+cambios[i]).val();
			var CostoFlete = $('#CostoFlete-'+cambios[i]).val();
			var Pago = $('#Pago-'+cambios[i]).val();
			var Observaciones = $('#Observaciones-'+cambios[i]).val();
                        var Numero = cambios[i];
			sendDataUpdate.push({fecha:fecha,ClienteOrigen:ClienteOrigen,Bultos:Bultos,ClienteDestino:ClienteDestino,valorDeclarado:valorDeclarado,Contrareembolso:Contrareembolso,CostoFlete:CostoFlete,Pago:Pago,Observaciones:Observaciones,Numero:Numero});
		}
                if (sendDataUpdate.length>0){
                $.ajax({
                               data: {updateData:sendDataUpdate},
			       type: "POST",
			       url: "<?=base_url()?>index.php/pedidos/updatePedido/",
			       success: function(){
			    	   alert('Los cambios se guardaron satisfactoriamente');
                                   cambios=[];
                                },
                                error: function(){
                                        alert('ERROR : Verifique los campos ingresados');
                                }
			       
			});
                }
		
	});
	$('.pago').click(function(){
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
		    		if (response !='')
						$(donde).val(response[0].Nombre);
		       }
		});
	});
	$('.suma').focusout(function(){
		var elem = $("#"+$(this).attr('id')).val();
		var donde = "#"+$(this).attr('id');
		$("#calcularTotal").val(parseFloat($("#calcularTotal").val())+parseFloat(elem));
		
	});

	$('#eliminar').click(function(){
                var removeElem = [];
		$('input:checked').each(function() {
		    var elem = $(this).attr('id');
		    var id = $("#identificador").val();
                    removeElem.push({Numero:elem});
		});
                if (removeElem.length>0){
                    $.ajax({
                               data: {removeElem:removeElem},
			       type: "POST",
			       url: "<?=base_url()?>index.php/pedidos/delPedido/",
                               success: function(){
                                   alert('Los elementos fuero eliminados correctamente');
                                    location.reload();	
                               }
                               
			});
                    $("input:checkbox:checked").parent().parent().remove();
                    
                }
	});
         $("#addComment").click(function(){
            $("#comentario").show();
        });
        $("#guardarComentario").click(function(){
                var comentario = $("#comentarioText").val();
            	$('input:checked').each(function() {
		    var elem = $(this).attr('id');
                    
		    var id = $("#identificador").val();
                    $.ajax({
                        data: {comentarios:comentario},
                        type: "POST",
                        url: "<?=base_url()?>index.php/pedidos/addComentario/"+elem
                    });
		});
                $("#comentario").hide();
        });
        $("#cancelarComentario").click(function(){
            $("#comentario").hide();
        });
        
        $("#impresion").click(function(){
            $('input:checked').each(function() {
		    var elem = $(this).attr('id');
                    remitos.push(elem);
                });
            $("#remitosIds").val(remitos);
            var $aux = $("form:first");
            $aux.attr('action',"<?=base_url()?>index.php/pedidos/generarPDF/"+fecha);
            $aux.submit();
        });
        
        $("#planilla").click(function(){
            $('input:checked').each(function() {
		    var elem = $(this).attr('id');
                    remitos.push(elem);
                });
            $("#remitosIds").val(remitos);
            var $aux = $("form:first");
            $aux.attr('action',"<?=base_url()?>index.php/pedidos/generarPlanilla/"+fecha);
            $aux.submit();
        });
        
        $("#comentario").hide();
       
});

</script>
<?php if (validation_errors()){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo validation_errors(); ?>
</div>
<?php }?>
<?php echo form_open('pedidos/addPedido'); ?>
<input name="remitosIds" id="remitosIds" value="" style='width: 100%; border:none;' type='hidden' />
<div class="row">
	<h2><div id="titulo"></div></h2>
	<div id="datepicker"></div>
	<br>
	<div id="row" class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4"></div>

	</div>
	
	<br>
        <div id="comentario">
            <p> <b>Descripcion: </b></p>
            <textarea id="comentarioText" maxlength="72"></textarea>
            <br><br>
            <button type="button" id="cancelarComentario" class="btn btn-danger">Cancelar</button>
            <button type="button" id="guardarComentario" class="btn btn-primary">Guardar descipcion</button>
        </div>
        <br>
	<!--  <button type="button" id="agregar" class="btn btn-success">Agregar</button>-->
	<button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
	<button type="button" id="guardar" class="btn btn-primary">Guardar</button>
        <a id="impresion" class="btn btn-success">Generar remitos</a>
        <button type="button" id="addComment" class="btn btn-info">Describir remitos</button>
        <button type="button" id="planilla" class="btn btn-warning">Generar planilla</button>
        
	
	<?php function mostrarTotal($total){ echo "En Caja: $<input type='text' disabled id='calcularTotal' value='".number_format($total,2)."'/>"; } ?>
	<dir id="pedidos"></dir>
	<div class="table-responsive" id="pedidos">
		<table class="table table-bordered table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Selec.<i class=""></i></th>
					<th class="header">Cliente <br> Origen<i class=""></i></th>
					<th class="header headerSortDown" width="50px">Bultos<i class=""></i></th>
					<th class="header">Cliente <br> Destino<i class=""></i></th>
					<th class="header"  width="50px">Valor <br> Declarado<i class=""></i></th>
					<th class="header">Contrare.<i class=""></i></th>
					<th class="header">Costo <br> de Flete<i class=""></i></th>
					<th class="header">Pago?<i class=""></i></th>
					<th class="header">Observaciones<i class=""></i></th>
				</tr>
			</thead>
			<tbody>

				<?php $cont=0; $total=0; foreach($agregados as $item): $cont=$cont+1;?>
				<tr>
					<td><input type="checkbox" class="selec" id="<?php print_r($item->Numero);?>" value=""></td>
					<td><input class="formulario tab" id="ClienteOrigen-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ClienteOrignen);?>'/></td>
					<td width="50px"><input class="formulario" id="Bultos-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Bultos);?>'/></td>
					<td><input class="formulario tab" id="ClienteDestino-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ClienteDestino);?>'/></td>
					<td width="50px"><input class="formulario" id="valorDeclarado-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->valorDeclarado);?>'/></td>
					<td>
					<!-- <input class="formulario" id="Contrareembolso-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ContraReembolso);?>'/>-->
						<select class="pago" id="Contrareembolso-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' >
	  							<option value="0" <?php if ($item->ContraReembolso==0) echo "selected"; ?>>No</option>
	  							<option value="1" <?php if ($item->ContraReembolso==1) echo "selected"; ?>>Si</option>
	  					</select>
					</td>
					<td><input class="formulario suma" id="CostoFlete-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php $total = $item->CostoFlete + $total; print_r($item->CostoFlete);?>'/></td>
					<td>
						<select class="pago" id="Pago-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' >
	  							<option value="0" <?php if ($item->Pago==0) echo "selected"; ?>>No</option>
	  							<option value="1" <?php if ($item->Pago==1) echo "selected"; ?>>Si</option>
	  					</select>
					</td>
					<td><input class="formulario" id="Observaciones-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Observaciones);?>'/></td>
				</tr>
				<?php endforeach; mostrarTotal($total); ?>
				<?php for ($i = 0; $i < 100; $i++) {?>
				<tr>
					<td><input type="checkbox" class="selec" value=""></td>
					<td><input class="guardar tab" id="saveClienteOrigen-<?php echo $i;?>" style='width: 100%; border:none;' type='text' /></td>
					<td width="50px" ><input class="guardar" id="saveBultos-<?php echo $i;?>" style='width: 50px; border:none;' type='text' /></td>
					<td><input class="guardar tab" id="saveClienteDestino-<?php echo $i;?>" style='width: 100%; border:none;' type='text' /></td>
					<td width="50px" ><input class="guardar" id="savevalorDeclarado-<?php echo $i;?>" style='width: 50px; border:none;' type='text' /></td>
					<td>
					<!-- <input class="guardar" id="saveContrareembolso-<?php echo $i;?>" style='width: 100%; border:none;' type='text' />-->
					<select class="guardar" id="saveContrareembolso-<?php echo $i;?>" style='width: 100%; border:none;' >
  							<option value="0">No</option>
  							<option value="1">Si</option>
  					</select>
					</td>
					<td width="50px"><input class="guardar suma" id="saveCostoFlete-<?php echo $i;?>" style='width: 50px; border:none;' type='text' /></td>
					<td>
					<!--  <input class="guardar" id="savePago-<?php echo $i;?>" style='width: 100%; border:none;' type='text' />-->
					<select class="guardar" id="savePago-<?php echo $i;?>" style='width: 100%; border:none;' >
  							<option value="0">No</option>
  							<option value="1">Si</option>
  					</select>
					
					</td>
					<td><input class="guardar" id="saveObservaciones-<?php echo $i;?>" style='width: 100%; border:none;' type='text' /></td>
				</tr>
                                
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
