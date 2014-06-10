<div class="text-center col-xs-12">
  <h3>¿Está seguro de querer dar de baja a esta familia?</h3>
  <?= form_open("admin/familias/hacer_borrado") ?>
    <?= form_hidden('id', $id) ?>
    <?= form_submit(array(
                    "name" => "si",
                    "value" => "Sí",
                    "class" => "btn btn-primary")) ?>
    <?= anchor("#", 'No', array("class" => "btn btn-danger",
                                'onclick' => "window.close()")) ?>
    <?= form_close() ?>
</div>