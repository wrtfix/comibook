<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?= $this->layout->placeholder("title"); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="jorge carlos mendiola" >
    
    
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>estilo/login2/css/main.css">

    <style>
        .login100-more{
            background-image: url('<?php print_r($loginImage[0]->valor)?>') !important;
        }
        
    </style>
</head>
<body>
      <div id="page-wrapper">
            <?php echo $content_for_layout ?> 
      </div>
</body>
</html>

