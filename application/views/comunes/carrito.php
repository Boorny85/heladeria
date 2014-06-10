<?php echo form_open('#'); ?>
<div class="contenedor_tabla">
<table id="tabla_carrito" cellpadding="6" cellspacing="0" style="width:100%" border="0">
<thead>
  <tr>
    <th>Cnt</th>
    <th>Nombre</th>
    <th style="text-align:right">Precio</th>
  </tr>
</thead>
<tbody>
  <?php $i = 1; ?>

  <?php foreach ($this->cart->contents() as $items): ?>
    <tr>
      <td>
      <?php echo form_input(array('name'  => $i.'[rowid]',
                                'type'  => 'hidden',
                                'value' => $items['rowid'],
                                'id'    => $items['id2'])); ?>
        <?= anchor('#', 
                   img( array('src' => base_url('/imagenes/x.png'),
                              'alt' => 'Quitar Linea',
                              'class' => 'imagenes_carrito')), 
                   array('class' => 'quitar_linea',
                         'data-rowid' => $items['rowid'])); ?>
              <h4><strong><?php echo $items['qty']?></strong></h4>
      </td>
      <td>
        <strong><?php echo $items['name']; ?></strong>
        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
          <br /><u>Sabores:</u>
          <ul>
            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
              <li><?php echo $option_value; ?></li>
            <?php endforeach; ?>
          </ul>

        <?php endif; ?>

      </td>
      <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?>€</td>
    </tr>
  <?php $i++; ?>
  <?php endforeach; ?>
  <tr>
    <td>
      <?= anchor('#', 'Limpiar', array('class' => 'btn btn-xs btn-danger limpiar')); ?> 
    </td>
    <td class="right"><strong>Total</strong></td>
    <td class="right"><?php echo $this->cart->format_number($this->cart->total()); ?>€</td>
  </tr>
  <tr>
    <td colspan="3">
      <?= anchor('/carritos/confirmar', 'Realizar Pedido', array('class' => 'btn btn-sm btn-block btn-warning pedir')); ?> 
    </td>
  </tr>
</tbody>
</table>
</div>
<?php echo form_close(); ?>
<script>
  $(document).ready(function () {
    $('.limpiar').click(limpiar);
    $('.quitar_linea').click(quitar_linea);

    function limpiar(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '../carritos/limpiar', //Realizaremos la petición al metodo datos del controlador provincias
        data: {}, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#carrito').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })
    };

    function quitar_linea(e) {
      e.preventDefault();
      var rowid = $(this).data('rowid');

      $.ajax({
        type: 'POST',
        url: '../carritos/quitar_linea', //Realizaremos la petición al metodo datos del controlador provincias
        data: {rowid: rowid}, //Pasaremos por parámetro POST el codigo del contrato
        success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
          //Activar y Rellenar el select de partidos
          $('#carrito').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
        }
      })
    };
  })


</script>