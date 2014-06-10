<div class="row text-center">
<?= anchor_popup("admin/usuarios/alta","<span class='glyphicon glyphicon-plus'></span> Nuevo usuario", array(
                                  'width'      => "'+ancho+'",
                                  'class'      => 'btn btn-primary btn-xs',
                                  'role'       => 'button',
                                  'height'     => "'+altura+'",
                                  'scrollbars' => 'yes',
                                  'status'     => 'yes',
                                  'resizable'  => 'yes',
                                  'screeny'    => "'+arriba+'",
                                  'screenx'    => "'+izquierda+'"));  ?></div>
<table>
<div class="row" id="mensaje">
  <p  class="text-center"><?= $mensaje?></p>
</div>
<section class="row">
  <div class="contenedor_tabla">
  <table class="col-xs-10 col-xs-offset-1">
    <thead>
      <th>Usuario</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>DNI</th>
      <th>Direccion</th>
      <th>Telefono</th>
      <th>Acciones</th>
    </thead>  
    <tbody>
      <?php foreach ($filas as $fila): ?>
        <tr>
          <td>
            <?= anchor("admin/usuarios/ficha/{$fila['id']}", 
                       "{$fila['usuario']}")  ?>
          </td>
          <td><?= $fila['nombre'] ?></td>
          <td><?= $fila['apellidos'] ?></td>
          <td><?= $fila['dni'] ?></td>
          <td><?= $fila['direccion'] ?></td>
          <td><?= $fila['telefono'] ?></td>
          <td class="text-center">
            <?= anchor_popup("admin/usuarios/editar/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-pencil"></span>', 
                        array('width'      => "'+ancho+'",
                              'class'      => 'btn btn-success btn-xs',
                              'role'       => 'button',
                              'height'     => "'+altura+'",
                              'scrollbars' => 'yes',
                              'status'     => 'yes',
                              'resizable'  => 'yes',
                              'screeny'    => "'+arriba+'",
                              'screenx'    => "'+izquierda+'")) ?>

            <?= anchor_popup("admin/usuarios/borrar/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-remove"></span>', 
                       array('width'      => "'+ancho+'",
                             'class'      => 'btn btn-danger btn-xs',
                             'role'       => 'button',
                             'height'     => '220',
                             'scrollbars' => 'yes',
                             'status'     => 'yes',
                             'resizable'  => 'yes',
                             'screeny'    => "'+arriba+'",
                             'screenx'    => "'+izquierda+'")) ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  </div>
</section>