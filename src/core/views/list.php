<h3><span class="glyphicon glyphicon-list"></span> <?php echo $lang[$webTable->title]; ?></h3>

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