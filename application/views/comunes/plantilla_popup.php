<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />

  <title></title>
  <link href="<?=base_url('bootstrap/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=base_url('/css/estilos.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('/css/styles.css')?>">

  <link href="<?= base_url('/script/chosen/chosen.css')?>" rel="stylesheet">


  <script type="text/javascript" src="<?=base_url('/script/jquery.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('/script/comunes.js')?>"></script>
</head>
<body id="contPopUp">
  <header id="cabecera-pop" class="row xs-row-12">
    <?= img( array('src' => base_url('/imagenes/logo.png'),
                   'alt' => 'Cabecera de la web',
                   'class' => 'img-responsive col-xs-8 col-xs-offset-2 col-sm-6 
                               col-sm-offset-3 col-md-4 col-md-offset-4',
                   'id' => 'img_cabecera'
                   ));?>
  </header>
  <section class="container">
    <?= $contents ?>
  </section>
</body>
</html>