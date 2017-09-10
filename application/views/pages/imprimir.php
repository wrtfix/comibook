<script>
$(document).ready(function(){
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
		nombre = nombre.replace(".", "");
		$aux.attr('action',"<?=base_url()?>index.php/imprimir/index/"+nombre+"/"+fechaDesde+"/"+fechaHasta);
		$aux.submit();
	});

	var url = '<?=base_url()?>index.php/imprimir/generarPDF/<?php echo $nombre ?>/<?php echo $fechaDesde ?>/<?php echo $fechaHasta ?>';
	$("#impresion").attr('href',url);
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
$(function() {
    $( "#desde" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#hasta" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
</script>
<?php echo form_open('imprimir/addCheques'); ?>
<div class="row">


	<h2>Impresión</h2>
	<div id="datepicker"></div>
	<div class="row">
		<div class="col-lg-4">
			<div class="checkbox">
				<label> Fecha desde <input id="desde" class=""> </label>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="checkbox">
				<label> Fecha hasta <input id="hasta" class=""> </label>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="checkbox">
				<label> Nombre <input id="nombreBusqueda" class="tab"> </label>
			</div>
		</div>
	</div>

	<button type="button" id="buscar" class="btn btn-default">Buscar</button>
	<a href="<?=base_url()?>index.php/imprimir/generarPDF/"  id="impresion" class="btn btn-primary">Imprimir</a>
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
					<th class="header">Costo de Flete<i class=""></i></th>
					<th class="header">Contrareembolso<i class=""></i></th>
					<th class="header">Pago?<i class=""></i></th>
					<th class="header">Observaciones<i class=""></i></th>
				</tr>
			</thead>
			<tbody>
			<?php $total =0; $cont=0; foreach($agregados as $item): $cont=$cont+1;?>
				<tr>
					<td><?php print_r($item->Fecha);?></td>
					<td><?php print_r($item->ClienteOrignen);?></td>
					<td><?php print_r($item->Bultos);?></td>
					<td><?php print_r($item->ClienteDestino);?></td>
					<td><?php print_r($item->valorDeclarado);?></td>
					<td><?php print_r($item->CostoFlete); $total=$total+$item->CostoFlete?>
					</td>
					<td><?php print_r($item->ContraReembolso); ?></td>
					<td><?php if ($item->Pago ==0) echo 'No'; else echo 'Si';?></td>
					<td><?php print_r($item->Observaciones);?></td>
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
