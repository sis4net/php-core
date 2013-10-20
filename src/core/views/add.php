<h3><span class="glyphicon glyphicon-edit"></span> <?php echo $lang[$formData->title]; ?></h3>

<form id="formID" role="form" class="form-horizontal well" method="post" action="<?php echo $site . $formData->url; ?>">
<?php
foreach ($formData->fields as $field) {
  $data = $field->name;
  $value = "";
  if (isset($formData->data->$data)) {
    $value = $formData->data->$data;
  } 
  if ($field->type == 'hidden') {
?>
  <input type="hidden" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" value="<?php echo $value; ?>">
<?php
  } else {

?>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="<?php echo $field->name; ?>"><?php echo $lang[$field->key]; ?></label>
    <div class="col-lg-10">
    <?php 
    if ($field->type == 'text') {
    ?>
     <textarea id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="form-control"><?php echo $value; ?></textarea>
   
    <?php 
    } else if ($field->type == 'select') {
    ?>
     <select id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" class="form-control">
      <option value="">...</option>      
      <?php
      foreach ($field->list as $elem) {
      ?>
      <option value="<?php echo $elem->id; ?>" <?php if ($elem->id == $value) { echo "selected='selected'"; } ?>><?php echo $elem->name; ?></option>   
      <?php 
      }    
      ?>
    </select> <?php 
    } else {
    ?>
      <input type="text" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="form-control <?php if ($field->validate) { ?>validate[required]<?php }?>" maxlength="<?php echo $field->length; ?>" value="<?php echo $value; ?>">
    <?php 
    }    
    ?>
    </div>
  </div>
<?php 
  }
}
?>

  <button type="button" id="pf_md_btn_crud" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> <?php echo $lang['BUTTON_SAVE']; ?></button>
</form>