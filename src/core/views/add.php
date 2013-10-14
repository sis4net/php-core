<h2><?php echo $lang[$formData->title]; ?></h2>

<form id="formID" class="form-horizontal form-actions" method="post" action="<?php echo $site . $formData->url; ?>">
<?php
foreach ($formData->fields as $field) {
  $data = $field->name;
  $value = $formData->data->$data;
  if ($field->type == 'hidden') {
?>
  <input type="hidden" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" value="<?php echo $value; ?>">
<?php
  } else {

?>
  <div class="control-group">
    <label class="control-label" for="<?php echo $field->name; ?>"><?php echo $lang[$field->key]; ?></label>
    <div class="controls">
    <?php 
    if ($field->type == 'text') {
    ?>
     <textarea id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="span5"><?php echo $value; ?></textarea>
   
    <?php 
    } else if ($field->type == 'select') {
    ?>
     <select id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" class="span5">
      <option value=""><?php echo $value; ?></option>      
    </select> <?php 
    } else {
    ?>
      <input type="text" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="span4 <?php if ($field->validate) { ?>validate[required]<?php }?>" maxlength="<?php echo $field->length; ?>" value="<?php echo $value; ?>">
    <?php 
    }    
    ?>
    </div>
  </div>
<?php 
  }
}
?>
  <div class="control-group">
    <div class="controls">
      <button type="button" id="pf_md_btn_crud" class="btn btn-primary"><i class="icon-ok icon-white"></i><?php echo $lang['BUTTON_SAVE']; ?></button>
    </div>
  </div>
</form>