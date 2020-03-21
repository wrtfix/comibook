<script>
    tasks.push(generarRemitos);
</script>
<div class="page-header">
<h3> Definir destino </h3>
</div>

<!--<p><?php print_r($clientes); ?></p>-->

<div class='table-responsive'>
        <table class='table table-bordered table-hover tablesorter' id='tablaCliente' xagregar="false">
                <thead>
                        <tr>
                                <th class='header'>Nombre </th>
                                <th class='header checkCuit'>Domicilio </th>
                                <th class='header checkNumero'> Telefono</th>
                        </tr>
                </thead>
                <tbody>
                        <?php foreach($clientes as $item): ?>
                        <tr>
                                <td class="checkCuit"><input class="formulario " id="nombre-<?php print_r($item['id']);?>" style='width: 100%; border:none;' type='text' value='<?php print_r($item['nombre']);?>'/></td>
                                <td class="checkNumero"><input class="formulario " id="domicilio-<?php print_r($item['id']);?>" style='width: 100%; border:none;' type='text' value=''/></td>
                                <td class="checkNombre"><input class="formulario " id="telefono-<?php print_r($item['id']);?>" name=""style='width: 100%; border:none;' type='text' value=''/></td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
        </table>
</div>

