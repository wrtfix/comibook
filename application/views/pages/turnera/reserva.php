

<script>
    function reservarHorario(horario, id, fecha){
        console.log('hola');
        $("#horarios").val(horario);
        $("#idConsultorio").val(id);
        $("#fecha").val(fecha);
        $("form:last").submit();
    }
    
    function traerReserva(id, fecha) {
        $.ajax({
            data: {idConsultorio: id, fecha: fecha},
            type: "POST",
            url: "<?= base_url() ?>index.php/turnera/reserva/obtenerTurnosLibres",
            success: function (response) {
                $("#respuesta").html(response)
            }
        });
    }
</script>

<div class="col-lg-9">
    <div class="shop-topbar-wrapper">
        <h1>Reservas</h1>    
    </div>
    <p>Seleccione el dia el cual desea realizar una reserva</p>

    <div class="row">
        <?php foreach ($fechas as $dia): ?> 
            <?php foreach ($totales as $item): ?>
                <?php if ($dia['fechaLabel'] === $item['diaLabel']) { ?>
                    <div class="col-sm-4">
                        <?php if ($item['total'] >= 0) { ?>
                            <div class="card mb-3" onclick="javascript:traerReserva('<?php print_r($idConsultorio); ?>', '<?php print_r($dia['fecha']); ?>');">
                            <?php } else { ?>
                                <div class="card mb-3">
                                <?php } ?>
                                <div class="card-body">
                                    <center>
                                        <h4 class="card-title"><?php print_r($item['diaLabel']); ?></h4>
                                        <h5 class="card-subtitle mb-2 text-muted"> <?php print_r($dia['fechaFormat']); ?></h5>
                                    </center>
                                </div>
                                <?php if ($item['total'] >= 0) { ?>
                                    <div class="card-footer text-muted">
                                        <center>
                                            <h7 class="card-title">Hay turnos disponibles</h7>
                                        </center>
                                    </div>
                                <?php } else { ?>
                                    <div class="card-footer text-danger">
                                        <center>
                                            <h7 class="card-title" >No hay turnos</h7>
                                        </center>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            
        </div>
        <div id="respuesta"></div>
    </div>   
    
</div>

<?php echo form_open('turnera/reserva/reservarHorario'); ?>
<input type="hidden" name="horario" id="horarios">
<input type="hidden" name="idConsultorio" id="idConsultorio">
<input type="hidden" name="fecha" id="fecha">
<?php form_close(); ?>
