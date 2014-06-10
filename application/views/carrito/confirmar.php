<?= form_open('carritos/realizar_pedido'); ?>
<section> 
  <section class="alert alert-info row datos_confirmar">
    <h3>Confirmación Del Pedido</h3>
    <section class="col-xs-6">
      <?= form_input(array('name' => 'direc',
                           'type' => 'radio',
                           'value' => 'deshabilitar',
                           'checked' => 'checked' ));?>
      <span id="direccion_habitual">Dirección Habitual</span>
      <br />
      <span>
        <strong><?=$usuario['direccion']?></strong>
      </span> 
    </section>
    <section class="col-xs-6">
      <?= form_radio('direc', 'habilitar') ?>
      <span>Otra Direccíon</span>
      <br />
      <?= form_input(array('name' => 'direccion_entrega',
                           'id' => "direccion")); ?> 
      <?= form_hidden('id_oculto', $id); ?>
    </section>
  </section>
  <br />
  <table cellpadding="6" cellspacing="1" style="width:100%" border="0">
    <thead>
      <tr>
        <th>Cantidad</th>
        <th>Imagen</th>
        <th>Producto</th>
        <th style="text-align:right">Precio</th>
        <th style="text-align:right">Sub-Total</th>
      </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($this->cart->contents() as $items): ?>
      <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
      <tr>
        <td><?php echo $items['qty'] ?></td>
        <td><img src="<?php echo base_url($items['imagen']) ?>" alt="<?php echo $items['name'] ?>" class="productos_carrito"/></td>
        <td>
        <?php echo $items['name']; ?>
          <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
            <p>
              <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
              <?php endforeach; ?>
            </p>
          <?php endif; ?>
        </td>
        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?> €</td>
        <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?> €</td>
      </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <tr>
      <td colspan="3"> </td>
      <td class="right"><strong>Total</strong></td>
      <td class="right"><?php echo $this->cart->format_number($this->cart->total()); ?> €</td>
    </tr>
    </tbody>
  </table>
  <section class="row botonera">
    <section class="col-xs-6">
    <a href="<?= base_url('/productos/lista_productos') ?>" 
                     class="btn btn-sm btn-block btn-success">
                    Seguir Comprando
                  </a>  
    </section>
    <section class="col-xs-6">
    <?= form_input(array('name' => 'enviar',
                           'value' => 'Realizar Pedido',
                           'type' => 'submit',
                           'class' => 'btn btn-sm btn-block btn-warning confirmar'
                          )); ?>    
    </section>
  </section>
  <div class="clear"></div>
</section>
<?= form_close(); ?>
<script type="text/javascript" src="<?=base_url('/script/jquery.cookie.js')?>">
</script> 
<script type="text/javascript">
$(document).ready(function () {
  var id = $("input[name='id_oculto']").val();
  if ($('input[type=radio][name=direc]').val() == 'deshabilitar') {
    $('#direccion').attr('disabled', 'disabled');
  }

  $('input[type=radio][name=direc]').change(function() {
        if (this.value == 'deshabilitar') {
            $('#direccion').attr('disabled', 'disabled');
        }
        else if (this.value == 'habilitar') {
            $('#direccion').removeAttr('disabled');
            $('#direccion_habitual').css({"color": "gray"})
        }
    });
  $("#direccion").val($.cookie("direccion"+id));
  $(".confirmar").click(function () {
    $.cookie("direccion"+id, $("#direccion").val(), { expires: 365 });
  })

});    
</script>