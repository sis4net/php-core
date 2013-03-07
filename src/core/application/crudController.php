<?php

abstract class CrudController extends AbstractController {
	
	public function action() {
		$action = "success";
		$msg = " ";
		try {
			// Ejecutamos Logica
			$this->crudAction();
			
			$msg = $this->getMsg();
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al hacer el Crud: " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
		// Se setea mSg a Mostrar en Pagina
		$this->registry->template->msg = $msg;
		
		return $action;
	}
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function crudAction();
	
	protected abstract function getMsg();
	
	protected function isModal() {
		return true;
	}
	
	protected  function isGloba() {
		return true;
	}
	
}
?>