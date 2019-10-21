<script>
cambios=[];
guardar=[];
remitos=[];

$(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy', onSelect: function(dateText, inst) { 
        var dateAsString = dateText; //the first parameter of this function
        var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
        var $aux = $("form:first")
        $aux.attr('action',"<?=base_url()?>index.php/turnera/agenda/index/"+dateAsString);
        $aux.submit();
     } });
    
  });
$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }    
});

$(document).ready(function(){
        var clientes;
	var fecha= '<?php if ($fechaSeleccionada!=null)echo $fechaSeleccionada?>';
	
        if (fecha==''){
		fecha = $("#datepicker").val();
	}
	
	$("#titulo").append("Turnos del " + fecha);
	
	$('.guardar').keypress(function(){
		if (jQuery.inArray( ($(this).attr('id').split('-')[1]), guardar )==-1){
			guardar.push(($(this).attr('id').split('-')[1]));
		}
	});
	$('#guardar').click(function(){
		var agrego = $("#tablaCliente").attr("xagregar");
		for (i = 0; i < guardar.length; i++)
		{
			var horario = $('#saveHorario-'+guardar[i]).val();
			var idPaciente = $('#saveClienteValue-'+guardar[i]).val();
			var monto = $('#saveMonto-'+guardar[i]).val();
			var pago = $('#savePago-'+guardar[i]).val();
			var observaciones = $('#saveObservaciones-'+guardar[i]).val();
                        var idConsultorio = $('#idConsultorio').val();
                        var idTurno = $('#saveCliente-'+guardar[i]).attr('data-idTurno');
                        
			$.ajax({
                            data: {fecha:fecha,horario:horario,idPaciente:idPaciente,monto:monto,pago:pago,observaciones:observaciones, idConsultorio:idConsultorio, idTurno:idTurno},
			    type: "POST",
			    url: "<?=base_url()?>index.php/turnera/agenda/insertOrUpdateAgenda/",
			    success: function(){
                                showInfo("Los cambios se guardaron con exito",'info');
                            },
                            error: function(){
                                showInfo("ERROR : Verifique los campos ingresados",'error');
                            }
				       
			});
		}
		
	});
        
        $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/clientes/getClientes",
                dataType: 'json',
                success: function (response) {
                    if (response != '') {
                        clientes = response;
                    }
                }
        });
        

	$('.tab').autocomplete({
            source: function (request, response) {
                    response($.map(clientes, function (value, key) {
                         return {
                             label: value.Nombre,
                             value: value.Nombre,
                             id: value.Id
                         }
                     }));
             },
             select: function(event, ui) {
                    var donde = "#saveClienteValue-"+$(this).attr('id').split('-')[1];
                    $(donde).val(ui.item.id) 
             },
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
<?php echo form_open('tunera/agenda/index'); ?>


<input style='width: 100%; border:none;' type='hidden' name="idConsultorio" id="idConsultorio" value="<?php echo $idConsultorio ?>"/>

<div class="row">
	<h2><div id="titulo"></div></h2>
	<div id="datepicker"></div>
	<br>
	<button type="button" id="guardar" class="btn btn-primary">Guardar</button>        
	<?php function mostrarTotal($total){ echo "<p> En Caja: $<input type='text' disabled id='calcularTotal' value='".number_format($total,2)."'/> </p>"; } ?>
	<dir id="pedidos"></dir>
	<div class="table-responsive" id="pedidos">
		<table class="table table-bordered table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Selec.<i class=""></i></th>
                                        <th class="header" style="width:10%">Horario<i class=""></i></th>
					<th class="header">Paciente<i class=""></i></th>
					<th class="header">Monto</th>
					<th class="header">Pago?<i class=""></i></th>
					<th class="header">Observaciones<i class=""></i></th>
				</tr>
			</thead>
			<tbody>
                                <?php 
                                function getTurnos($turnos, $horario) {
                                    foreach($turnos as $turno):
                                        $current = strtotime( $turno->hora );
                                        if ($current == $horario){
                                            return $turno;
                                        }
                                    endforeach;
                                }
                                $i = 0;
                                if (!empty($horario)){
                                $current = strtotime( $horario[0]->horaDesde );
                                $last = strtotime( $horario[0]->horaHasta );
                                
                                $total=0; 
                                while( $current <= $last ) { 
                                    $turno = getTurnos($turnos,$current);
                                    if($turno) {
                                        $total = $total + $turno->monto;
                                    }
                                        
                                ?>
				<tr>
					<td><input type="checkbox" class="selec" value=""></td>
                                        <td><input class="guardar" id="saveHorario-<?php echo $i;?>" style='width: 100%; border:none;' type='text' value="<?php print_r(date( 'H:i:s', $current )); ?>" /></td>
					<td><input class="guardar tab" id="saveCliente-<?php echo $i;?>" style='width: 100%; border:none;' type='text' data-idTurno="<?php $turno != null ? print_r($turno->idTurno) : ''; ?>" value="<?php $turno != null ? print_r($turno->Nombre): ''; ?>"/> <input id="saveClienteValue-<?php echo $i;?>" type='hidden' value="<?php $turno != null ? print_r($turno->idPaciente) : '';  ?>" /> </td>
					<td width="50px" ><input class="guardar" id="saveMonto-<?php echo $i;?>" style='width: 50px; border:none;' type='text' value="<?php $turno != null ? print_r($turno->monto): ''; ?>" /></td>
					<td>
					<select class="guardar" id="savePago-<?php echo $i;?>" style='width: 100%; border:none;' >
  							<option value="0" <?php if ($turno != null && $turno->pago==0) echo "selected";?>>No</option>
  							<option value="1" <?php if ($turno != null && $turno->pago==1) echo "selected";?>>Si</option>
  					</select>
					
					</td>
					<td><input class="guardar" id="saveObservaciones-<?php echo $i;?>" style='width: 100%; border:none;' type='text' value="<?php $turno != null ? print_r($turno->observaciones) : ''; ?>"/></td>
				</tr>
                                
                                <?php $current = strtotime( '+'.$horario[0]->intervalo.' minute', $current ); $i = $i + 1;
                                    } 
                                } 
                                mostrarTotal($total);
                                ?>
                                
                                
			</tbody>
		</table>
            <?php if ($i==0){ ?>
            <div id="noResults" style="display: flex; justify-content: center;">
                <p>
                   Este dia no fue configurado como parte de su agenda si desea hacerlo haga click <a href="<?=base_url()?>turnera/horario/index/<?php echo $idConsultorio ?>">aqui</a>
                </p>
                
            </div>
            <?php } ?>
	</div>
</div>
