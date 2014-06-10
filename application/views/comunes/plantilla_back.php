<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Heladeria El Valenciano</title>
  <link rel="icon" type="image/png" 
        href="<?= base_url('/imagenes/favicon.png') ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?= base_url('/bootstrap/css/bootstrap.css')?>" rel="stylesheet">
  <link href="<?= base_url('/css/estilos.css')?>" rel="stylesheet">
  <link href="<?= base_url('/script/chosen/chosen.css')?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=base_url('/css/jquery-ui-1.10.4.custom.css')?>">
  
  <script type="text/javascript" src="<?=base_url('/script/jquery.js')?>"></script> 
  <script type="text/javascript" src="<?=base_url('/script/comunes.js')?>"></script>
  <script type="text/javascript">
    $('document').ready(function () {
      $("#mensaje").fadeIn(2000);
    });
  </script></head>
<body class="container" id="contenedor-back" >
<header id="cabecera-back" class="row">
  <div class="col-xs-8 col-xs-offset-2 
              col-md-4 col-md-offset-4 container">
    <a href="<?=base_url('/admin')?>">
      <?= img( array('src' => base_url('/imagenes/logo.png'),
                     'alt' => 'Cabecera de la web',
                     'class' => 'col-xs-12',
                      'id' => 'img_cabecera_back'));?>
    </a>
  </div>
  <div class="col-xs-2
              col-md-3 text-center">
    <?php if (logueado()): ?>
        <strong>Técnico:</strong>  <?= nombre_logueado() ?><br />
        <?= anchor('admin/admin/', 
                   '<span class="glyphicon glyphicon-wrench"></span> Menu', 
                   array('class' => 'btn btn-warning btn-xs',
                         'role' => 'button')); ?>

        <?= anchor('admin/usuarios/logout', 
                   '<span class="glyphicon glyphicon-log-out"></span> Salir', 
                   array('class' => 'btn btn-danger btn-xs',
                         'role' => 'button')); ?>
    <?php endif ?>
  </div>
</header>
<section>
  <?= $contents ?>
</section>
</body>
</html>