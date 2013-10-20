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
			?>
			<th>&nbsp;</th>
		</tr>
	</thead>
  	<tbody>
  		<?php
		foreach ($webTable->list as $data) {
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
			?>
  			<td>
  				<div class="btn-group">
  					<?php
					foreach ($webTable->options as $option) {
					?>
				  	<a href="<?php echo $site; ?><?php echo $option->url; ?>" title="<?php echo $option->title; ?>" class="btn"><span class="glyphicon <?php echo $option->icon; ?>"></span></a>
				 	<?php
					}
					foreach ($webTable->dialogs as $dialog) {
					?>
					<a  id="delete" url="<?php echo $site; ?><?php echo $dialog->url; ?>" class="btn"><span class="glyphicon <?php echo $dialog->icon; ?>"></span></a>
					<?php
					}
					?>
				</div>
  			</td>
  		</tr>
  		<?php
		}
		?>
  	</tbody>
</table>

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