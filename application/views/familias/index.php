<div class="row text-center">
  <?= anchor_popup("admin/familias/alta",
                   "<span class='glyphicon glyphicon-plus'>
                    </span> Nueva Familia", 
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
  <p  class="text-center"><?= $mensaje?></p>
</div>
<section class="row">
  <table class="col-xs-4 col-xs-offset-4 text-center">
    <thead>
      <th>Nombre</th>
      <th>Acciones</th>
    </thead>  
    <tbody>
      <?php foreach ($filas as $fila): ?>
        <tr>
          <td><?= $fila['nombre']?></td>
          <td class="text-center">
            <?= anchor_popup("admin/familias/editar/{$fila['id']}", 
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

            <?= anchor_popup("admin/familias/borrar/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-remove"></span>', 
                       array('width'      => "'+ancho+'",
                             'class'      => 'btn btn-danger btn-xs',
                             'role'       => 'button',
                             'height'     => '250',
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