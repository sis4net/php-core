<?php

abstract class ListController extends AbstractController {

	public final function action() {
		$action = "list";
		$webTable = new webTable();
		try {
			// Ejecutamos Logica
			$this->crudAction();
			
			$msg = $this->getMsg();
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al crear el listado : " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('webTable',$webTable);
		
		return $action;
	}
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function addColumns();
	
	protected abstract function getMsg();
	
	protected  function isGloba() {
		return true;
	}

}

?>