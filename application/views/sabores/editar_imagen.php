<script>
  $(document).ready(function () {
    $('#sabor').change(function () {
      readURL(this);
    });
  });
</script>

<div class="row col-xs-12 text-center">
  <p>¿Desea editar la imagen del sabor <?= $fila['nombre'] ?>?</p>
  <?= form_open_multipart("admin/sabores/editar_imagen/$id");?>
  <div class="row">
  <?= form_input(array('type' => 'file',
                       'name' => 'sabor',
                       'id'   => 'sabor',
                       'class' => 'col-xs-9 col-xs-offset-2',
                       'accept' => "image/*"
                       ));?>
  </div>
  <?= $error ?>
  <br />
  <?= img(array('src' => $fila['imagen'],
                'alt' => 'Imagen del sabor',
                'id' => 'visual_imagen')); ?>
  <br />
  <?= form_submit(array("name" => "subir",
                        "value" => "Subir",
                        "class" => "btn btn-primary")) ?>

  <?= anchor('#', 'Omitir',
              array("class" => "btn btn-danger",
                    'onclick' => "window.close()"));?>
  <?= form_hidden('nombre', $fila['nombre']);?>
  <?= form_close();?>
</div>