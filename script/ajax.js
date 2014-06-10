$('document').ready(function () {

  $('#codigo_contrato').change(contrato);

    function contrato () {

      var codigo = $('select#codigo_contrato').val(); //Obtenemos el id del torneo seleccionado en la lista
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>contratos/datos', //Realizaremos la petición al metodo datos del controlador contratos
        data: 'codigo_contrato='+codigo, //Pasaremos por parámetro POST el codigo del contrato
         success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
         //Activar y Rellenar el select de partidos
         $('#datos').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
         }
      })
    }
});