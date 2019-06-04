<div class="limiter">
    <div class="container-login100">
        <div class="login100-more"></div>

        <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
            <?php if (validation_errors() != null) { ?>
                <div class="alert alert-danger">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <?php if ($userStateAdd != null) { ?>
                <div class="alert alert-info alert-dismissable">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo $userStateAdd; ?>
                </div>
            <?php } ?>
            <!--<form class="login100-form validate-form">-->
            <?php echo form_open('verifylogin'); ?>
            <span class="login100-form-title p-b-59">
                <?= $this->layout->placeholder("title"); ?>
            </span>
            <div class="wrap-input100 validate-input" data-validate="El usuario es requerido">
                <span class="label-input100">Usuario</span> 
                <input class="input100" type="text" name="username" placeholder="Usuario">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "La Clave es requerida">
                <span class="label-input100">Clave</span>
                <input class="input100" name="password" type="password" placeholder="*************">
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn" style="display: flex; justify-content: center; ">
                <div class="wrap-login100-form-btn" >
                    <div class="login100-form-bgbtn"></div>
                    <button type="submit" name="submit" class="login100-form-btn"> Ingresar </button>
                </div>
                <br>
                <br>
                <?php if ($registrarse[0]->valor == 'true') { ?> 
                    <a href="<?= base_url() ?>index.php/registrarse/index" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                        Registrarse
                        <i class="fa fa-long-arrow-right m-l-5"></i>
                    </a>
                <?php } ?>
                
            </div>
            <div>                
                <div style="display: flex; justify-content: space-around; margin-top: 15%;">
                <?php if ($loginGoogle[0]->valor == 'true') { ?> 
                <a class="" href="<?=base_url()?>googlelogin/login"><i class="fa fa-google-plus-official"></i> Google</a>
            <?php } ?>
            <?php if ($loginFacebook[0]->valor == 'true') { ?>     
                <?php print_r($loginUrlFacebook); ?>
<!--                    <a class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10" href="<?=base_url()?>facebooklogin/login"><img src="<?=base_url()?>estilo/login/img/flogin.gif" alt=""/></a>-->
            <?php } ?>
            </div>
                
            </div>
            
            
        
    </div>
        
</div>

