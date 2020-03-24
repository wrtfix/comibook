<script>
    var pedido = "";
    function finalizarCompra(){
        var tel = $("#telefono").val();
        var localidad = $("#localidadAFIP").val();
        var mail = $("#mail").val();
        var nombre = $("#nombreAFIP").val();
        var domicilio = $("#domicilioAFIP").val();
        var formaPago = $("input[name='pago']:checked").val();
        $("#texto").val("Hola soy "+nombre+" y vivo en "+domicilio +", "+localidad+" y mi telefono es "+tel+" y mi email es "+mail +". \n Le escribo para solicitarle los siguientes productos: \n"+pedido+ "\n Forma de pago: "+ formaPago)
        $("#solcitarCompra").submit();
    }
    
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
                        $('.datosPersonales').show();
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
        <h1>Solicitud</h1>    
    </div>
    <p>Ingrese su numero de documento y presione buscar luego corrobore que sus datos personales esta actuliazados luego presione comprar.</p>


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


        <div class="col-lg-6 datosPersonales" style="display: none" >  
            <div class="contact-message-wrapper">
                <div class="contact-message">
                    
                        <input name="nroCuil" type="hidden" value="" id="cuilAFIP">
                        <input type="hidden" name="horario" value=""/>
                        <input type="hidden" name="fecha" value=""/>
                        <input type="hidden" name="idConsultorio" value=""/>
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
                                <input name="mail" id="mail" type="text">
                            </div>
                            <div class="select-option-part">
                                <label>Telefono</label>
                                <input name="telefono" id="telefono" type="text">
                            </div>
                            <div class="select-option-part">
                                <label>Forma de pago</label>  
                                <div class="form-check">
                                    <input name="pago" type="radio" value="debito" class="form-check-input" style="height: 20px"/> 
                                    <label class="form-check-label">Debito </label>
                                </div>
                                <div class="form-check">
                                    <input name="pago" type="radio" value="efectivo" class="form-check-input" style="height: 20px"/> 
                                    <label class="form-check-label">Efectivo </label>                   
                                </div>
                            </div>
                        </div>

                        
                        <br>
                        
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 datosPersonales" style="display: none">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="product-price">Producto</th>
                                <th class="product-name">Precio</th>
                                <th class="product-price">Cantidad</th>
                                <th class="product-price">Sub total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cont = 0;
                            foreach ($agregados as $item): $cont = $cont + 1; ?>
                                <script>
                                    pedido += '<?php print_r($cont." - ".$item->name." x ".$item->qty." $".$item->subtotal) ?> \n';
                                </script>
                                <tr>
                                    <td class="product-name">
                                        <a href="#"><?php print_r($item->name); ?></a>
                                    </td>
                                    <td class="product-price"><span class="amount"><?php print_r($item->price); ?></span></td>
                                    <td class="product-quantity">
                                        <div class="quantity-range">
                                            <?php print_r($item->qty); ?>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">$ <?php print_r($item->subtotal); ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <script>
                                    pedido += '\n Total: $ <?php print_r($total) ?>'
                                </script>
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td>$ <?php print_r($total) ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                
                <hr/>
                <a class="btn-style cr-btn" onclick="finalizarCompra()">Comprar</a>
            </div>
        </div>
        
</div>

<form action="http://api.whatsapp.com/send" id="solcitarCompra" method="GET">
    <input type="hidden" name="phone" id="phone" value="+5492494694645"/>
    <input type="hidden" name="text" id="texto"/>
</form>