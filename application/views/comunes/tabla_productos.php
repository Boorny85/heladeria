<?php foreach ($filas as $fila): ?>
  <tr>
    <td><?= anchor("/productos/ficha/{$fila['id']}", "{$fila['nombre']}")  ?></td>
    <td><?= $fila['familia'] ?></td>
    <td><?= $fila['precio_format'] ?></td>
    <td><?= $fila['descripcion'] ?></td>
    <td><?= ($fila['combinable'] != 0)? 'Sí': 'No' ?></td>
    <td class="text-center">
      <?= anchor_popup("admin/productos/editar/{$fila['id']}", 
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

      <?= anchor_popup("admin/productos/editar_imagen/{$fila['id']}", 
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

      <?= anchor_popup("admin/productos/borrar/{$fila['id']}", 
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
<?php endforeach; ?>