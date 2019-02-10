<script>
$(document).ready(function () {
        $('#guardar').click(function () {
                $("form").submit();
        });
        
        
        $('#addDay').click(function () {
                $("#day").append("<div class='col-lg-8 ' id='day'> <div class='col-md-4'> <input type='checkbox' class='selec' id=' value='> Dia</div> <div class='col-md-pull-2'> <select name='dia'> <option value='lun'>Lunes</option> <option value='mar'>Martes</option> <option value='mier'>Miercoles</option> <option value='jue'>Jueves</option> <option value='vie'>Viernes</option> <option value='sab'>Sabado</option> <option value='dom'>Domingo</option> </select> </div> <div class='col-md-4'> Hora Desde </div> <div class='col-md-pull-2'> <input type='time' min='0' max='24' name='horaDesde' /> </div> <div class='col-md-4'> Hora hasta </div> <div class='col-md-pull-2'> <input type='time' min='0' max='24' name='horaHasta' /> </div> </div>");
        });
        
        $('#deleteDay').click(function () {
 		$("input:checkbox:checked").remove();
	});
        
        
});
</script>



<br>
<div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        En esta seccion usted debera configurar los horarios de atencion para sus profesionales.
</div>



<div class="page-header">
    <h3> Agenda </h3>
</div>

<?php echo form_open('turnera/horario/addHorario'); ?>

<button type="button" id="guardar" class="btn btn-primary">Guardar</button> <br> <br>

<div class="row">
    
    <div class="col-lg-4">
        <label> Cantidad de desacansos </label>
        <div class="checkbox">
            <input name="idConsultorio" id="desde" class="" autocomplete="off" value="<?php print_r($idConsultorio); ?>" type="hidden">  
            <input name="descanso" id="desde" class="" autocomplete="off" value="" type="number"> 
        </div>
        <label> Intervalo de tiempo</label>
        <div class="checkbox">
            <input name="intervalo" id="desde" class="" autocomplete="off" value="" type="number"> 
        </div>
        
        <label> Dias laborales </label>
        <button type="button" id="addDay" class="btn btn-danger"> + </button>
        <button type="button" id="deleteDay" class="btn btn-primary"> - </button>
        
        <div class="checkbox">
            <div class="col-lg-8 " id="day"> 
                <div class="col-md-4"> <input type="checkbox" class="selec" id="" value=""> Dia</div> 
                <div class="col-md-pull-2"> 
                    <select name="dia">
                        <option value="lun">Lunes</option>
                        <option value="mar">Martes</option>
                        <option value="mier">Miercoles</option>
                        <option value="jue">Jueves</option>
                        <option value="vie">Viernes</option>
                        <option value="sab">Sabado</option>
                        <option value="dom">Domingo</option>
                      </select>
                </div>
                <div class="col-md-4"> Hora Desde </div> 
                <div class="col-md-pull-2"> <input type="time" min="0" max="24" name="horaDesde" /> </div> 
                <div class="col-md-4"> Hora hasta </div> 
                <div class="col-md-pull-2"> <input type="time" min="0" max="24" name="horaHasta" /> </div>
            </div>
        </div>
        
        
    </div>
    <div class="col-lg-4">
        
    </div>
    <div class="col-lg-4">

    </div>
</div>