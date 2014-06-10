<script type="text/javascript" src="<?=base_url('/script/validetta.js')?>"></script>
<script type="text/javascript" src="<?=base_url('/script/validettaLang-es-ES.js')?>"></script>
<script>
  $(document).ready(function () {
    $("#formulario").validetta();
  })
</script>
<?php if ($num_error != 0): ?>
<div class="alert alert-danger row col-xs-6 col-xs-offset-3 text-center">
  <?= validation_errors() ?>
</div>
<?php endif; ?>
<section class="row col-xs-10 col-xs-offset-1">
<?= form_open("admin/sabores/editar/$id", "id='formulario'") ?>
  <table>
    <thead>
      <th colspan="2" id="celda-centrado">
        Edición de Sabores
      </th>
    </thead>
    <tbody>
      <tr>
        <td>
          <?= form_label('Nombre: *', 'nombre') ?>
        </td>
        <td>
          <?= form_input(array('name' => 'nombre',
                               'type' => 'text',
                               'value' => set_value('nombre', $fila['nombre']),
                               'data-validetta' => 'required'))
          ?>
        </td>
      </tr>
      <tr>
        <td>
          <?= form_label('Descripción:', 'descripcion') ?>
        </td>
        <td>
          <?= form_textarea(array('name' => 'descripcion',
                                  'value' => set_value('descripcion',
                                                        $fila['descripcion']),
                                  'rows' => 5)); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="celda-centrado">
          <?= form_submit(array(
                          "name" => "editar",
                          "value" => "Editar Sabor",
                          "class" => "btn btn-primary btn-block")) ?>
        </td>
      </tr>
    </tbody>
  </table>
  <?= form_close() ?>
</section>