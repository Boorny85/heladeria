<div class="row col-xs-12 text-center">
  <p>¿Desea añadir una imagen al producto <?= $nombre ?>?</p>
  <?= form_open_multipart("admin/productos/alta_imagen");?>
  <div class="row">
  <?= form_input(array('type' => 'file',
                       'name' => 'producto',
                       'id'   => 'producto',
                       'class' => 'coproductol-xs-9 col-xs-offset-2',
                       'accept' => "image/*"
                       ));?>
  </div>
  <br />
  <?= img(array('src' => 'imagenes/defecto.png',
                'alt' => 'Imagen del producto',
                'id' => 'visual_imagen')); ?>
  <br />
  <?= form_submit(array("name" => "subir",
                        "value" => "Subir",
                        "class" => "btn btn-primary")) ?>

  <?= anchor('admin/productos/redirecciona', 'Omitir',
              array("class" => "btn btn-danger"));?>
  <?= form_hidden('nombre', $nombre);?>
  <?= form_close();?>
  <?php  echo $error  ?>
</div>
<script>
  $(document).ready(function () {
    $('#producto').change(function () {
      readURL(this);
    });
  });
</script>
