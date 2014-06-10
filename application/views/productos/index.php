<div class="row text-center">
<?= anchor_popup("admin/productos/alta","<span class='glyphicon glyphicon-plus'></span> Nuevo producto", array(
                                  'width'      => "'+ancho+'",
                                  'class'      => 'btn btn-primary btn-xs',
                                  'role'       => 'button',
                                  'height'     => "'+altura+'",
                                  'scrollbars' => 'yes',
                                  'status'     => 'yes',
                                  'resizable'  => 'yes',
                                  'screeny'    => "'+arriba+'",
                                  'screenx'    => "'+izquierda+'"));  ?>
</div>
<div class="row" id="mensaje">
  <p class="text-center"><?= $mensaje?></p>
</div>
<section id="busqueda" class="row alert alert-warning">
  <p class="text-center"><span class="glyphicon glyphicon-chevron-down"></span>&nbsp&nbsp&nbsp&nbsp&nbsp Búsqueda Avanzada &nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-chevron-down"></span></p>
  <section class="alert alert-success col-xs-4 col-xs-offset-4 text-center">
    <p>Filtro Por Familias</p>
    <?= form_dropdown('familias', $familias, 0, "id='select_familias' 
                                                    style='width:100%; height:35px' 
                                                    multiple 
                                                    class='chosen-select buscadores'"); ?>
  </section>
</section>

<section class="row">
  <table class="col-xs-10 col-xs-offset-1">
    <thead>
      <th>Nombre</th>
      <th>Familia</th>
      <th>Precio</th>
      <th>Descripcion</th>
      <th>Combinable</th>
      <th>Acciones</th>
    </thead>  
    <tbody id="cuerpo">
      <?php foreach ($filas as $fila): ?>
        <tr>
          <td>
          <?= anchor_popup("/productos/ficha/{$fila['id']}", 
                            $fila['nombre'], 
                            array('width'      => "'+ancho+'",
                                  'height'     => "'+altura+'",
                                  'scrollbars' => 'yes',
                                  'status'     => 'yes',
                                  'resizable'  => 'yes',
                                  'screeny'    => "'+arriba+'",
                                  'screenx'    => "'+izquierda+'")) ?>
          </td>
          <td><?= $fila['familia'] ?></td>
          <td><?= $fila['precio_format'] ?></td>
          <td><div id="descripcion"><?= $fila['descripcion'] ?></div></td>
          <td><?= ($fila['combinable'] != 0)? 'Sí': 'No' ?></td>
          <td class="text-center">
            <?= anchor_popup("admin/productos/editar/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-pencil"></span>', 
                        array('width'      => "'+ancho+'",
                              'class'      => 'btn btn-success btn-xs',
                              'role'       => 'button',
                              'height'     => "'+altura+'",
                              'scrollbars' => 'yes',
                              'status'     => 'yes',
                              'resizable'  => 'yes',
                              'screeny'    => "'+arriba+'",
                              'screenx'    => "'+izquierda+'")) ?>

            <?= anchor_popup("admin/productos/editar_imagen/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-picture"></span>', 
                       array('width'      => "'+ancho+'",
                             'class'      => 'btn btn-warning btn-xs',
                             'role'       => 'button',
                             'height'     => '550',
                             'scrollbars' => 'yes',
                             'status'     => 'yes',
                             'resizable'  => 'yes',
                             'screeny'    => "'+arriba+'",
                             'screenx'    => "'+izquierda+'")) ?>

            <?= anchor_popup("admin/productos/borrar/{$fila['id']}", 
                       '<span class="glyphicon glyphicon-remove"></span>', 
                       array('width'      => "'+ancho+'",
                             'class'      => 'btn btn-danger btn-xs',
                             'role'       => 'button',
                             'height'     => '300',
                             'scrollbars' => 'yes',
                             'status'     => 'yes',
                             'resizable'  => 'yes',
                             'screeny'    => "'+arriba+'",
                             'screenx'    => "'+izquierda+'")) ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</section>
<script type="text/javascript" 
        src="<?=base_url('/script/chosen/chosen.jquery.js')?>"></script>
<script>
  $(document).ready(function () {
    $("#select_familias").chosen();
    $("#busqueda section").slideToggle(0);
    $("#busqueda p").click(function(){
      $("#busqueda section").slideToggle("slow");

      if ($("#busqueda p span").hasClass('glyphicon-chevron-down')) {
        $("#busqueda p span").removeClass('glyphicon-chevron-down');
        $("#busqueda p span").addClass('glyphicon-chevron-up');
      }else{
        $("#busqueda p span").removeClass('glyphicon-chevron-up');
        $("#busqueda p span").addClass('glyphicon-chevron-down');
      }      
    });

    $("select").change(filtra);

    function filtra() {
      var familias = $("#select_familias").val();
      var where = "";

      if (familias != null) { 
        for (var i = 0; i < familias.length; i++) {
          where += "id_familia = ?"
          if (i < familias.length-1) {
            where += " or ";
          };
        };
      } else{
        where += "true"
      }


      if (familias == null) { var familias = new Array() };

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/productos/buscar', //Realizaremos la petición al metodo datos del controlador provincias
        data: {'where': where, 'valores': familias}, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#cuerpo').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })

    };
  })
</script>