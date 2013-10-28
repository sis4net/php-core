<?php

abstract class ListController extends AbstractListController {

	protected final function setUrl() {
		return null;
	}

	protected final function setFields() {}

	/**
	*
	* Seteamos Pagina a pintar
	*/
	protected final function getAction() {
		return "list";
	}

}
?>