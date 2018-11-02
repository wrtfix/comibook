<div class="container">
    <div class="row mt">
  <div class="span4 offset4 well">
    <legend>Sistema de gestión</legend>
    <?php if (validation_errors() !=null) { ?>
          <div class="alert alert-danger">
              <a class="close" data-dismiss="alert" href="#">×</a><?php echo validation_errors(); ?>
          </div>
    <?php } ?>
    <?php echo form_open('verifylogin'); ?>
      <input type="text" id="username" class="span4" name="username" placeholder="Usuario"/>
      <input type="password" id="password" class="span4" name="password" placeholder="Clave"/>
      <label class="checkbox"></label>
      <button type="submit" name="submit" class="btn btn-info btn-block">Ingresar</button>
      <br/>
      <center>
      <?php if ($registrarse[0]->valor == 'true' ) { ?> 
      <a href="<?=base_url()?>index.php/registrarse/index">Registrarse</a>
      <?php } ?>
      </center>

    </form>    
  </div>
</div>
</div>