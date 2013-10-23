<?php

abstract class ListController extends AbstractController {
	
	private $columns;
	private $options;
	private $filters;

	public final function action() {
		$action = "list";
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
			$webTable->title = $this->getTitle();
			
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
		
		return $action;
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
	
	protected final function setList($page, $size) {
		$service = $this->loadService();
		return $this->getService($service)->listAll();
	}

	protected abstract function loadService();
	
	protected abstract function setColumns();
	
	protected abstract function setOptions();
	
	protected abstract function setKeys();
	
	protected abstract function getTitle();
	
	protected  function isGloba() {
		return true;
	}

}

?>