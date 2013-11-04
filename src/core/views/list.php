<h3><span class="glyphicon glyphicon-list"></span> <?php echo $lang[$webTable->title]; ?></h3>
<?php 
if (count($webTable->filters) > 0) {
?>
<h5><span class="glyphicon glyphicon-search"></span> <?php echo $lang['FIND']; ?></h5>
<form id="formID" role="form" class="form-horizontal well" method="post" >
<?php
foreach ($webTable->filters as $filter) {
	$colsClass = 'col-lg-10';

	if ($filter->length <= 10) {
		$colsClass = 'col-lg-2';
	} else if ($filter->length <= 20) {
		$colsClass = 'col-lg-4';
	} else if ($filter->length <= 50) {
		$colsClass = 'col-lg-5';
	}else if ($filter->length <= 100) {
		$colsClass = 'col-lg-6';
	}

	?>
	<div class="form-group">
    	<label class="col-lg-2 control-label" for="<?php echo $filter->name; ?>"><?php if (isset($filter->key)) { echo $lang[$filter->key]; } ?></label>
    	<div class="<?php echo $colsClass  ?>">
    	
 	<?php 
  	if ($filter->type == 'select') {
    ?>
     <select id="<?php echo $filter->name; ?>" name="<?php echo $filter->name; ?>" class="form-control  <?php if ($filter->validate) { ?>validate[required]<?php }?>">
      <option value=""><?php echo $lang["SELECT_DATA"]; ?></option>      
      <?php
      foreach ($filter->list as $elem) {
      ?>
      <option value="<?php echo $elem->id; ?>" <?php if ($elem->id == $value) { echo "selected='selected'"; } ?>><?php echo $elem->name; ?></option>   
      <?php 
      }    
      ?>
    </select> 
    <?php 
  	} else if ($filter->type == 'number') {
    ?>
    <input type="number" id="<?php echo $filter->name; ?>" name="<?php echo $filter->name; ?>" placeholder="<?php echo $lang[$filter->key]; ?>" class="form-control validate[custom[integer],<?php if ($filter->validate) { ?>required<?php }?>]" maxlength="<?php echo $filter->length; ?>" value="">
   <?php 
  	} else if ($filter->type == 'date') {
	?>
<input type="date" id="<?php echo $filter->name; ?>" name="<?php echo $filter->name; ?>" placeholder="<?php echo $lang[$filter->key]; ?>" class="form-control <?php if ($filter->validate) { ?>validate[required]<?php }?>" maxlength="<?php echo $filter->length; ?>" value="">
<?php 
  } else {
  ?>
      <input type="text" id="<?php echo $filter->name; ?>" name="<?php echo $filter->name; ?>" placeholder="<?php echo $lang[$filter->key]; ?>" class="form-control <?php if ($filter->validate) { ?>validate[required]<?php }?>" maxlength="<?php echo $filter->length; ?>" value="">
  <?php 
  }    
  ?>   	
		</div>
	</div>
<?php 
}
?>
	<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> <?php echo $lang['BUTTON_FIND']; ?></button>
</form>
<?php 
}
?>

<table class="table table-striped table-hover  table-condensed">
	<thead>
		<tr>
			<?php
			foreach ($webTable->columns as $column) {
			?>
			<th><?php echo $lang[$column->key]; ?></th>
			<?php
			}
			if (count($webTable->options) > 0) {
			?>
			<th>&nbsp;</th>
			<?php } ?>
		</tr>
	</thead>
  	<tbody>
  		<?php
  		if (count($webTable->list) > 0) {
			foreach ($webTable->list as $data) {
				$elemKey = $webTable->keys;
				$key = $data->$elemKey;
		?>
  		<tr>
  			<?php
			foreach ($webTable->columns as $column) {
			?>
  			<td><?php 
  			$elem = $column->name;
  			echo $data->$elem; 
  			
  			?></td>
  			<?php
			}
			if (count($webTable->options) > 0) {
			?>
  			<td>
  				<div class="btn-group">
  					<?php
					foreach ($webTable->options as $option) {
						$show = true;
						if (isset($option->evaluation)) {
							$elem = $option->evaluation->param;
							$value = $data->$elem;

							if ($value != $option->evaluation->value) {
								$show = false;
							}
						}
						if ($show) {
					?>
				  	<a <?php if ($option->dialog) { ?>id="delete" url<?php } else {?>href<?php } ?>="<?php echo $site; ?><?php echo $option->url . '/' . $key; ?>" title="<?php echo $option->title; ?>" class="btn"><span class="glyphicon <?php echo $option->icon; ?>"></span></a>
				 	<?php
				 		}
					}
					?>
				</div>
  			</td>
  			<?php 
  			}
  			?>
  		</tr>
  		<?php
			}
		} else {
		?>
		<tr>
			<th colspan="<?php echo count($webTable->columns); ?>">
				<p class="text-center"><?php echo $lang["LIST_NOT_DATA"]; ?></p>
			</th>
		</tr>
		<?php	
		}
		?>
  	</tbody>
</table>

<?php
if ($webTable->pages > 1) {
?>
<ul class="pagination">
	<li  <?php if ($webTable->page == 1) { ?>class="disabled"<?php }?>><a href="?page=<?php echo $webTable->page - 1 ?>">&laquo;</a></li>
	<?php 
	for ($i = 1; $i <= $webTable->pages; $i++) {
	?>
	<li <?php if ($i == $webTable->page) { ?>class="active"<?php }?>><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
	<?php 
	}
	?>
	<li <?php if ($webTable->page == $webTable->pages) { ?>class="disabled"<?php }?>><a href="?page=<?php echo $webTable->page + 1 ?>">&raquo;</a></li>
</ul>
<?php
}
?>