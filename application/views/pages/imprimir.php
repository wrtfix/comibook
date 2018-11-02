<script>
cambios=[];

$(document).ready(function(){

	$('.formulario').keypress(function(){
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
		       		console.log(response[0]);
		    		$(donde).val(response[0].Nombre);
		       }
		});
	});

	$('#guardar').click(function(){
		for (i = 0; i < cambios.length; i++)
		{
			var fecha = $('#Fecha-'+cambios[i]).val().split("-");
			fecha=fecha[2]+'-'+fecha[1]+'-'+fecha[0];
			var ClienteOrigen = $('#ClienteOrigen-'+cambios[i]).val();
			var Bultos = $('#Bultos-'+cambios[i]).val();
			var ClienteDestino = $('#ClienteDestino-'+cambios[i]).val();
			var valorDeclarado = $('#valorDeclarado-'+cambios[i]).val();
			var Contrareembolso = $('#Contrareembolso-'+cambios[i]).val();
			var CostoFlete = $('#CostoFlete-'+cambios[i]).val();
			var Pago = $('#Pago-'+cambios[i]).val();
			var Observaciones = $('#Observaciones-'+cambios[i]).val();
			$.ajax({
				   data: {fecha:fecha,ClienteOrigen:ClienteOrigen,Bultos:Bultos,ClienteDestino:ClienteDestino,valorDeclarado:valorDeclarado,Contrareembolso:Contrareembolso,CostoFlete:CostoFlete,Pago:Pago,Observaciones:Observaciones},
			       type: "POST",
			       url: "<?=base_url()?>index.php/pedidos/updatePedido/"+cambios[i],
			       success: function(){
			    	   cambios = [];
				   },
				   error: function(){
					   alert('ERROR : Verifique los campos ingresados');
				   }
			       
			});
		}
		alert('Los cambios se guardaron satisfactoriamente');
	});
        $("#impresion").click(function(){
            var $aux = $("form:first")
            $aux.attr('action',"<?=base_url()?>index.php/imprimir/generarPDF/");
            $aux.submit();
        });
	$('.pago').click(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
	});
	
});
$(function() {
    $( "#desde" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#hasta" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
</script>
<?php echo form_open('imprimir/index'); ?>
<div class="row">


	<h2>Impresión</h2>
	<div id="datepicker"></div>
	<div class="row">
		<div class="col-lg-4">
			<div class="checkbox">
				<label> Fecha desde <input name="desde" id="desde" class=""> </label>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="checkbox">
				<label> Fecha hasta <input name="hasta" id="hasta" class=""> </label>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="checkbox">
				<label> Nombre <input name="nombreBusqueda" id="nombreBusqueda" class="tab"> </label>
			</div>
		</div>
	</div>

        <button type="submit" id="buscar" class="btn btn-default">Buscar</button>
	<a id="impresion" class="btn btn-primary">Imprimir</a>
	<button type="button" id="guardar" class="btn btn-danger">Guardar</button>
	<br> <br>
	<div class="table-responsive">
		<table class="table table-bordered table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Fecha<i class=""></i></th>
					<th class="header">Cliente Origen<i class=""></i></th>
					<th class="header headerSortDown">Bultos<i class=""></i></th>
					<th class="header">Cliente Destino<i class=""></i></th>
					<th class="header">Valor declarado<i class=""></i></th>
					<th class="header">Contrareembolso<i class=""></i></th>
					<th class="header">Costo de Flete<i class=""></i></th>
					<th class="header">Pago?<i class=""></i></th>
					<th class="header">Observaciones<i class=""></i></th>
				</tr>
			</thead>
			<tbody>
			<?php $total =0; $cont=0; foreach($agregados as $item): $cont=$cont+1;?>
				<tr>

					<td>
<input class="formulario tab" id="Fecha-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Fecha);?>'/></td>
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
					<td><input class="formulario suma" id="CostoFlete-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php $total=$item->CostoFlete+$total; print_r($item->CostoFlete);?>'/></td>
					<td>
						<select class="pago" id="Pago-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' >
	  							<option value="0" <?php if ($item->Pago==0) echo "selected"; ?>>No</option>
	  							<option value="1" <?php if ($item->Pago==1) echo "selected"; ?>>Si</option>
	  					</select>
					</td>
					<td><input class="formulario" id="Observaciones-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Observaciones);?>'/></td>

				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>

<p>
	Saldo en mano:
	<?php echo $total; ?>
</p>
<p>
	Saldo en cheques:
	<?php if ($cheque!=null) {if ($cheque[0]->importe!="") echo $cheque[0]->importe; else echo 0;} else echo "0" ?>
</p>
<p>
	Gastos:
	<?php if ($gasto!=null) {if ($gasto[0]->importe!="") echo $gasto[0]->importe; else echo 0;}  else echo "0"?>
</p>
<p>
	Total:
	<?php if ($gasto!=null) {if ($gasto[0]->importe!="") echo $total-$gasto[0]->importe; else echo $total;}  else echo "0"?>
</p>


</div>
