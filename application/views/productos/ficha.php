<section class="alert alert-info ficha">
  <h3>Ficha Del Producto</h3>
  <section class="container">
  <figure class="col-xs-6 box4">
      <?= img(array('src' => base_url("{$producto['imagen']}"),
                    'alt' => "{$producto['descripcion']}",
                    'class' => 'imagen_ficha'));  ?>
      <figcaption>
        <p><?php echo $producto['nombre'] ?></p> 
      </figcaption>
    </figure>
    <section class="col-xs-6 datos">
      <p><strong>Nombre: </strong> <?php echo $producto['nombre'] ?></p>
      <p><strong>Familia: </strong> <?php echo $producto['familia'] ?></p>
      <p><strong>Precio: </strong> <?php echo $producto['precio'] ?> €</p>
      <p><strong>Descripcion: </strong></p> 
      <p><?php echo $producto['descripcion'] ?></p>
    </section>
</section>
</section>

