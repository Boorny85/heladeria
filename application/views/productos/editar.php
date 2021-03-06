<?php if ($num_error != 0): ?>
<div class="alert alert-danger row col-xs-6 col-xs-offset-3 text-center">
  <?= validation_errors() ?>
</div>
<?php endif; ?>
<section class="row col-xs-10 col-xs-offset-1">
  <table>
  <?= form_open("admin/productos/editar/$id") ?>
    <thead>
      <th colspan="2" id="celda-centrado">
        Edición de Productos
      </th>
    </thead>
    <tbody>
      <tr>
        <td>
          <?= form_label('Nombre: *', 'nombre') ?>
        </td>
        <td>
          <?= form_input('nombre', set_value('nombre', $fila['nombre'])) ?>
        </td>
      </tr>
      <tr>
        <td>
          <?= form_label('Familia: *', 'id_familia') ?>
        </td>
        <td>
          <?= form_dropdown('id_familia', $familias, $fila['id_familia']) ?>
        </td>
      </tr>
      <tr>
        <td>
          <?= form_label('Precio: *', 'precio') ?>
        </td>
        <td>
          <?= form_input('precio', set_value('precio', $fila['precio']),"placeholder='00.00'") ?>
        </td>
      </tr>
      <tr>
        <td>
          <?= form_label('Combinable:', 'combinable') ?>
        </td>
        <td>
          <?= form_checkbox('combinable', 't', combinable($fila['combinable'])) ?>
        </td>
      </tr>
      <tr>
        <td>
          <?= form_label('Descripción: ', 'descripcion') ?>
        </td>
        <td>
          <?= form_textarea(array('name' => 'descripcion',
                                  'value' => set_value('descripcion',$fila['descripcion']),
                                  'rows' => 5)); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="celda-centrado">
          <?= form_submit(array(
                          "name" => "editar",
                          "value" => "Editar Producto",
                          "class" => "btn btn-primary btn-block")) ?>
        </td>
      </tr>
    </tbody>
    
  <?= form_close() ?>
  </table>
</section>