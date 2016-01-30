<script>
$(document).ready(function(){

 $("#removeRow").click(function(){
		$(":checked").parent().parent().remove(); 	
 	});
});
</script>


<h3>
<?php echo $titulo ?>
</h3>

<div class="alert alert-info alert-dismissable">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
		<?php echo $ayuda ?>
</div>


 	
		<?php echo form_open('febrero2014/create'); ?>
<!-- <form class="form-horizontal">-->
<fieldset>

	<!-- Form Name -->
	<legend>Actas</legend>

	<!-- Text input-->
	<div class="control-group">
		<label class="control-label" for="textinput">Materia</label>
		<div class="controls">
			<input id="materia" name="textinput" type="text" placeholder=""
				required="" class="input-xlarge">

		</div>
	</div>

	<!-- Text input-->
	<div class="control-group">
		<label class="control-label" for="textinput">Profesor</label>
		<div class="controls">
			<input id="profesor" name="textinput" type="text" placeholder=""
				required="" class="input-xlarge">

		</div>
	</div>

	<!-- Text input-->
	<div class="control-group">
		<label class="control-label" for="textinput">Fecha</label>
		<div class="controls">
			<input id="fecha" name="textinput" type="text" placeholder=""
				required="" class="input-xlarge">

		</div>
	</div>

	<!-- Text input-->
	<div class="control-group">
		<label class="control-label" for="textinput">Division</label>
		<div class="controls">
			<input id="division" name="textinput" type="text" placeholder=""
				required="" class="input-xlarge">

		</div>
	</div>

	<!-- Button (Double) -->
	<div class="control-group">
		<label class="control-label" for="button1id"></label>
		<div class="controls">
			<button id="addRow" type="submit" name="button1id"
				class="btn btn-success">Agregar</button>
			<button id="removeRow" type="button" name="button2id"
				class="btn btn-danger">Eliminar</button>
			<button id="removeRow" type="button" name="button2id"
				class="btn btn-primary">Asignar alumnos</button>

		</div>
	</div>

</fieldset>


<table id="actas" class="table">
	<thead>
		<th>Seleccione</th>
		<th>Division</th>
		<th>Materia</th>
		<th>Profesor</th>
		<th>Fecha</th>

	</thead>
	<tbody>

	</tbody>
</table>


</form>
