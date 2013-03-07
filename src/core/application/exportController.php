<?php
/**
 * Classe para exportar Data
 * 
 * @author iflores
 *
 */
abstract class exportController extends AbstractController {
	
	protected function export() {
		return true;
	}
	
	protected function isModal() {
		return true;
	}
	
}
?>