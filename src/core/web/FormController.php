<?php

abstract class FormController extends AbstractController {
	
	private $fields;

	public final function action() {
		$action = $this->getAction();
		// Creamos Objeto
		$formData = new FormData();
		// Limpiamos data
		$this->fields = null;
		try {
			// Ejecutamos Logica			
			$formData->title = $this->getTitle();
			
			$this->setFields();	
			// Campos  Pintar
			$formData->fields = $this->fields;
			// Url del Formulario
			$formData->url = $this->setUrl();

			// Cargamos la Data
			$formData->data = $this->loadData();
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al crear el listado : " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('formData', $formData);
		
		return $action;
	}

	protected final function addFieldDetail($name, $key) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = 'hidden';
		
		$this->fields[] = $elem;
	}

	protected final function addField($name, $key, $type, $length, $validate) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $validate;
		
		$this->fields[] = $elem;
	}
	
	/**
	* Methodo para ingresar los campos a pintar en la Pagina
	*
	**/
	protected final function addFieldList($name, $key, $type, $length, $validate, $list) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $validate;
		$elem->list = $list;
		
		$this->fields[] = $elem;
	}
	
	/**
	* Methodo desde el cual se deben implementar las llamas a addField()
	*
	**/
	protected abstract function setFields();
	
	/**
	* Methodo para agregar el Titulo de la Pagina
	*
	**/
	protected abstract function getTitle();
	
	/**
	* Methodo para agregar la Url del Formulario
	*
	**/
	protected abstract function setUrl();

	/**
	* Methodo para agregar la Pagina a pintar
	*
	**/
	protected abstract function getAction();

	/**
	* Methodo para cargar la data a Pintar
	*
	**/
	protected abstract function loadData();
	
	protected final  function isGloba() {
		return true;
	}

}

?>