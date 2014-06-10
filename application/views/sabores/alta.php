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
<?= form_open("admin/sabores/alta", "name='formulario' id='formulario'") ?>

  <table>
    <thead>
      <th colspan="2" id="celda-centrado">
        Alta de Sabores
      </th>
    </thead>
    <tbody>
      <tr>
        <td>
          <?= form_label('Nombre: *', 'nombre') ?>
        </td>
        <td>
          <?= form_input(array("name" => 'nombre',
                               "type" => 'text',
                               "value" => set_value('nombre'),
                               "data-validetta" => "required")); ?>
        </td>
      </tr>
      <tr>
        <td>
          <?= form_label('Descripción:', 'descripcion') ?>
        </td>
        <td>
          <?= form_textarea(array('name' => 'descripcion',
                                  'value' => set_value('descripcion'),
                                  'rows' => 5)); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="celda-centrado row">
        <div class="col-xs-6">
          <?= form_submit(array(
                          "name" => "editar",
                          "value" => "Nuevo Sabor",
                          "class" => "btn btn-primary btn-block")) ?>
        </div>
        <div class="col-xs-6">
          <?= anchor("#", 'Cancelar', array("class" => "btn btn-danger btn-block",
                                'onclick' => "window.close()")) ?>
        </div>
        </td>
      </tr>
    </tbody>
  <?= form_close() ?>
  </table>
</section>