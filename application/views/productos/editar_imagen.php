<script>
  $(document).ready(function () {
    $('#producto').change(function () {
      readURL(this);
    });
  });
</script>

<div class="row col-xs-12 text-center">
  <p>¿Desea editar la imagen del producto <?= $fila['nombre'] ?>?</p>
  <?= form_open_multipart("admin/productos/editar_imagen/$id");?>
  <div class="row">
  <?= form_input(array('type' => 'file',
                       'name' => 'producto',
                       'id'   => 'producto',
                       'class' => 'col-xs-9 col-xs-offset-2'                       ));?>
  </div>
  <br />
  <?= img(array('src' => $fila['imagen'],
                'alt' => 'Imagen del producto',
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