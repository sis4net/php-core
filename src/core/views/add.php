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
    $colsClass = 'col-lg-10';

    if ($field->length <= 10) {
      $colsClass = 'col-lg-2';
    } else if ($field->length <= 20) {
      $colsClass = 'col-lg-4';
    } else if ($field->length <= 50) {
      $colsClass = 'col-lg-5';
    }else if ($field->length <= 100) {
      $colsClass = 'col-lg-6';
    }

?>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="<?php echo $field->name; ?>"><?php if (isset($field->key)) { echo $lang[$field->key]; } ?></label>
    <div class="<?php echo $colsClass  ?>">
    <?php 
    if ($field->type == 'text') {
    ?>
     <textarea id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="form-control  <?php if ($field->validate) { ?>validate[required]<?php }?>"><?php echo $value; ?></textarea>
   
    <?php 
    } else if ($field->type == 'select') {
    ?>
      <?php
      if (count($field->list) == 1) {
        foreach ($field->list as $elem) {
      ?>
      <p class="form-control-static">
        <input type="hidden" name="<?php echo $field->name; ?>" value="<?php echo $elem->id; ?>" />
        <?php echo $elem->name; ?>
      </p>
      <?php
        }
      } else {
      ?>
     <select id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" class="form-control  <?php if ($field->validate) { ?>validate[required]<?php }?>">
      <option value=""><?php echo $lang["SELECT_DATA"]; ?></option>      
      <?php
      foreach ($field->list as $elem) {
      ?>
      <option value="<?php echo $elem->id; ?>" <?php if ($elem->id == $value) { echo "selected='selected'"; } ?>><?php echo $elem->name; ?></option>   
      <?php 
      }    
      ?>
    </select> 
    <?php 
      }
    } else if ($field->type == 'number') {
    ?>
    <input type="number" id="<?php echo $field->name; ?>" name="<?php echo $field->name; ?>" placeholder="<?php echo $lang[$field->key]; ?>" class="form-control validate[custom[integer],<?php if ($field->validate) { ?>required<?php }?>]" maxlength="<?php echo $field->length; ?>" value="<?php echo $value; ?>">
   <?php 
    } else if ($field->type == 'detail') {
    ?>
    <p class="form-control-static">
   		<?php echo $value; ?>
   	</p>
     <?php 
    } else if ($field->type == 'ajax') {
    ?>
    <div class="col-lg-10" id="<?php echo $field->name; ?>">
    <?php 
    } else if ($field->type == 'checkbox') {
    ?>
    <input type="checkbox" name="<?php echo $field->name; ?>" id="<?php echo $field->name; ?>" value="1" <?php if ($value == 1) { ?>  checked="checked"<?php }?>>
    <?php 
    	echo $elem->name;
    } else if ($field->type == 'radio') {
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