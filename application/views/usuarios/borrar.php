<div class="row col-xs-12 text-center">
  <h3>¿Está seguro de querer dar de baja a este usuario?</h3>
  <?= form_open("admin/usuarios/hacer_borrado") ?>
    <?= form_hidden('id', $id) ?>
    <?= form_submit(array(
                    "name" => "si",
                    "value" => "Sí",
                    "class" => "btn btn-primary")) ?>
    <?= anchor("#", 'No', array("class" => "btn btn-danger",
                                'onclick' => "window.close()")) ?>
  <?= form_close() ?>
</div>