<?php

abstract class AbstractFormController extends AbstractController {
	
	private $fields;

	public final function action() {
		$action = $this->getAction();

		if ($this->isList()) {
			$this->actionList();
		}
		if ($this->isForm()) {
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

				if (!$this->create()) {
					// Cargamos la Data
					$formData->data = $this->loadData();
				}
				
			} catch (Exception $e) {
				error_log("Ocurrio un error al crear el listado : " + $e->getMessage(), 0);
				throw new Exception($e->getMessage());
			}
			// Se setea mSg a Mostrar en Pagina
			$this->setAttribute('formData', $formData);
		}
		
		return $action;
	}

	protected function isList() {
		return false;
	}

	protected function isForm() {
		return true;
	}
	
	protected final function addFieldAjax($name) {
	
		$elem = new FieldTable($name,null);
		$elem->type = 'ajax';
	
		$this->fields[] = $elem;
	}

	protected final function addFieldDetail($name, $key) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = 'hidden';
		
		$this->fields[] = $elem;
	}

	protected final function addFieldDetailValue($name, $key, $value) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = 'hidden';
		$elem->value = $value;
		
		$this->fields[] = $elem;
	}
	
	protected final function addFieldDetailList($name, $key, $list) {
	
		$elem = new FieldTable($name,$key);
		$elem->type = 'multiGroupRadio';
		$elem->list = $list;
	
		$this->fields[] = $elem;
	}

	protected final function addFieldType($name, $key, $type) {
	
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
	
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
	* Methodo para ingresar los campos a pintar en la Pagina
	*
	**/
	protected final function addFieldListShow($name, $key, $type, $length, $validate, $list) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $validate;
		$elem->list = $list;
		$elem->ajax = true;
		
		$this->fields[] = $elem;
	}

	/**
	* Methodo para ingresar los campos a pintar en la Pagina
	*
	**/
	protected final function addFieldListAjax($name, $key, $type, $length, $validate, $list, $nameAjax) {
		
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $validate;
		$elem->list = $list;
		$elem->ajax = true;
		
		$this->fields[] = $elem;

		// Agregamos Ajax
		$this->addFieldAjax($nameAjax);
	}

	/**
	*
	* Methodo para implementar logica de los listados
	*/
	protected abstract function actionList();

	/**
	* Methodo para definir Servicio a cargar
	*
	*/
	protected abstract function loadService();
	
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
	protected function loadData() {
		$service = $this->loadService();

		$app = new Object();
		$app->id = $this->getId();
		
		$data = $this->getService($service)->load($app);
		
		return $data;
	}

	/**
	*
	* Methodo que define si es una creacion y no se debe cargar data
	*/
	protected  function create() {
		return false;
	}
	
	protected final  function isGloba() {
		return true;
	}

}

?>