<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"> </script>
<script type="text/javascript" src="<?=base_url('/script/jquery-ui-1.10.4.custom.js')?>"></script>
<script type="text/javascript" src="<?=base_url('/script/jquery.ui.datepicker.js')?>"></script>
<script>
  $(document).ready(function () {
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
    $(function () {
      $("#desde").datepicker({
        onClose: function (selectedDate) {
          $("#hasta").datepicker("option", "minDate", selectedDate);
        }
      });
      $("#hasta").datepicker({
        onClose: function (selectedDate) {
        $("#desde").datepicker("option", "maxDate", selectedDate);
        }
      });
    });
    $("#desde").change(function(){filtra(1);});
    $("#hasta").change(function(){filtra(1);});

    $('#paginado a').click(function(event) { 
        event.preventDefault();
        dir = $(this).attr('href');
        dirs = dir.split("/")
        pag = dirs[dirs.length-1];         
        filtra(pag);
    });
  })

  function filtra(pag) {
    pag || ( pag = 1 );
    var desde = $("#desde").val();
    var hasta = $("#hasta").val();
    var valores = new Array();
    var where = "";

    if (desde != "") {
      where += "fecha >= ? ";
      valores.push(desde);
    }
    else{
      where += "true ";
    }

    where += "and ";

    if (hasta != "") {
      where += "fecha <= ? ";
      valores.push(hasta);
    }
    else{
      where += "true ";
    }

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>admin/facturas/buscar', //Realizaremos la petición al metodo datos del controlador provincias
      data: {'where': where, 'valores': valores,'pag':pag}, //Pasaremos por parámetro POST el codigo del contrato
      success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
        //Activar y Rellenar el select de partidos
        $('#cuerpo').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
      }
    })
  };
</script>
<?php echo form_open('admin/facturas/informe'); ?>
<section id="busqueda" class="row alert alert-warning">
  <p class="text-center"><span class="glyphicon glyphicon-chevron-down"></span>&nbsp&nbsp&nbsp&nbsp&nbsp Búsqueda Avanzada &nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-chevron-down"></span></p>
  <section class="alert alert-success col-xs-4 col-xs-offset-4 text-center">
    <p>Filtro Por Fecha</p>
    <span>Desde: </span>
    <?= form_input(array("name" => "desde",
                   "id" => "desde")); ?>
    <br />
    <span>Hasta: </span>
    <?= form_input(array("name" => "hasta",
                   "id" => "hasta")); ?>
  </section>
</section>
<section class="col-xs-4 col-xs-offset-4 botonpdf">
  <?php echo form_input(array("name" => "informe",
                              "type" => "submit",
                              "value" => "Generar Informe En PDF",
                              "class" => "btn btn-sm btn-warning btn-block")); ?>
</section>
<section class="row">
  <table class="col-xs-10 col-xs-offset-1 ">
    <thead>
      <th>ID_Factura</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>DNI</th>
      <th>Direccion</th>
      <th>Fecha</th>
      <th>Total</th>
    </thead>  
    <tbody id="cuerpo">
      <?php foreach ($filas as $fila): ?>
        <tr>
          <td><?= anchor("/admin/facturas/factura_pdf/{$fila['id']}", "{$fila['id']}")  ?></td>
          <td><?= $fila['nombre'] ?></td>
          <td><?= $fila['apellidos'] ?></td>
          <td><?= $fila['dni'] ?></td>
          <td><?= $fila['direccion'] ?></td>
          <td><?= $fila['fecha_f'] ?></td>
          <td><?= $fila['total'] ?> €</td>
        </tr>
      <?php endforeach ?>
      <tr>
        <td colspan="7" id="paginado">
          <?= paginado($pag, $npags, $vista)?>
        </td>
      </tr>
    </tbody>
  </table>

</section>