<div class="row" id="mensaje">
  <p class="text-center"><?= $mensaje?></p>
</div>
<header class="text-center alert alert-info"><h3>Contacto</h3></header>
<section id="formulario" class="col-xs-6 col-xs-offset-3 alert alert-info">
<?php echo form_open('/usuarios/contacto'); ?>
  <p><strong>Nombre : </strong><input type="text" id="nombre" name="nombre" value="<?= set_value('nombre') ?>"/></p>
  <p><strong>Apellidos: </strong><input type="text" id="apellidos" name="apellidos" value="<?= set_value('apellidos') ?>"/></p>
  <p class="uso"><strong> Email * : </strong><input id="email" name="email" type="email" placeholder="Email" required="required" value="<?= set_value('email') ?>">
  <p>
    <textarea name="texto" id="texto" cols="50" rows="10" required="required" value="<?= set_value('texto') ?>"></textarea></p>
  </p>
  <input type="submit" class="btn btn-lg btn-primary" value="Enviar">
<?php echo form_close(); ?>
<?= validation_errors() ?>
</section>