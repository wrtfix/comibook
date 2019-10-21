<div class="shop-topbar-wrapper">
    <h2>Horarios disponibles para el  <?php print_r($fecha); ?></h2>    
</div>
<p>Seleccione el horario el cual desea realizar una reserva</p>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-content table-responsive">
        <table>
            <thead>
                <tr>
                    <th class="product-name">Horario</th>
                    <th class="product-price">Estado</th>
                    <th class="product-subtotal">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                function getTurnos($turnos, $horario) {
                    foreach($turnos as $turno):
                        $current = strtotime( $turno->hora );
                        if ($current == $horario){
                            return $turno;
                        }
                    endforeach;
                }
                $i = 0;
                if (!empty($horario)){
                $current = strtotime( $horario[0]->horaDesde );
                $last = strtotime( $horario[0]->horaHasta );

                $total=0; 
                while( $current <= $last ) { 
                    $turno = getTurnos($turnos,$current);
                    if($turno) {
                        $total = $total + $turno->monto;
                    }

                ?>
                <tr>
                    <td class="product-thumbnail">
                        <?php print_r(date( 'H:i:s', $current )); ?>
                    </td>
                    <td class="product-name">
                        <?php $turno != null ? print_r('Ocupado') : print_r('Libre');  ?>
                    </td>
                    
                    <td class="product-subtotal">
                        <?php if ($turno == null) { ?>
                        <div class="btn-style cr-btn" onclick="reservarHorario('<?php print_r(date( 'H:i:s', $current )); ?>','<?php print_r($idConsultorio); ?>', '<?php print_r($fecha); ?>')" >
                            Reservar
                        </div>
                        <?php } ?>
                        
                    </td>

                </tr>
                <?php    
                    $current = strtotime( '+'.$horario[0]->intervalo.' minute', $current ); $i = $i + 1;
                    } 
                } 
                ?>
            </tbody>
        </table>
    </div>
</div>
