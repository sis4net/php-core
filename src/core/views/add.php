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
    <?php 
    if ($field->type == 'text') {
    ?>
    <div class="col-lg-10">
     <textarea id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="form-control  <?php if ($field->validate) { ?>validate[required]<?php }?>"><?php echo $value; ?></textarea>
   
    <?php 
    } else if ($field->type == 'select') {
    ?>
    <div class="col-lg-4">
     <select id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" class="form-control  <?php if ($field->validate) { ?>validate[required]<?php }?>">
      <option value="">...</option>      
      <?php
      foreach ($field->list as $elem) {
      ?>
      <option value="<?php echo $elem->id; ?>" <?php if ($elem->id == $value) { echo "selected='selected'"; } ?>><?php echo $elem->name; ?></option>   
      <?php 
      }    
      ?>
    </select> 
    <?php 
    } else if ($field->type == 'number') {
    ?>
    <div class="col-lg-3">
    <input type="number" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="form-control validate[custom[integer],<?php if ($field->validate) { ?>required<?php }?>]" maxlength="<?php echo $field->length; ?>" value="<?php echo $value; ?>">
    <?php 
    } else if ($field->type == 'checkbox') {
    ?>
    <div class="col-lg-10">
    <input type="checkbox" name="<?php echo $field->name; ?>" id="<?php echo $field->name; ?>" value="1" <?php if ($value == 1) { ?>  checked="checked"<?php }?>>
    <?php 
    	echo $elem->name;
    } else if ($field->type == 'radio') {
	?>
	<div class="col-lg-10">
	<?php 
		foreach ($field->list as $elem) {
    ?>
    <div class="radio">
        <label>
          <input type="radio" name="<?php echo $field->name; ?>" id="<?php echo $field->name; ?>" value="<?php echo $elem->id; ?>" <?php if ($value == $elem->id) { ?>  checked<?php }?>>
          <?php echo $elem->name; ?>
        </label>
      </div>
    <?php 
    	} 
    } else if ($field->type == 'multiGroupRadio') {
		$father = null;
		$son = null;
	?>
	<div class="col-lg-10">
	<?php 
		foreach ($field->list as $option) {
			if ($father != $option->app) {
				$father = $option->app;
	?>
		<h3><?php echo $option->appName?></h3>
	<?php 
			}

			if ($son != $option->module) {
				$son = $option->module;
	?>
	<h4><?php echo $option->modName?></h4>
	<?php 
			}
	?>
	<label class="checkbox inline">
  		<input type="checkbox" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>[]" value="<?php echo $option->id?>" <?php if (isset($option->packet)) { ?>checked="checked"<?php } ?>> <?php echo $option->optName?>
	</label>
	<?php 
		}
    } else {
    ?>
    <div class="col-lg-7">
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
  <button type="button" class="btn btn-default"> <?php echo $lang['BUTTON_CANCEL']; ?></button>
</form>