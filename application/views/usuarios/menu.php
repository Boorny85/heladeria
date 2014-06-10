<div class="row" id="mensaje">
  <p  class="text-center"><?= $mensaje?></p>
</div>
<header class="text-center alert alert-info"><h3>Administración de Usuario</h3></header>
<section class="row col-xs-8 col-xs-offset-2 celda-centrado">
    <section class="col-xs-6">
      <?= anchor_popup("usuarios/editar", 
                       'Perfil', 
                        array('width'      => "'+ancho+'",
                              'class'      => 'btn btn-success btn-block btn-md',
                              'role'       => 'button',
                              'height'     => "'+altura+'",
                              'scrollbars' => 'yes',
                              'status'     => 'yes',
                              'resizable'  => 'yes',
                              'screeny'    => "'+arriba+'",
                              'screenx'    => "'+izquierda+'")) ?>
    </section>
    <section class="col-xs-6">
      <a href='<?= base_url("facturas/index/")?>' class="btn btn-primary btn-block">
        Pedidos
      </a>
    </section>
</section>