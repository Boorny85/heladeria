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
  <section id="cliente" class="col-xs-12 cabecera">
      <p><strong>Datos Del Cliente: </strong></p>
      <p><strong>Nombre: </strong><?= "{$factura['nombre']} {$factura['apellidos']}" ?></p>
      <p><strong>Dni: </strong><?= $factura['dni'] ?></p>
      <p><strong>Dirección: </strong><?= $factura['direccion'] ?></p>
      <p><strong>Fecha: </strong><?= $factura['fecha_f'] ?></p>
    </section>
  <hr />
  <table class="col-xs-12">
    <tr id="thead">
      <td>Cantidad </td>
      <td>Producto </td>
      <td>Precio </td>
      <td>Subtotal</td>
    </tr>
    <?php foreach ($lineas as $linea): ?>
      <tr>
        <td><?= $linea['cantidad'] ?></td>
        <td><?= $linea['nombre'] ?></td>
        <td><?= $linea['precio'] ?></td>
        <td><?= $linea['importe'] ?></td>
      </tr>
    <?php endforeach ?>
    <tr>
      <td colspan="3"><strong>Total: </strong></td>
      <td><strong><?= $factura['total'] ?> €</strong></td>
    </tr>
  </table>