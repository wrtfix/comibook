
<script>
    var cambios = [];
    var cambiosMobile = [];
    
    $(document).ready(function () {
       $('#productos').click(function(){
	    var idSolicitud = $("input[name='solicitudes']:checked").val();
            if (idSolicitud != undefined){
                var $aux = $("form:first")
                $aux.attr('action',"<?=base_url()?>index.php/carrito/index/"+idSolicitud.split("-")[1]);
                $aux.submit();
            }else{
                 showInfo('Debe seleccionar una solicitud', 'danger');
            }
	});
        
        
    });

</script>
<?php if (validation_errors()) { ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>ERROR</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<?php echo form_open('carrito/index'); ?>

<div class="page-header">
    <h2>Solicitudes</h2>
</div>
<div class="btn-group">
    <button type="button" id="productos" class="btn btn-warning">Productos</button>
</div>
<div class="row">
    <br>
    <div class="table-responsive desktop">
        <table class="table table-bordered table-hover tablesorter" id="tablaConsultorios" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Seleccionar<i class=""></i></th>                    
                    <th class="header">Fecha<i class=""></i></th>
                    <th class="header">Usuario<i class=""></i></th>
                    <th class="header">Email<i class=""></i></th>
                    <th class="header">Telefono<i class=""></i></th>
                    <th class="header">Domicilio<i class=""></i></th>
                    <th class="header">Forma de pago<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($solicitudes as $item): $cont = $cont + 1; ?>                  
                    <tr>
                        <td><input type="radio" name="solicitudes" value="solicitudes-<?php print_r($item->idSolicitud); ?>" class="fila" ></td>
                        <td><input class="formulario" name="fecha" id="nombre-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->fecha); ?>'/></td>
                        <td><input class="formulario" name="usuario" id="especialidad-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/></td>
                        <td><input class="formulario" name="email" id="direccion-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->email); ?>'/></td>
                        <td><input class="formulario" name="telefono" id="telefono-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->telefono); ?>'/> </td>
                        <td><input class="formulario" name="domicilio" id="domicilio-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->domicilio); ?>'/> </td>
                        <td><input class="formulario" name="formaPago" id="formaPago-<?php print_r($item->idSolicitud); ?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item->formaPago); ?>'/> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-4 mobile" id="panelConfiguracion">
        <?php $cont = 0; foreach ($solicitudes as $item): $cont = $cont + 1; ?>
            <div  class="panel panel-green">
                <div class="col-lg-6 panel-body">
                     <div class="form-group">
                        <input  type="radio" value="solicitudes-<?php print_r($item->idSolicitud); ?>" name="solicitudes" />
                        <label>Seleccionar</label>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Fecha</label>
                        <input class="form-control formularioMobile" id="" style='width: 100%; border:none;' type='text' value='<?php print_r($item->fecha); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input class="form-control formularioMobile" id="" style='width: 100%; border:none;' type='text' value='<?php print_r($item->nombre); ?>'/>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <textarea class="form-control formularioMobile tab" id="" style='width: 100%; border:none;'><?php print_r($item->email); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <textarea class="form-control formularioMobile tab" id="" style='width: 100%; border:none;'><?php print_r($item->telefono); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Domicilio</label>
                        <textarea class="form-control formularioMobile tab" id="" style='width: 100%; border:none;'><?php print_r($item->Domicilio); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>Forma de Pago</label>
                        <textarea class="form-control formularioMobile tab" id="" style='width: 100%; border:none;'><?php print_r($item->formaPago); ?></textarea>
                        <p class="help-block"></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
   
</div>


