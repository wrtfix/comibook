<script>
$(document).ready(function(){
$('#buscar').click(function(){
	var $aux = $("form:first");
	var nombre = $('#nombreBusqueda').val();
	var fechaDesde = $('#desde').val();
	var fechaHasta = $('#hasta').val();
	if (fechaDesde==''){
		fechaDesde = '%20';
	}
	if (fechaHasta==''){
		fechaHasta = '%20';
	}
	if (nombre==''){
		nombre = '%20';
	}
	$aux.attr('action',"<?=base_url()?>index.php/pedientes/index/"+nombre+"/"+fechaDesde+"/"+fechaHasta);
	$aux.submit();
});

});
  $(function() {
    $( "#desde" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#hasta" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });

</script>
<?php echo form_open('pedientes/addCheques'); ?>
<div class="row">
<div class="page-header">
        <h2>Pedientes</h2>
</div>            
              
        
  
  <div class="row">
          <div class="col-lg-4">
            <div class="checkbox">
                  <label>Fecha desde <input id="desde" class="">
                  </label>
                </div>
</div>
<div class="col-lg-4">
  <div class="checkbox">
                  <label>Fecha hasta <input id="hasta" class="">
                  </label>
                </div>
          </div>
  <div class="col-lg-4">
<div class="checkbox">
                  <label>Nombre <input id="nombreBusqueda"class="">
                  </label>
              </div>
</div>
        </div>

            <button type="button" class="btn btn-default" id="buscar">Buscar</button>
            <br>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="header">Fecha<i class=""></i></th>
  					<th class="header">Nombre<i class=""></i></th>
                    <th class="header headerSortDown">Importe en $<i class=""></i></th>
                  </tr>
                </thead>
                <tbody>
                <?php $cont=0; foreach($agregados as $item): $cont=$cont+1;?>
                <tr>
                  <td><?php list($dia, $mes, $ano) = explode("-", $item->Fecha); echo $ano."-".$mes."-".$dia;?></td>                  
				  <td><?php print_r($item->ClienteOrignen);?></td>
                  <td><?php print_r($item->CostoFlete);?></td>
                 </tr>
                 <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          
        

        

        

      </div>