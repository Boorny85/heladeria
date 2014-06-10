    $(".anadir").click(agregar);
    $(".quitar").click(quitar);
    $(".anadir").click(efecto);
    $(".quitar").click(efecto2);
    function quitar (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var sabores = $('#sabores_'+ id).val();
      var id2 = "" + id;
      if (typeof sabores != 'undefined'){
        if (sabores == null) {
          alert('No ha seleccionando ningun sabor');
          return false;
        }
        else{
          var opciones = sabores;
          for (var i = 0; i < sabores.length; i++) {
            id2 += sabores[i];
          };
        }
      }

      var rowid = $("input[id='"+ id2 +"']").val();


      if (typeof rowid != 'undefined') {
        $.ajax({
          type: 'POST',
          url: '../carritos/modificar', //Realizaremos la petición al metodo datos del controlador provincias
          data: {'rowid': rowid, 'cant': -1}, //Pasaremos por parámetro POST el codigo del contrato
          success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
            //Activar y Rellenar el select de partidos
            $('#carrito').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
          }
        })
      }
    }

    function efecto () {
      $(this).effect('transfer', {to:$("#carrito"), className: "efecto"}, 1000);
    }

    function efecto2 () {
      $("#carrito").effect('transfer', {to:$(this), className: "efecto"}, 1000);
    }

    function agregar(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var sabores = $('#sabores_'+ id).val();
      var id2 = "" + id;
      if (typeof sabores != 'undefined'){
        if (sabores == null) {
          alert('No ha seleccionando ningun sabor');
          return false;
        }
        else{
          var opciones = sabores;
          for (var i = 0; i < sabores.length; i++) {
            id2 += sabores[i];
          };
        }
      }

      var rowid = $("input[id='"+ id2 +"']").val();

      if (typeof rowid != 'undefined') {
        $.ajax({
          type: 'POST',
          url: '../carritos/modificar', //Realizaremos la petición al metodo datos del controlador provincias
          data: {'rowid': rowid, 'cant': 1, 'opciones': opciones}, //Pasaremos por parámetro POST el codigo del contrato
          success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
            //Activar y Rellenar el select de partidos
            $('#carrito').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
          }
        })
      } else{
        $.ajax({
        type: 'POST',
        url: '../carritos/anadir', //Realizaremos la petición al metodo datos del controlador provincias
        data: {'id': id, 'opciones': opciones}, //Pasaremos por parámetro POST el codigo del contrato
          success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
            //Activar y Rellenar el select de partidos
            $('#carrito').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
          }
        })
      };
    };

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#visual_imagen').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    
    function recarga(){
      window.opener.location.reload();
    }
    
altura = 600;
ancho  = parseInt(screen.height*0.9);
arriba = (screen.height-altura)/2;
izquierda = (screen.width-ancho)/2; 

$("#mensaje").fadeIn(2000);

      $("#mensaje").click(function(){
        $(this).slideUp(1000);
      });

//alert(screen.height+" "+ancho+" "+arriba+" "+izquierda)

