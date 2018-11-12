<div class="limiter">
    <div class="container-login100">
        <div class="login100-more"></div>

        <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
            <?php if (validation_errors() != null) { ?>
                <div class="alert alert-danger">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <?php if ($userAdd != null) { ?>
                <div class="alert alert-info alert-dismissable">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo $userAdd; ?>
                </div>
            <?php } ?>
            <?php echo form_open('registrarse'); ?>
            <div class="wrap-input100 validate-input" data-validate="El usuario es requerido">
                <span class="label-input100">Nombre de Usuario</span> 
                <input class="input100" type="text" name="username" placeholder="">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "La Clave es requerida">
                <span class="label-input100">Clave</span>
                <input class="input100" name="password" type="password" placeholder="*************">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "La Clave es requerida">
                <span class="label-input100">Repita su Clave</span>
                <input class="input100" name="passconf" type="password" placeholder="*************">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "El Email es requerido: ex@abc.xyz">
                <span class="label-input100">Email</span>
                <input class="input100" type="text" name="email" placeholder="Direccion de email...">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "El telefono es requerido">
                <span class="label-input100">Telefono</span>
                <input class="input100" type="text" name="email" placeholder="Numero de telefono...">
                <span class="focus-input100"></span>
            </div>


            <?php echo $this->recaptcha->render(); ?>
            
            <br>

             <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button type="submit" name="submit" class="login100-form-btn"> Registrarse </button>
                </div>
                <a href="<?= base_url() ?>index.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                    Volver
                    <i class="fa fa-long-arrow-right m-l-5"></i>
                </a>
            </div>

            
            </form>
        </div>
    </div>
</div>