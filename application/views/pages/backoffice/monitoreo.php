

<div class="page-header">
    <h2>Actividades</h2>
</div>
<div class="row">

    <div class="table-responsive">
        <table class="table table-bordered table-hover tablesorter" id="tablaMenu" xagregar="false">
            <thead>
                <tr>
                    <th class="header">Hora<i class=""></i></th>                    
                    <th class="header">Usuario<i class=""></i></th>
                    <th class="header">Tipo de actividad<i class=""></i></th>
                    <th class="header">Tarea ejecutada<i class=""></i></th>
                    <th class="header">Funcionalidad<i class=""></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($agregados as $item): $cont = $cont + 1; ?>                  
                    <tr>
                        <td><?php print_r($item->fecha); ?></td>
                        <td><?php print_r($item->username); ?></td>
                        <td><?php print_r($item->tipo); ?></td>
                        <td><?php print_r($item->consulta); ?></td>
                        <td><?php print_r($item->funcionalidad); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>







