<?php foreach ($filas as $fila): ?>
<tr>
  <td><?= anchor("admin/facturas/factura_pdf/{$fila['id']}", "{$fila['id']}")  ?></td>
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
<script>
  $('#paginado a').click(function(event) { 
    event.preventDefault();
    pag = $(this).attr('href');
    dirs = pag.split("/")
    pag = dirs[dirs.length-1]; 
    filtra(pag);
  }); 
</script>