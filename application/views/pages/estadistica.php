<script> 
    
    $(function() {
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
    
    

});

</script>
    


<div class="page-header">
    <h3> Estadisticas </h3>
</div>
<div class="row">
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
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-edit fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><div class="huge"><?php print_r($cantidadPedidos); ?></div> </div>
                        <div>Pedidos</div>
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
    </div>
</div>
