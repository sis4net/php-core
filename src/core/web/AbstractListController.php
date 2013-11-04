<?php

abstract class AbstractListController extends AbstractFormController {
	
	private $columns;

	private $options;

	private $filters;

	protected final function actionList() {
		// Limpiamos data
		$this->columns = null;
		$this->options = null;
		$this->filters = null;
		
		try {
			// Pintamos Listado Paginado
			$webTable = $this->setList();
			// Ejecutamos Logica
			$title = $this->getTitleList();	
			if (!isset($title)) {	
				$title = $this->getTitle();
			}
			$webTable->title = $title;
			
			
			// Cargamos Data
			$this->setFilters();
			$this->setColumns();
			$this->setOptions();
			
			$webTable->columns = $this->columns;			
			$webTable->options = $this->options;			
			$webTable->filters = $this->filters;		
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
	
	protected final function addFilter($name, $key, $type, $length, $required) {
	
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $required;
	
		$this->filters[] = $elem;
	}
	
	/**
	 * Methodo para ingresar los campos a pintar en la Pagina
	 *
	 **/
	protected final function addFilterList($name, $key, $type, $length, $validate, $list) {
	
		$elem = new FieldTable($name,$key);
		$elem->type = $type;
		$elem->length = $length;
		$elem->validate = $validate;
		$elem->list = $list;
	
		$this->filters[] = $elem;
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
	private function setList() {
		// Creamos Listado
		$webTable = new webTable();
		
		$total = 0;
		$list = null;
		// Pagina
		$size = 10;
		$page = 1;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}
		// Calculamos init
		$init = 0;
		$end = $size * $page;
		
		if ($page > 1) {
			$init = $end - $size;
		}
		// Verificamos si es custom
		if ($this->listCustom()) {
			$list = $this->setListCustom($init, $size);
			
			$total = count($list);
		} else {
			$service = $this->loadService();
			// Obtenemos el Total de Registros
			$total = count($this->getService($service)->listAll());
			// Obtenemos el Paginado
			$list = $this->getService($service)->listPaginated($init, $size);
		}
		$webTable->list = $list;
		// Paginacion		
		$webTable->page = $page;
		$webTable->total = $total;
		$webTable->pages = ceil($total / $size);
		
		return $webTable;
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
	 * Methodo para setear las Filtros
	 *
	 */
	protected abstract function setFilters();
	
	/**
	*
	* Methodo para setear el Key de los Link
	*/
	protected function setKeys() {
		return "id";
	}

}

?>