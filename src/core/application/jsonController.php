<?php

abstract class JsonController extends AbstractController {
	
	public function action() {
		$action = "json";
		$msg = " ";
		// Ejecutamos Logica
		$msg =  $this->jsonAction();
		// Se setea mSg a Mostrar en Pagina
		$this->registry->template->msg = $msg;
		
		return $action;
	}
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function jsonAction();
	
	protected function isModal() {
		return true;
	}
	
	protected  function isGloba() {
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