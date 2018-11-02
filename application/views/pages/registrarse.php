<div class="container">
    <div class="row mt">
  <div class="span4 offset4 well">
    <legend>Registrarse</legend>
    <?php if (validation_errors() !=null) { ?>
          <div class="alert alert-danger">
              <a class="close" data-dismiss="alert" href="#">×</a><?php echo validation_errors(); ?>
          </div>
    <?php } ?>
    <?php if ($userAdd !=null) { ?>
          <div class="alert alert-info alert-dismissable">
              <a class="close" data-dismiss="alert" href="#">×</a><?php echo $userAdd; ?>
          </div>
    <?php } ?>
    <?php echo form_open('registrarse'); ?>
      <input type="text" id="username" class="span4" name="username" placeholder="Nombre de Usuario"/> </br>
      <input type="password" id="password" class="span4" name="password" placeholder="Clave"/> </br>
      <input type="password" id="passconf" class="span4" name="passconf" placeholder="Re Clave"/> </br>
      <input type="email" id="email" class="span4" name="email" placeholder="Email"/> </br>
      <input type="text" id="tel" class="span4" name="tel" placeholder="Telefono"/> </br>
      <p>
          <?php echo $this->recaptcha->render(); ?>
      </p>
      <button type="submit" name="submit" class="btn btn-info btn-block">Registrarme</button>
      <br>
      <center>
        <a href="<?=base_url()?>index.php">Volver</a>
      </center>
    </form>    
  </div>
</div>
</div>