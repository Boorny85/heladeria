<div class="row">
 <section id="logo" class="col-xs-5 cabecera">
    <img src='imagenes/logo.png'>
  </section>
  <section id="empresa" class="col-xs-5 cabecera">
    <p>Mª Jose Bornay Raposo</p>
    <p><strong>Cif: </strong>74.085.163-R <strong>Tlf: </strong> 956371155</p>
    <p>Avd. Nstra Sñra Virgen De Regla 64</p>
    <p>Chipiona (Cádiz) CP. 11550</p>
  </section>
</div>
<hr />
<table class="col-xs-12">
    <tr id="thead">
      <td>ID_Factura</td>
      <td>Nombre</td>
      <td>Apellidos</td>
      <td>DNI</td>
      <td>Direccion</td>
      <td>Fecha</td>
      <td>Total</td>
    </tr>  
    <tbody id="cuerpo">
      <?php foreach ($filas as $fila): ?>
        <tr>
          <td><?= $fila['id'] ?></td>
          <td><?= $fila['nombre'] ?></td>
          <td><?= $fila['apellidos'] ?></td>
          <td><?= $fila['dni'] ?></td>
          <td><?= $fila['direccion'] ?></td>
          <td><?= $fila['fecha_f'] ?></td>
          <td><?= $fila['total'] ?> €</td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>