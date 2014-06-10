<script>
  $(document).ready(function () {
    $('#sabor').change(function () {
      readURL(this);
    });
  });
</script>

<div class="row col-xs-12 text-center">
  <p>¿Desea añadir una imagen al sabor <?= $nombre ?>?</p>
  <?= form_open_multipart("admin/sabores/alta_imagen");?>
  <div class="row">
  <?= form_input(array('type' => 'file',
                       'name' => 'sabor',
                       'id'   => 'sabor',
                       'class' => 'cosaborl-xs-9 col-xs-offset-2',
                       'accept' => "image/*"
                       ));?>
  </div>
  <br />
  <?= img(array('src' => 'imagenes/defecto.png',
                'alt' => 'Imagen del sabor',
                'id' => 'visual_imagen')); ?>
  <br />
  <?= form_submit(array("name" => "subir",
                        "value" => "Subir",
                        "class" => "btn btn-primary")) ?>

  <?= anchor('admin/sabores/redirecciona', 'Omitir',
              array("class" => "btn btn-danger"));?>
  <?= form_hidden('nombre', $nombre);?>
  <?= form_close();?>
</div>