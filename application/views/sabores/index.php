<div class="row text-center">
<?= anchor_popup("admin/sabores/alta",
                 "<span class='glyphicon glyphicon-plus'></span> Nuevo Sabor", 
                 array('width'      => "'+ancho+'",
                       'class'      => 'btn btn-primary btn-xs',
                       'role'       => 'button',
                       'height'     => "'+altura+'",
                       'scrollbars' => 'yes',
                       'status'     => 'yes',
                       'resizable'  => 'yes',
                       'screeny'    => "'+arriba+'",
                       'screenx'    => "'+izquierda+'"));  ?>
</div>
<div class="row" id="mensaje">
  <p class="text-center"><?= $mensaje?></p>
</div>
<section class="row">
  <table class="col-xs-10 col-xs-offset-1">
    <thead>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Acciones</th>
    </thead>  
    <tbody>
      <?php foreach ($filas as $fila): ?>
        <tr>
          <td><?= anchor("admin/sabores/ficha/{$fila['id']}", "{$fila['nombre']}")  ?></td>
          <td><?= $fila['descripcion'] ?></td>
          <td class="text-center">
            <?= anchor_popup("admin/sabores/editar/{$fila['id']}", 
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

            <?= anchor_popup("admin/sabores/editar_imagen/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-picture"></span>', 
                       array('width'      => "'+ancho+'",
                             'class'      => 'btn btn-warning btn-xs',
                             'role'       => 'button',
                             'height'     => '550',
                             'scrollbars' => 'yes',
                             'status'     => 'yes',
                             'resizable'  => 'yes',
                             'screeny'    => "'+arriba+'",
                             'screenx'    => "'+izquierda+'")) ?>

            <?= anchor_popup("admin/sabores/borrar/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-remove"></span>', 
                       array('width'      => "'+ancho+'",
                             'class'      => 'btn btn-danger btn-xs',
                             'role'       => 'button',
                             'height'     => '300',
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
</section>