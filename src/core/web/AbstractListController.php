<?php

abstract class AbstractListController extends AbstractFormController {
	
	private $columns;

	private $options;

	private $filters;

	protected final function actionList() {
		$webTable = new webTable();
		// Limpiamos data
		$this->columns = null;
		$this->options = null;
		$this->filters = null;
		
		// Paginacion
		$page = 1;
		$size = 20;
		
		try {
			// Ejecutamos Logica
			$title = $this->getTitleList();	
			if (!isset($title)) {	
				$title = $this->getTitle();
			}
			$webTable->title = $title;
			
			$webTable->list = $this->setList($page, $size);
			
			// Paginacion
			$webTable->page = 1;
			if (isset($_GET['page'])) {
				$webTable->page = $_GET['page'];
			}
			$webTable->pages = 5;
			
			// Cargamos Data
			$this->setColumns();
			$this->setOptions();
			
			$webTable->columns = $this->columns;			
			$webTable->options = $this->options;		
			$webTable->keys = $this->setKeys();
			
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al crear el listado : " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('webTable',$webTable);
	}

	/**
	*
	* Setea Titulo de Listado
	*/
	protected function getTitleList() {
		return null;
	}

	/**
	*
	* No pinte la Creacion
	*/
	protected function isForm() {
		return false;
	}

	/**
	* Methodo para verificar si la pagina contiene un listado
	*
	*/
	protected final function isList() {
		return true;
	}
	
	protected final function addColumns($name, $key) {
		$this->columns[] = new FieldTable($name,$key);
	}
	
	protected final function addOptions($name, $url, $icon) {
		$this->options[] = new UrlOption($name, $url, $icon, false);
	}

	protected final function addOptionsEvaluation($name, $url, $icon, Evaluation $evaluation) {
		$dialog = new UrlOption($name, $url, $icon, false);
		$dialog->evaluation = $evaluation;
		$this->options[] = $dialog;
	}
	
	protected final function addDialogs($name, $url, $icon) {
		$this->options[] = new UrlOption($name, $url, $icon, true);
	}

	protected final function addDialogsEvaluation($name, $url, $icon, Evaluation $evaluation) {
		$dialog = new UrlOption($name, $url, $icon, true);
		$dialog->evaluation = $evaluation;
		$this->options[] = $dialog;
	}
	
	/**
	* Methodo que carga la informacion que se pinta en la tabla
	*
	*/
	private function setList($page, $size) {
		// Verificamos si es custom
		if ($this->listCustom()) {
			return $this->setListCustom($page, $size);
		} else {
			$service = $this->loadService();
			return $this->getService($service)->listAll();
		}
	}

	/**
	* Methodo que define si se llama el methodo setListCustom
	*
	*/
	protected function listCustom() {
		return false;
	}
	
	/**
	*
	* Methodo para implementar una llamada custom
	*/
	protected function setListCustom($page, $size) {
		return null;
	}

	/**
	* Methodo para setear las columanas a pintar
	*
	*/
	protected abstract function setColumns();
	
	/**
	*
	* Methodo para setear las opciones de los Registros en la tabla
	*
	*/
	protected abstract function setOptions();
	
	/**
	*
	* Methodo para setear el Key de los Link
	*/
	protected abstract function setKeys();

}

?>