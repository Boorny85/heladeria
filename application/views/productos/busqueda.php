<?php foreach ($productos as $producto): ?>
  <?php if($producto['combinable'] != 0): ?>
    <div class="clear"></div>
    <div class="producto_sabor box4">
  <?php else: ?>
    <div class="producto box4">
  <?php endif; ?>
    <figure>
      <?= anchor_popup("productos/ficha/{$producto['id']}",
                       img( array('src' => base_url("{$producto['imagen']}"),
                                  'alt' => "{$producto['descripcion']}",
                                  'class' => 'imagen_producto')), 
                       array('width'      => "'+ancho+'",
                             'role'       => 'button',
                             'height'     => "'+altura+'",
                             'scrollbars' => 'yes',
                             'status'     => 'yes',
                             'resizable'  => 'yes',
                             'screeny'    => "'+arriba+'",
                             'screenx'    => "'+izquierda+'"));  ?>
      <figcaption>
        <p><?php echo $producto['nombre'] ?></p> 
      </figcaption>
    </figure>
    <?php if($producto['combinable'] != 0): ?>
      <p>
        <?= form_dropdown('sabores', $sabores, 0, "id='sabores_{$producto['id']}'   
                                                    multiple 
                                                    class='chosen-select select_sabores' 
                                                    data-placeholder='Seleccione 1 o 2 Sabores'
                                                    data-producto={$producto['id']}"); ?>
      </p>
    <?php endif; ?>
    <a href="#" data-id="<?=$producto['id']?>" class="anadir">
      <?= img( array('src' => base_url('/imagenes/+.png'),
                     'alt' => 'Anadir 1',
                     'class' => 'imagenes_cantidades'));  ?>
    </a>
    <span><?php echo $producto['precio'] ?> €</span>
    <a href="#" data-id="<?=$producto['id']?>"class="quitar" >
      <?= img( array('src' => base_url('/imagenes/-.png'),
                   'alt' => 'quitar 1',
                   'class' => 'imagenes_cantidades'));  ?>
    </a>


  </div>
<?php endforeach; ?>
<div class="clear"></div>
<script type="text/javascript" src="<?=base_url('/script/comunes.js')?>"></script>
<script type="text/javascript" 
        src="<?=base_url('/script/chosen/chosen.jquery.js')?>"></script>
<script>
  $(document).ready(function () {
    $('.select_sabores').chosen({max_selected_options: 2                                 });


    $('.select_sabores').change(function () {
      var sabores = $(this).val();
      var id_producto = $(this).data('producto')

      var id = "sabores_" + id_producto;
      if (sabores != null) {
        for (var i = 0; i < sabores.length; i++) {
          id += sabores[i];
        };  
      };
      //$("a[data-id='"+ id_producto +"']").data('id',id);

    });
  })
</script>