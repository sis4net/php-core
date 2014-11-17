<?php

abstract class AddDetailListController extends AbstractListController {

	protected final function getAction() {
		// Obtenemos Categorias
		$this->setAttribute('listCategory', $this->getGroupProduct());

		// Obtenemos Productos
		$this->setAttribute('listProduct', $this->getProduct());

		return "addDetailList";
	}

	protected final  function create() {
		return true;
	}

	protected final function isForm() {
		return true;
	}

	protected function setFilters() {}

	/**
	*	Methodo para obtener el listado de Productos
	*
	*/
	protected abstract function getProduct();

	/**
	*	Methodo para obtener el listado de Productos
	*
	*/
	protected abstract function getGroupProduct();

}

?>