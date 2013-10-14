<?php

abstract class AddController extends AbstractController {
	
	private $fields;

	public final function action() {
		$action = "add";
		// Creamos Objeto
		$formData = new FormData();
		// Limpiamos data
		$this->fields = null;
		try {
			// Ejecutamos Logica			
			$formData->title = $this->getTitle();
			
			$this->setFields();	
			
			$formData->fields = $this->fields;
			
			$formData->url = $this->setUrl();
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al crear el listado : " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('formData', $formData);
		
		return $action;
	}
	
	protected final function addField($name, $key, $type, $length, $validate) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $validate;
		
		$this->fields[] = $elem;
	}
	
	protected abstract function setFields();
	
	protected abstract function getTitle();
	
	protected abstract function setUrl();
	
	protected  function isGloba() {
		return true;
	}

}

?>