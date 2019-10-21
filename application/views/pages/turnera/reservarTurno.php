
<script>

    function buscarAFIP() {
        var elem = 'https://afip.tangofactura.com/Index/GetCuitsPorDocumento/?NumeroDocumento=' + $("#numeroAFIP").val();
        $.ajax({
            type: "GET",
            url: elem,
            dataType: 'json',
            success: function (response) {
                var url = 'https://afip.tangofactura.com/Index/GetContribuyente/?cuit=' + response.data[0];
                $("#cuilAFIP").val(response.data[0]);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: 'json',
                    success: function (response) {
                        $('#datosPersonales').show();
                        $('#nombreAFIP').val(response.Contribuyente.nombre);
                        $('#domicilioAFIP').val(response.Contribuyente.domicilioFiscal.direccion);
                        $('#localidadAFIP').val(response.Contribuyente.domicilioFiscal.localidad);
                    }
                });
            }
        });
    }

</script>

<div class="col-lg-9">
    <div class="shop-topbar-wrapper">
        <h1>Solicitar reserva para las <?php print_r($horario);?> hs</h1>    
    </div>
    <p>Ingrese su numero de documento para realizar la reserva del turno y presione buscar luego ingrese email y numero de telefono para poder confirmar el turno.</p>


    <div class="row">
        <div class="col-lg-6">
            <div class="quick-view-select">
                <div class="select-option-part">
                    <label>Documento</label>
                    <input name="cuil" type="text" id="numeroAFIP">
                </div>
            </div>
            <a class="btn-style cr-btn" onclick="buscarAFIP()">Buscar</a>
        </div>


        <div class="col-lg-6" style="display: none" id="datosPersonales">  
            <div class="contact-message-wrapper">
                <div class="contact-message">
                    <form id="contact-form" action="<?=base_url()?>turnera/reserva/realizarReserva" method="post">
                        <input name="nroCuil" type="hidden" value="" id="cuilAFIP">
                        <input type="hidden" name="horario" value="<?php print_r($horario);?>"/>
                        <input type="hidden" name="fecha" value="<?php print_r($fecha);?>"/>
                        <input type="hidden" name="idConsultorio" value="<?php print_r($idConsultorio);?>"/>
                        <div class="qwick-view-content">
                            <div class="select-option-part">
                                <label>Apellido y nombre</label>
                                <input name="nombre" type="text" id="nombreAFIP">
                            </div>
                            <div class="select-option-part">
                                <label>Domicilio</label>
                                <input name="domicilio" type="text" id="domicilioAFIP">
                            </div>
                            <div class="select-option-part">
                                <label>Localidad</label>
                                <input name="localidad" type="text" id="localidadAFIP">
                            </div>
                            <div class="select-option-part">
                                <label>Mail</label>
                                <input name="mail" type="text">
                            </div>
                            <div class="select-option-part">
                                <label>Telefono</label>
                                <input name="telefono" type="text">
                            </div>
                        </div>

                        <?php echo $this->recaptcha->render(); ?>
                        <br>
                        <input type="submit" class="btn-style cr-btn" value="Reservar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
