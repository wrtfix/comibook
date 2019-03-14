<script>
cambios=[];
guardar=[];

 $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy', onSelect: function(dateText, inst) { 
            var dateAsString = dateText; //the first parameter of this function
            var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
            var $aux = $("form:first")
            $aux.attr('action',"<?=base_url()?>index.php/noticias/index/"+dateAsString);
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
        $('#tab2').click(function(){
            $("#screenSelImagen").show();
            $("#screenUrlImagen").hide();
            $("#tab1").removeAttr('class');
            $("#tab2").attr('class','active');
	});
        $('#tab1').click(function(){
            $("#screenSelImagen").hide();
            $("#screenUrlImagen").show();
            $("#tab2").removeAttr('class');
            $("#tab1").attr('class','active');
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
			$('#pedidos').append("<tr><td></td><td style='display: none;'><input name='fecha' id='fecha' type='input' value='"+fecha+"'></td><td><input name='titulo' type='input' value=''></td><td><input name='visitas' type='input' value=''></td><td><input name='resumen' type='input' value=''></td><td><input name='likes' type='input' value=''></td><td style='display: none;'></td><td><input name='unLikes' type='input' value=''></td><td style='display: none;'></td><td><input id='NewurlImage' name='urlImage' type='hidden' value=''><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#imageModal' >Imagen</button></td></tr>");
			$("#pedidos").attr("xagregar","true");
		}
	});
        $("#validarImagen").click(function(){
            var url =  $("#imageURL").val();
            $("#setImage").attr('src',url);
            
        });
        $('#selectImagen').click(function(){
		var idNoticia = $('input:checked:first').attr('id');
                var url =  $("#imageURL").val();
                if (url == ''){
                    $("#NewurlImage").val(idNoticia);
                }else{
                    $("#NewurlImage").val(url);
                }
	});
        
	$('#guardar').click(function(){
		var agrego = $("#pedidos").attr("xagregar");
                if (agrego=='true'){ 
			$("form:first").submit();
		}else{
                    for (i = 0; i < cambios.length; i++)
                    {
                            var titulo = $('#titulo-'+cambios[i]).val();
                            var visitas = $('#visitas-'+cambios[i]).val();
                            var resumen = $('#resumen-'+cambios[i]).val();
                            var likes = $('#likes-'+cambios[i]).val();
                            var Contrareembolso = $('#Contrareembolso-'+cambios[i]).val();
                            var unLikes = $('#unLikes-'+cambios[i]).val();
                            var Pago = $('#Pago-'+cambios[i]).val();
                            var urlImage = $('#urlImage-'+cambios[i]).val();
                            $.ajax({
                                       data: {fecha:fecha,titulo:titulo,visitas:visitas,resumen:resumen,likes:likes,Contrareembolso:Contrareembolso,unLikes:unLikes,Pago:Pago,urlImage:urlImage},
                                   type: "POST",
                                   url: "<?=base_url()?>index.php/noticias/updateNoticia/"+cambios[i],
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
                                           url: "<?=base_url()?>index.php/noticias/delNoticia/"+elem
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
<?php echo form_open('noticias/addNoticia'); ?>
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

        <div class="btn-group">
            <button type="button" id="agregar" class="btn btn-success">Agregar</button>
            <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
            <button type="button" id="contenido" class="btn btn-warning">Contenido</button>
            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
        </div>
        
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
					<td><input type="checkbox" class="selec" id="<?php print_r($item->idNoticia);?>" value=""></td>
					<td><input class="formulario tab" id="titulo-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->titulo);?>'/></td>
					<td><input class="formulario" id="visitas-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->visitas);?>'/></td>
					<td><input class="formulario tab" id="resumen-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->resumen);?>'/></td>
					<td><input class="formulario" id="likes-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->likes);?>'/></td>
					<td style="display: none;">
					<!-- <input class="formulario" id="Contrareembolso-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->ContraReembolso);?>'/>-->
						<select class="pago" id="Contrareembolso-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' >
	  							<option value="0" <?php if ($item->ContraReembolso==0) echo "selected"; ?>>No</option>
	  							<option value="1" <?php if ($item->ContraReembolso==1) echo "selected"; ?>>Si</option>
	  					</select>
					</td>
					<td><input class="formulario" id="unLikes-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->unLikes);?>'/></td>
					<td style="display: none;">
						<select class="pago" id="Pago-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' >
	  							<option value="0" <?php if ($item->Pago==0) echo "selected"; ?>>No</option>
	  							<option value="1" <?php if ($item->Pago==1) echo "selected"; ?>>Si</option>
	  					</select>
					</td>
					<td><input class="formulario" id="urlImage-<?php print_r($item->idNoticia);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->urlImage);?>'/></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <ul class="nav nav-tabs">
            <li id="tab1" class="active"><a href="#">Imagen desde URL</a></li>
            <li id="tab2"><a href="#">Seleccionar Imagen</a></li>
        </ul>
        <div class="modal-body" >
            <div id="screenSelImagen" style="display:none;">
            <table class="table table-bordered table-hover tablesorter" id="tablaGastos" xagregar="false">
            <thead>
              <tr>
                <th class="header">Seleccionar<i class=""></i></th>                    
                <th class="header">Imagen<i class=""></i></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($imagenes as $item): ?>                  
            <tr>
              <td><input type="checkbox" id="<?php echo base_url().'uploads/'; print_r($item->nombre);?>" class="fila" ></td>
              <td><img width="50%" height="50%" src="<?php echo base_url().'uploads/'; print_r($item->nombre);?>"/></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        <div id="screenUrlImagen">
            URL: <input type="text" id="imageURL" > <button type="button" class="btn btn-primary" id="validarImagen">Validar</button><br><br>
            <div id="imagenResult"><center><img width="50%" height="50%" src="" id="setImage"/></center></div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="selectImagen">Seleccionar</button>
      </div>
    </div>
  </div>
</div>
</div>



