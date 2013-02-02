<?php
/**
 * Classe para exportar Data
 * 
 * @author iflores
 *
 */
abstract class exportController extends BaseController {
	
	protected function export() {
		return true;
	}
	
	protected function isModal() {
		return true;
	}
	
}
?>