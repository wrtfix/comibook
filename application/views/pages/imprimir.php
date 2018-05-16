<div class="page-header">
	<h2>Imagenes</h2>	
</div>

<?php if (!empty($error)){?>
<div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>ERROR</strong>
	<?php echo $error; ?>
</div>
<?php }?>

<?php if (!empty($results)){?>
<div class="alert alert-dismissable alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Exito</strong>
	<?php echo base_url().'uploads/'; print_r($results['file_name']);?>
</div>
<?php }?>



<?php echo form_open_multipart('imprimir/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="Subir" />

</form>