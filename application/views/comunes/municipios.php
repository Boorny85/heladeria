<?php foreach ($municipios as $k => $v): ?>
  <option value="<?= $k?>"><?= $v?></option>
<?php endforeach?>
<script>
  var municipio = $('#municipios').data('valor');
  if (municipio != '') {
  $('#municipios').val(municipio);  
  };
</script>