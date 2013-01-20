<div class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
		<p>
			<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
			<strong>Exito:</strong>						
<?php 
if (isset($msg)) {
	echo $msg; 
} else {
	echo 'Operacion Realizada Exitosamente !';
}
?>
		</p>
		<!--input type="button" id="pf_md_btn_refresh" value="Recargar" /-->
	</div>
</div>