<script type="text/javascript" src="<?=base_url('/script/jquery.validate.js')?>"></script> 
<script>
  $(document).ready(function () {
    muni();
    $('#provincias').change(muni);

    function muni () 
    {
      var id_prov = $('select#provincias').val(); //Obtenemos el id de la provincia
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/provincias/datos', //Realizaremos la petición al metodo datos del controlador provincias
        data: 'id_prov='+ id_prov, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#municipios').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })
    }

    $("#formulario").validate({
      rules:{
      dni:{
        required:true
      },
      nombre:{
        required:true
      },
      apellidos:{
        required:true
      },
      email:{
        email:true,
        required: true
      },
      usuario:{
        required:true
      },
      telefono:{
        required:true
      },
      direccion:{
        required:true
      },
      cp:{
        required:true,
        maxlength:5,
        number:true
      },
      id_prov:{
        min:1
      },
      id_municipio:{
        min:1
      }
      },
      messages:{
        dni: "El dni es obligatorio",
        nombre: "El nombre es obligatorio",
        apellidos: "Los apellidos son obligatorios",
        email: "Inserte un email válido",
        web: "Debe introducir una url válida",
        usuario: "El usuario es obligatorio",
        cp:{
          required: "El C.P es obligatorio",
          maxlength: "Introduzca 5 dígitos",
          number: "Introduzca dígitos solamente"
        },
        telefono: "El telefono es obligatorio",
        direccion: "La dirección es obligatoria",
        id_prov: "Seleccione una Provincia",
        id_municipio: "Seleccione un Municipio"    
      }
    });
  })
</script>
<?php if ($this->Usuario->admin(id_login())): ?>
  <?= form_open_multipart("admin/usuarios/editar/$id", "id='formulario'") ?>
<?php else: ?>
  <?= form_open_multipart("usuarios/editar/$id", "id='formulario'") ?>
<?php endif; ?>
<table>
  <thead>
    <th class="centrado" colspan="4">
        <span>Edición de Usuarios</span>
    </th>
  </thead>
  <tbody>
    <tr>
      <td>
        <?= form_label('Nombre:*', 'nombre') ?>
      </td>
      <td>
        <?= form_input('nombre', set_value('nombre', $fila['nombre'])) ?>
      </td>
      <td>
        <?= form_label('Apellidos:*', 'apellidos') ?>
      </td>
      <td>
        <?= form_input('apellidos', set_value('apellidos', $fila['apellidos'])) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= form_label('Usuario:*', 'usuario') ?>
      </td>
      <td>
        <?= form_input('usuario', set_value('usuario', $fila['usuario'])) ?>
      </td>
      <td>
        <?= form_label('Dni:', 'dni') ?>
      </td>
      <td>
        <?= form_input('dni', set_value('dni', $fila['dni'])) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= form_label('Contraseña:*', 'password') ?>
      </td>
      <td>
        <?= form_password('password') ?>
      </td>
      <td>
        <?= form_label('Contraseña:*', 'password_confirm') ?>
      </td>
      <td>
        <?= form_password('password_confirm') ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= form_label('Teléfono:*', 'telefono') ?>
      </td>
      <td>
        <?= form_input('telefono', set_value('telefono', $fila['telefono'])) ?>
      </td>
      <td>
        <?= form_label('Código Postal:*', 'cp') ?>
      </td>
      <td>
        <?= form_input('cp', set_value('cp', $fila['cp'])) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= form_label('Provincia: ', 'id_prov') ?>
      </td>
      <td>
        <?= form_dropdown('id_prov', 
                          $provincias,
                          set_value('id_prov', $fila['id_prov']), 
                          "id='provincias'") ?>
      </td>
      <td>
        <?= form_label('Municipio:', 'id_municipio') ?>
      </td>
      <td>
        <?= form_dropdown('id_municipio', 
                           array(0 => ' -- Municipios -- '),
                           set_value('id_municipio', $fila['id_municipio']), 
                           "id='municipios' data-valor='{$fila['id_municipio']}'") ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= form_label('Email:', 'email') ?>
      </td>
      <td>
        <?= form_input(array('name' => 'email',
                             'value' => set_value('email', $fila['email']))) ?>
      </td>
      <td>
        <?= form_label('Dirección:*', 'direccion') ?>
      </td>
      <td>
        <?= form_input(array('name' => 'direccion',
                             'value' => set_value('direccion', $fila['direccion']))) ?>
      </td>
    </tr>
    <tr>
      <td colspan="4" class="text-center">
      <div class="text-center"><?= validation_errors() ?></div>
        <?= form_submit(array(
                        "name" => "editar",
                        "value" => "Editar Usuario",
                        "class" => "btn btn-primary btn-block")) ?>
      </td>
    </tr>
  </tbody>
</table>
<?= form_close() ?>