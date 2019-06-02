<script>

    $(function () {
        // Donut Chart
        Morris.Bar({
            element: 'morris-bar-chart',
            data: <?php print_r($moviminetoAnual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });

        Morris.Bar({
            element: 'morris-bar-chart-2',
            data: <?php print_r($pedidosAnual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });

        Morris.Bar({
            element: 'morris-area-chart',
            data: <?php print_r($historicoMensual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });

        Morris.Bar({
            element: 'morris-area-chart-2',
            data: <?php print_r($historicoGanadoMensual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });
        
        Morris.Bar({
            element: 'morris-area-chart-3',
            data: <?php print_r($historicoGastadoMensual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });
        
        Morris.Bar({
            element: 'morris-area-chart-4',
            data: <?php print_r($historicoGastadoAnual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });
        
        Morris.Bar({
            element: 'morris-area-chart-5',
            data: <?php print_r($gananciasAnuales); ?>,
            xkey: 'ano',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });
        
        Morris.Bar({
            element: 'morris-area-chart-6',
            data: <?php print_r($gananciaMensual); ?>,
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['total'],
            barRatio: 0.4,
            xLabelAngle: 90,
            hideHover: 'auto',
            resize: true
        });
        
        
        

    });

</script>



<div class="page-header">
    <h3> Estadisticas </h3>
</div>
<div class="row">
    
    <div class="col-lg-3 col-md-6">
<!--        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-edit fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><div class="huge"><?php print_r($cantidadPedidos); ?></div> </div>
                        <div>Pedidos diarios</div>
                    </div>
                </div>
            </div>
        </div>-->
        
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-edit fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><div class="huge"><?php print_r($acumuladaFeleteMes); ?></div> </div>
                        <div>Feletes acumulados del mes actual</div>
                    </div>
                </div>
            </div>
        </div>
        
        

        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Facturacion mensual </h3>
            </div>
            <div class="panel-body">
                <div id="morris-bar-chart"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
<!--        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($importePedidoTotal[0]->pedidos); ?> </div>
                        <div>Fletes acumulados</div>
                    </div>
                </div>
            </div>
        </div>-->
        
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($acumuladaGastoMes); ?> </div>
                        <div>Gastos acumulados del mes actual</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Total de gastos por mes </h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart-4"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
<!--        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($gananciaAnual); ?> </div>
                        <div>Ganancia acumulados anual </div>
                    </div>
                </div>
            </div>
        </div>-->
        
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($acumuladaFeleteMes - $acumuladaGastoMes); ?> </div>
                        <div>Ganancia acumuladas del mes actual </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Ganancia por mes</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart-6"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($importePedidoTotal[0]->pedidos - $importeGastadoTotal[0]->gastos); ?> </div>
                        <div>Ganancia acumulados</div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Ganancia por ano</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart-5"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($cantidadClientes); ?></div>
                        <div>Cantidad de clientes</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Pedidos por mes </h3>
            </div>
            <div class="panel-body">
                <div id="morris-bar-chart-2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($cantidadPendientes); ?></div>
                        <div>Pendientes</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-green">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Pedidos realizados por ano</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($cantidadGastos); ?> </div>
                        <div>Gastos</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-red">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Facturacion acumulada mensual </h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart-2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print_r($importeGastadoTotal[0]->gastos); ?> </div>
                        <div>Gastos acumulados </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i> Cantidad de gastos por mes </h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart-3"></div>
            </div>
        </div>
    </div>
    
    
    
</div>
