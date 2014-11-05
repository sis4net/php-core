<?php

abstract class CrudController extends AbstractController {
	
	public function action() {
		$action = "success";
		$msg = " ";
		try {
			
			// Verificamos si existe redireccion
			$redirect = $this->redirectUrl();
			if (isset($redirect)) {
				$this->setAttribute('redirect',$redirect);
			}

			// Ejecutamos Logica
			$this->crudAction();
			
			$msg = $this->getMsg();
			
			// Verificamos si existe redireccion
			$redirect = $this->redirectUrl();
			if (isset($redirect)) {
				$this->setAttribute('redirect',$redirect);
			}
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al hacer el Crud: " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('msg',$msg);
		
		return $action;
	}
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function crudAction();

	/**
	*
	* Setea mensaje por defecto
	*/
	protected function getMsg() {
		return "OPERATION_SUCCESS";
	}
	
	/**
	* Setea que la pagina es un Modal
	* 
	*/
	protected function isModal() {
		return true;
	}
	
	/**
	* Setea que la pagina carga del raiz
	*
	*/
	protected final function isGloba() {
		return true;
	}

	/**
	* Methodo para redireccionar despues del mensaje de exito
	*
	*/
	protected function redirectUrl() {
		return null;
	}
	
}
?>