<h2><?php echo $lang[$formData->title]; ?></h2>

<form id="formID" class="form-horizontal form-actions" method="post" >
<?php
foreach ($formData->fields as $field) {
  $data = $field->name;
  $value = $formData->data->$data;
?>
  <div class="control-group">
    <label class="control-label" for="<?php echo $field->name; ?>"><?php echo $lang[$field->key]; ?></label>
    <div class="controls">
      <?php echo $value; ?>
    </div>
  </div>
<?php 
}
?>
</form>