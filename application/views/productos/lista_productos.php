<script>
  $(document).ready(function () {
    $(".boton").click(articulos);
    $("#select_fam").change(articulos);
    carga_carrito();
    carga_central();
    function carga_carrito () {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>carritos/', //Realizaremos la petición al metodo datos del controlador provincias
        data: {}, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#carrito').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })
    }

    function carga_central () {      
      var id = 1;

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>productos/buscar', //Realizaremos la petición al metodo datos del controlador provincias
        data: {'id': id}, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#central').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })
    }

    function articulos(e) {
      e.preventDefault();
      var id = $(this).data('valor');
      
      if (id == null) {
        id = $(this).val();
      };

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>productos/buscar', //Realizaremos la petición al metodo datos del controlador provincias
        data: {'id': id}, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#central').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })

    };
  })
</script>
<div class="row" id="mensaje">
  <p  class="text-center"><?= $mensaje?></p>
</div>
<section class="col-sm-2 col-md-2">
  <nav class ="alert alert-info text-center">
    <h3 class="text-center">Menú</h3>
    <div id="nav_lat" class="btn-group-vertical">
      <?php foreach ($familias as $familia): ?>
        <button class="btn btn-info btn-sm boton" 
                data-valor="<?= $familia['id'] ?>" 
                id="<?= $familia['id'] ?>"><?= $familia['nombre']?></button>
      <?php endforeach ?>
    </div>

    <div id="sel_lat" class="row">
      <?= form_dropdown('familias', $select_fam, 0, "class='col-xs-10 col-xs-offset-1' id='select_fam'"); ?>
    </div>
  </nav>
</section>
<section class="col-sm-6  col-md-6">
  <section class="alert alert-info text-center">
    <h3 class="text-center">Productos</h3>
    <div id="central">
      
    </div>
  </section> 
</section>
<section class="col-sm-4" id="contenedor_carrito">
  <section class="alert alert-info">
    <h3 class="text-center">Carrito</h3>
    <div id="carrito">
      
    </div>
  </section>
</section>
