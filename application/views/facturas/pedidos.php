<h3>Lista De Pedidos</h3>
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
        <td colspan="7" id="paginado"><?= paginado($pag, $npags,$vista)?></td>
      </tr>
    </tbody>
  </table>
</section>