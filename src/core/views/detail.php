<h3><span class="glyphicon glyphicon-ok"></span> <?php echo $lang[$formData->title]; ?></h3>

<form id="formID" role="form" class="form-horizontal well" method="post" >
<?php
foreach ($formData->fields as $field) {
  $data = $field->name;
?>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="<?php echo $field->name; ?>"><?php echo $lang[$field->key]; ?></label>
    <div class="col-lg-10">
    <?php 
    if ($field->type == 'multiGroupRadio') {

		$module = null;
		$application = null;
		
		foreach ($field->list as &$option) {
			if (isset($option->packet)) {
				if ($application != $option->app) {
					$application = $option->app;
					?>
			<h3><?php echo $option->appName?></h3>
		<?php 
				}
		
				if ($module != $option->module) {
					$module = $option->module;
		?>
			<h4><?php echo $option->modName?></h4>
		<?php 
				}
		?>
			<label class="checkbox inline">
		  		<?php 
		  			echo $option->optName;
		  		?>
			</label>
		<?php 
			}
		}

    } else {
		$value = $formData->data->$data;
    ?>
      <p class="form-control-static"><?php echo $value; ?></p>
    <?php 
    }
    ?>
    </div>
  </div>
<?php 
}
?>
</form>