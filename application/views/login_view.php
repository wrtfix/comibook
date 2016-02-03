<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Sistema de gestión</title>
  </head>
  <body>
      <div class="container">
          <div class="row mt">
        <div class="span4 offset4 well">
          <legend>Sistema de gestión</legend>
          <?php if (validation_errors() !=null) { ?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo validation_errors(); ?>
                </div>
          <?php } ?>
          <?php echo form_open('verifylogin'); ?>
            <input type="text" id="username" class="span4" name="username" placeholder="Usuario"/>
            <input type="password" id="password" class="span4" name="password" placeholder="Clave"/>
            <label class="checkbox"></label>
            <button type="submit" name="submit" class="btn btn-info btn-block">Ingresar</button>
          </form>    
        </div>
      </div>
      </div>

  </body>
</html>
