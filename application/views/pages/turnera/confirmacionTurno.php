<?php if ($exito) { ?>
<div class="col-lg-9">
    <div class="shop-topbar-wrapper">
        <h1>Confirmacion</h1>    
    </div>
    <p>Su turno fue reservado con exito.</p>
    <p>Recuerde que su identificador de turno es: </p>
    <p>El telefono del local es: <?php print_r($consultorio[0]->telefono);?> </p>
    <p>La direccion del local es: <?php print_r($consultorio[0]->direccion);?> </p>
    <p>El horario en que fue realizada la reserva es: <?php print_r($horario);?> hs</p>
    <p>La fecha en que fue realizada la reserva fue: <?php print_r($fecha);?></p>
</div>
<?php } else { ?>
<div class="col-lg-9">
    <div class="shop-topbar-wrapper">
        <h1>No se ah podido reserva este turno</h1>    
    </div>
    <p>Al parecer alguien te gano de mano completando los datos para realizar la reserva del turno.</p>
</div>
<?php } ?>
