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
	
	final protected function initSite() {
	}
	
	final protected function indexSite() {
	}
	
	final protected function validAdminProfile() {
	}
	
	final protected function setOwnData() {
	}
	
}
?>