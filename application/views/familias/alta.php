<table>
<?= validation_errors() ?>
<?= form_open("admin/familias/alta") ?>
  <thead>
    <th colspan="2" class="text-center">
      Alta de Familias
    </th>
  </thead>
  <tbody>
    <tr>
      <td>
        <?= form_label('Nombre: *', 'nombre') ?>
      </td>
      <td>
        <?= form_input('nombre', set_value('nombre')) ?>
      </td>
    </tr>
    <tr>
      <td colspan="2" class="text-center">
        <?= form_submit(array(
                        "name" => "alta",
                        "value" => "Nueva Familia",
                        "class" => "btn btn-primary")) ?>
        <?= anchor("#", 'Salir', array("class" => "btn btn-danger",
                                       'onclick' => "window.close()")) ?>
      </td>
    </tr>
  </tbody>
  
<?= form_close() ?>
</table>