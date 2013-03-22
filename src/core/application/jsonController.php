<?php

abstract class JsonController extends AbstractController {
	
	public function action() {
		$action = "json";
		$msg = " ";
		// Ejecutamos Logica
		$msg =  $this->jsonAction();
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('msg', $msg);
		
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
	
}
?>
