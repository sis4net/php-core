<h3><?php echo $webTable->title; ?></h3>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<?php
			foreach ($webTable->columns; as $column) {
			?>
			<th><?php echo $column->name; ?></th>
			<?php
			}
			?>
			<th>&nbsp;</th>
		</tr>
	</thead>
  	<tbody>
  		<tr>
  			<td>1</td>
  			<td>AAAA</td>
  			<td>BBBBB</td>
  			<td>CCCC</td>
  			<td>
  				<div class="btn-group">
				  <button class="btn"><i class="icon-refresh"></i></button>
				  <button class="btn"><i class="icon-user"></i></button>
				  <button class="btn"><i class="icon-ok"></i></button>
				  <button class="btn"><i class="icon-off"></i></button>
				  <button class="btn"><i class="icon-pencil"></i></button>
				  <button class="btn"><i class="icon-remove"></i></button>
				</div>
  			</td>
  		</tr>
  	</tbody>
</table>

<div class="pagination pagination-centered">
  <ul>
    <li class="disabled"><a href="#">&laquo;</a></li>
    <li class="disabled"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">...</a></li>
    <li><a href="#">&raquo;</a></li>
  </ul>
</div>