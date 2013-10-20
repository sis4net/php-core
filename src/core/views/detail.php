<h3><span class="glyphicon glyphicon-ok"></span> <?php echo $lang[$formData->title]; ?></h3>

<form id="formID" role="form" class="form-horizontal well" method="post" >
<?php
foreach ($formData->fields as $field) {
  $data = $field->name;
  $value = $formData->data->$data;
?>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="<?php echo $field->name; ?>"><?php echo $lang[$field->key]; ?></label>
    <div class="col-lg-10">
      <p class="form-control-static"><?php echo $value; ?></p>
    </div>
  </div>
<?php 
}
?>
</form>