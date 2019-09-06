<script>
function getContenido(url,id){
    $.ajax({
        data: {urlContent:url, diario:'<?php print_r($diario); ?>'},
        type: "POST",
        url: "<?=base_url()?>index.php/cms/scrapping/getContenido",
        success: function(response){
            if (response !='' && response!=null){
                var obj = JSON.parse(response);
                $("#description-"+id).val(obj.description);
                $("#content-"+id).val(obj.content);
                showInfo('Se cargo la informacion satisfactoriamente', "info");
            }else{
                showInfo('No es posible procesar la solicitud', "danger");
            }
        },
        error: function(){
            showInfo('ERROR : Verifique los campos ingresados', "danger");
        }

    });
}

function saveContent(id, title){
    var description = $("#description-"+id).val();
    var content = $("#content-"+id).val();
    $.ajax({
        data: {content:content, description:description, title:title},
        type: "POST",
        url: "<?=base_url()?>index.php/cms/scrapping/saveContenido",
        success: function(response){
            showInfo('El contenido se guardo satisfactoriamente', "info");
        },
        error: function(){
                showInfo('ERROR : Verifique los campos ingresados', "danger");
        }

    });
}

</script>


<div class="page-header">
    <h3> Scrapping  <?php print_r($diario); ?>  </h3>
</div>

<table class='table table-bordered table-hover tablesorter' id='tablaCliente' xagregar="false">
    <thead>
        <tr>
            <th class='header'> Titulo </th>
            <th class='header' > Descripcion </th>
            <th class='header' > Cotenido</th>
            <th class='header' > Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php  $cont=0; foreach ($noticias as $item): if ($item['url'] != '' && $item['title'] != '') { $cont=$cont+1; ?>
            <tr>
                <td class=""><textarea id="titulo-<?php print_r($cont); ?>">  <?php print_r($item['title']); ?> </textarea></td>
                <td class=""><textarea id="description-<?php print_r($cont); ?>"></textarea></td>
                <td class=""><textarea id="content-<?php print_r($cont); ?>"></textarea></td>
                <td class=""><div class="btn-group"><button type='button' onclick="javascript:getContenido('<?php print_r($item['url']); ?>','<?php print_r($cont); ?>')" class='btn btn-danger'>Contenido</button><button type='button' id='buscar' class='btn btn-warning' onclick="javascript:saveContent('<?php print_r($cont); ?>','<?php print_r($item['title']); ?>');">Guardar</button></div></td>
            </tr>
        <?php }endforeach; ?>
    </tbody>
</table>
