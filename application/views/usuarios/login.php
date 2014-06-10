<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="<?=base_url('/css/login.css')?>" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
      <script type="text/javascript" src="<?=base_url('/script/jquery.js')?>"></script> 

    <script type="text/javascript" src="<?=base_url('/script/comunes.js')?>"></script>
  </head>

  <body>
    <header id="cabecera-back" class="row xs-row-12">
      <a href="<?=base_url('/')?>"><?= img( array('src' => base_url('/imagenes/logo.png'),
                                                          'alt' => 'Cabecera de la web',
                                                          'class' => 'img-responsive col-xs-4 col-xs-offset-4',
                                                          'id' => 'img_cabecera'
                                                          ));?>
      </a>
    </header>
    <?php if ($num_error != 0): ?>
      <div class="alert alert-danger row col-xs-6 col-xs-offset-3 text-center">
        <?= validation_errors() ?>
      </div>
      <?php endif; ?>
    <div class="container" action="/trabajadores/login">
      <form class="form-signin" role="form" method="post">
        <input name="usuario" value="<?= set_value('usuario')?>" class="form-control" placeholder="Usuario" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <?= anchor_popup("admin/usuarios/alta","<span class='glyphicon glyphicon-plus'></span> Registro", array(
                                  'width'      => "'+ancho+'",
                                  'class'      => 'btn btn-success btn-lg btn-block',
                                  'role'       => 'button',
                                  'height'     => "'+altura+'",
                                  'scrollbars' => 'yes',
                                  'status'     => 'yes',
                                  'resizable'  => 'yes',
                                  'screeny'    => "'+arriba+'",
                                  'screenx'    => "'+izquierda+'"));  ?>
      </form>
    </div>
  </body>
</html>