<h2><?php echo $lang[$formData->title]; ?></h2>

<form id="formID" class="form-horizontal form-actions" method="post" action="<?php echo $site . $formData->url; ?>">
<?php
foreach ($formData->fields as $field) {
?>
  <div class="control-group">
    <label class="control-label" for="<?php echo $field->name; ?>"><?php echo $lang[$field->key]; ?></label>
    <div class="controls">
    <?php 
    if ($field->type == 'text') {
    ?>
    <textarea id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="span5"></textarea>
    <?php 
    } else {
    ?>
      <input type="text" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="span4 <?php if ($field->validate) { ?>validate[required]<?php }?>" maxlength="<?php echo $field->length; ?>">
    <?php 
    }    
    ?>
    </div>
  </div>
<?php 
}
?>
  <div class="control-group">
    <div class="controls">
      <button type="button" id="pf_md_btn_crud" class="btn btn-primary"><i class="icon-ok icon-white"></i><?php echo $lang['BUTTON_SAVE']; ?></button>
    </div>
  </div>
</form>