<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Heladeria El Valenciano</title>
  <link rel="icon" type="image/png" href="<?= base_url('/imagenes/favicon.png') ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?= base_url('/bootstrap/css/bootstrap.css')?>" rel="stylesheet">
  <link href="<?= base_url('/css/estilos.css')?>" rel="stylesheet">
  <link href="<?= base_url('/script/chosen/chosen.css')?>" rel="stylesheet">
  <link href="<?= base_url('/css/styles.css')?>" rel="stylesheet">

  <script type="text/javascript" src="<?=base_url('/script/jquery.js')?>"></script> 
  <script type="text/javascript" src="<?=base_url('/script/comunes.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('/script/jquery.glide.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('/script/jquery-ui-1.10.4.custom.js')?>"></script> 
  <script type="text/javascript">
    $('document').ready(function () {
      $("#mensaje").fadeIn(2000);
    });
  </script>
</head>
<body >
<?= img( array('src' => base_url('/imagenes/fondoSinT2.png'),
                                           'alt' => 'Fondo de la web',
                                           'id' => 'imagen_body'
                                                      ));?>
<section class="container">
  <div id="contenedor" class="container 
                              col-xs-12 
                              col-md-10 col-md-offset-1">
    <header class="row" id="cabecera">
      <div class="col-xs-2 col-lg-3">
        <?php if ($this->uri->segment(1) != 'productos' && $this->uri->segment(1) != 'carritos'): ?>
          <?php if ($this->cart->total_items() != 0): ?>
            <div class="alert alert-info text-center" id="carrito_cabecera">
              <p>Tiene Una Compra Pendiente:</p>
              <a href="<?= base_url('/productos/lista_productos') ?>" 
                 class="btn btn-xs btn-success">
                Carrito <span class="glyphicon glyphicon-shopping-cart"></span>
              </a>
              <a href="<?= base_url('/carritos/confirmar') ?>"
                 class="btn btn-xs btn-warning">
                Pedir <span class="glyphicon glyphicon-euro"></span>
              </a>
            </div>
          <?php endif; ?>
        <?php endif; ?>

      </div>
      <div class="col-xs-8 
                  col-lg-6  container">
        <a href="<?=base_url('/')?>"><?= img( array('src' => base_url('/imagenes/logo.png'),
                                                    'alt' => 'Cabecera de la web',
                                                    'class' => 'col-xs-12',
                                                    'id' => 'img_cabecera'
                                                    ));?>
        </a>
      </div>
      <div class="col-xs-2
                  col-lg-3 text-center" id="login">
        <?php if (logueado()): ?>
          Usuario:  <?= nombre_logueado() ?><br />
            <?php if ($this->Usuario->admin(id_login())): ?>
              <?= anchor('admin/admin/', 
                         '<span class="glyphicon glyphicon-wrench"></span> Menu', 
                         array('class' => 'btn btn-warning btn-xs',
                               'role' => 'button')); ?>    
            <?php else: ?>
              <?= anchor('usuarios/', 
                         '<span class="glyphicon glyphicon-wrench"></span> Menu', 
                         array('class' => 'btn btn-warning btn-xs',
                               'role' => 'button')); ?>
            <?php endif; ?>

            <?= anchor('admin/usuarios/logout', 
                       '<span class="glyphicon glyphicon-log-out"></span> Salir', 
                       array('class' => 'btn btn-danger btn-xs',
                             'role' => 'button')); ?>
        <?php else: ?>
            <?= anchor('admin/usuarios/login', 
                       '<span class="glyphicon glyphicon-log-in"></span> Login', 
                       array('class' => 'btn btn-danger btn-xs',
                             'role' => 'button')); ?>
            <?= anchor_popup("admin/usuarios/alta","<span class='glyphicon glyphicon-plus'></span> Registro", array(
                                  'width'      => "'+ancho+'",
                                  'class'      => 'btn btn-primary btn-xs',
                                  'role'       => 'button',
                                  'height'     => "'+altura+'",
                                  'scrollbars' => 'yes',
                                  'status'     => 'yes',
                                  'resizable'  => 'yes',
                                  'screeny'    => "'+arriba+'",
                                  'screenx'    => "'+izquierda+'"));  ?>
        <?php endif ?> 
      </div>
    </header>
    <nav class="row" id="menu">
      <section class="btn-group btn-group-justified" id="menu_principal">
        <?= anchor(base_url('/'),
                   img(array('src' => base_url('/imagenes/2.png'),
                             'alt' => 'Pie de la web',
                             'class' => 'imagenes_menu')) . "Home",
                  "class='btn btn-primary'")?>
        <?= anchor(base_url('/home/ubicacion'),
                   img(array('src' => base_url('/imagenes/menta.png'),
                             'alt' => 'Pie de la web',
                             'class' => 'imagenes_menu')) . "Ubicación",
                  "class='btn btn-primary'")?>
        <?= anchor(base_url('/productos/lista_productos'),
                   img(array('src' => base_url('/imagenes/Piruleta.png'),
                             'alt' => 'Pie de la web',
                             'class' => 'imagenes_menu')) . "Productos",
                  "class='btn btn-primary'")?>
        <?= anchor(base_url('/home/conocenos'),
                   img(array('src' => base_url('/imagenes/violetas.png'),
                             'alt' => 'Pie de la web',
                             'class' => 'imagenes_menu')) . "Conócenos",
                  "class='btn btn-primary'")?>
      </section>
    </nav>
    <section class="container-flow cuerpo" id="cuerpo">
    <?= $contents ?>
    </section>
  </div>
  <footer class="container col-xs-12 col-md-10 col-md-offset-1">
    <section class="col-xs-3">
      <p>Avd. De Regla</p>
      <p>Nº 62 Chipiona</p>
    </section>
    <section class="col-xs-3">
      <p>CIF: R-74.085.163</p>
      <p>Tlf. 956371155</p>
    </section>
    <section class="col-xs-3">
      <a href="<?php echo base_url('usuarios/contacto') ?>">Contacto</a>
      <a href="http://www.w3.org/WAI/WCAG1AA-Conformance"
         title="Explicación del Nivel Doble-A de Conformidad">
        <img height="32" width="88" src="http://www.w3.org/WAI/wcag1AA"
             alt="Icono de conformidad con el Nivel Doble-A, de las Directrices de Accesibilidad para el 
                  Contenido Web 1.0 del W3C-WAI">
      </a>
    </section>
    <section id="social" class="row col-xs-3">
      <div class="col-xs-4"><a href="https://www.facebook.com/HeladeriaElValenciano" target="_blank"><img src="<?= base_url('/imagenes/facebook.png') ?>" alt="Facebook"></a></div>
      <div class="col-xs-4"><a href="https://plus.google.com/+HeladeriaElValencianoChipiona" target="_blank"><img src="<?= base_url('/imagenes/google.png') ?>" alt="G+"></a></div>
      <div class="col-xs-4"><a href="https://twitter.com/H_El_Valenciano" target="_blank"><img src="<?= base_url('/imagenes/twitter.png') ?>" alt="Twitter"></a></div>
    </section>
  </footer>
  <section class="col-xs-12 col-md-10 col-md-offset-1 pie"> 
  </section>
</section>
</body>
</html>