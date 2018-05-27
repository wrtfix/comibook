<script>
cambios=[];
guardar=[];

 $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy', onSelect: function(dateText, inst) { 
            var dateAsString = dateText; //the first parameter of this function
            var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
            var $aux = $("form:first")
            $aux.attr('action',"<?=base_url()?>index.php/pedidos/index/"+dateAsString);
            $aux.submit();
         } });

      });


$(document).ready(function(){
    
       

	var fecha= '<?php if ($fechaSeleccionada!=null) echo $fechaSeleccionada; ?>';
	if (fecha==''){
		fecha = $("#datepicker").val();
	}
	
	$("#titulo").append("Noticias del " + fecha);

	$('.formulario').blur(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
	});
	
	$('.guardar').blur(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), guardar )==-1){
			guardar.push(($(this).attr('id').split('-')[1]));
		}
	});
	$('#contenido').click(function(){
	    var idNoticia = $('input:checked:first').attr('id');
            if (idNoticia != undefined){
                var $aux = $("form:first")
                $aux.attr('action',"<?=base_url()?>index.php/contenidos/index/"+idNoticia);
                $aux.submit();
            }else{
                alert("No es posible cargar el contenido de esta noticia sin haberla guardado previamente");
                if (guardar.length===0){
                    location.reload();
                }
            }
	});
        
        $('#agregar').click(function(){
		var agrego = $("#pedidos").attr("xagregar");
		if (agrego=='false'){ 
			$('#pedidos').append("<tr><td></td><td style='display: none;'><input name='fecha' id='fecha' type='input' value='"+fecha+"'></td><td><input name='ClienteOrigen' type='input' value=''></td><td><input name='Bultos' type='input' value=''></td><td><input name='ClienteDestino' type='input' value=''></td><td><input name='valorDeclarado' type='input' value=''></td><td style='display: none;'></td><td><input name='CostoFlete' type='input' value=''></td><td style='display: none;'></td><td><input name='Observaciones' type='input' value=''></td></tr>");
			$("#pedidos").attr("xagregar","true");
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#pedidos").attr("xagregar");
                if (agrego=='true'){ 
			$("form:first").submit();
		}else{
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
                            $.ajax({
                                       data: {fecha:fecha,ClienteOrigen:ClienteOrigen,Bultos:Bultos,ClienteDestino:ClienteDestino,valorDeclarado:valorDeclarado,Contrareembolso:Contrareembolso,CostoFlete:CostoFlete,Pago:Pago,Observaciones:Observaciones},
                                   type: "POST",
                                   url: "<?=base_url()?>index.php/pedidos/updatePedido/"+cambios[i],
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
	$('.pago').click(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), cambios )==-1){
			cambios.push(($(this).attr('id').split('-')[1]));
		}
	});

	$('#eliminar').click(function(){
            var txt;
            var r = confirm("Desea eliminar el contenido de esta noticia?");
            if (r == true) {
                $('input:checked').each(function() {
                                var elem = $(this).attr('id');
                                var id = $("#identificador").val();
                                    $.ajax({
                                           type: "POST",
                                           url: "<?=base_url()?>index.php/pedidos/delPedido/"+elem
                                    });
                            });
                            $("input:checkbox:checked").parent().parent().remove();
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
<?php echo form_open('pedidos/addPedido'); ?>
<div class="page-header">
    <h3><div id="titulo"></div></h3>
</div>
<div class="row">


	
	<div id="datepicker"></div>
	<br>
	<div id="row" class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4"></div>
	</div>


        <button type="button" id="agregar" class="btn btn-success">Agregar</button>
	<button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
	<button type="button" id="contenido" class="btn btn-warning">Contenido</button>
	<button type="button" id="guardar" class="btn btn-primary">Guardar</button>
	<br> <br>
	<dir ></dir>
	<div class="table-responsive" >
		<table class="table table-bordered table-hover tablesorter" id="pedidos" xagregar="false">
			<thead>
				<tr>
					<th class="header">Seleccionar<i class=""></i></th>
					<th class="header">Titulo<i class=""></i></th>
					<th class="header headerSortDown">Visitas<i class=""></i></th>
					<th class="header">Resumen<i class=""></i></th>
					<th class="header">Likes<i class=""></i></th>
					<th class="header" style="display: none;">Contrareembolso<i class=""></i></th>
					<th class="header">UnLikes<i class=""></i></th>
					<th class="header" style="display: none;">Pago?<i class=""></i></th>
					<th class="header">Imagen<i class=""></i></th>
				</tr>
			</thead>
			<tbody>

				<?php $cont=0; foreach($agregados as $item): $cont++;?>
				<tr>
					<td><input type="checkbox" class="selec" id="<?php print_r($item->Numero);?>" value=""></td>
					<td><input class="formulario tab" id="ClienteOrigen-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ClienteOrignen);?>'/></td>
					<td><input class="formulario" id="Bultos-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->Bultos);?>'/></td>
					<td><input class="formulario tab" id="ClienteDestino-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ClienteDestino);?>'/></td>
					<td><input class="formulario" id="valorDeclarado-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->valorDeclarado);?>'/></td>
					<td style="display: none;">
					<!-- <input class="formulario" id="Contrareembolso-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ContraReembolso);?>'/>-->
						<select class="pago" id="Contrareembolso-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' >
	  							<option value="0" <?php if ($item->ContraReembolso==0) echo "selected"; ?>>No</option>
	  							<option value="1" <?php if ($item->ContraReembolso==1) echo "selected"; ?>>Si</option>
	  					</select>
					</td>
					<td><input class="formulario" id="CostoFlete-<?php print_r($item->Numero);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->CostoFlete);?>'/></td>
					<td style="display: none;">
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



