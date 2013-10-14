<?php

abstract class ListController extends AbstractController {
	
	private $columns;
	private $options;
	private $dialogs;
	private $filters;

	public final function action() {
		$action = "list";
		$webTable = new webTable();
		// Limpiamos data
		$this->columns = null;
		$this->options = null;
		$this->filters = null;
		$this->dialogs = null;
		
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
			$webTable->pages = 10;
			
			// Cargamos Data
			$this->setColumns();
			$this->setOptions();
			
			$webTable->columns = $this->columns;			
			$webTable->options = $this->options;			
			$webTable->dialogs = $this->dialogs;
			
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
		$this->options[] = new UrlOption($name, $url, $icon);
	}
	
	protected final function addDialogs($name, $url, $icon) {
		$this->dialogs[] = new UrlOption($name, $url, $icon);
	}
	
	protected abstract function setList($page, $size);
	
	protected abstract function setColumns();
	
	protected abstract function setOptions();
	
	protected abstract function getTitle();
	
	protected  function isGloba() {
		return true;
	}

}

?>